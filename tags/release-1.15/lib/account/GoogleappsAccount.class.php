<?php

/**
 * GoogleappsAccount class.
 *
 * @package    schoolmesh
 * @subpackage lib.account
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class GoogleappsAccount extends Account
{
	
	function __construct()
	{
		$this->setAccountType(AccountTypePeer::retrieveByName('googleapps'));
	}
	
	public function updateInfoFromRealWorld()
	{
		return $this;
	}
  
  public function updateInfoFromDataLine($data)
  {
      
    $i=0;
    foreach(array(
      'date',
      'account_id',
      'account_name',
      'status',
      'quota_in_mb',
      'usage_in_bytes',
      'primary_account_id',
      'primary_account_name',
      'creation_date',
      'last_login_date',
      'last_web_mail_date',
      'surname',
      'given_name',
      'service_tier',
      'channel',
      'suspension_reason',
      'last_pop_date',
      'creation_time',
      'last_login_time',
      'last_web_mail_time',
      'last_pop_time'
      ) as $fieldname)
      {
        if(!in_array($fieldname, array(
          'account_name',
          'surname',
          'given_name',
          )))
        {
          $this->setAccountInfo($fieldname, $data[$i]);
        }
        $i++;

      }
    
    $this->setInfoUpdatedAt(Generic::timefromdate($data[0]));
    
    if ($this->getAccountSetting('request_date'))
    {
      $this->setAccountSetting('accept_terms_date', $this->getAccountSetting('request_date'));
    }
    return $this;
  }
  

	public function getImage()
	{
		return 'googleapps';
	}
	public function getChecks($checkGroup, &$checkList=null, $alerts='')
	{
		return $this;
	}

	public function saveSettings($params)
	{
		$this
		->setAccountSetting('request_date', str_replace('-', '', $params['request_date']))
		->save();
		return $this;
	}


	public function setFormDefaults(&$form)
	{
		if (! $form instanceof GoogleappsAccountForm)
		{
			throw new Exception('The form must be a GoogleappsAccountForm instance');
		}

	$form->setDefaults(
		array(
    	'id' => $this->getId(),
			'request_date' => Generic::timefromdate($this->getAccountSetting('request_date'))
			)
		);
	}

  public function getPasswordIsSynchronizable()
	{
		return $this->getAccountInfo('status')=='ACTIVE';
	}
  
  public function getLoginUrl()
  {
    return sfConfig::get('app_config_' . $this->getAccountType() . '_url','');
  }
  
  public function getBasicInfo()
	{
		$info=array(
			'Quota in MiB'=>$this->getAccountInfo('quota_in_mb'),
			'Request date'=>$this->getAccountSetting('request_date'),
      'Accept terms date'=>$this->getAccountSetting('accept_terms_date'),
		);
		return $info;
	}
  
  public function getCredentialShouldBeAdded()
  {
    return !($this->getAccountSetting('request_date')==null);
  }

  public function changePassword($password, $is_reset=false)
	{
      if (!$this->client=self::authenticate())
      {
        throw new Exception('Could not authenticate to Google Apps Server.');
      }
      
      $gdata = new Zend_Gdata_Gapps($this->client, sfConfig::get('app_config_googleapps_domain'));
      
      $user = $gdata->retrieveUser($this->getUsername());
      
      if (!$user)
      {
        throw new Exception('User not found.');
      }
      
      if ($user->login->suspended)
      {
        throw new Exception('User suspended.');
      }
      
      // see http://framework.zend.com/manual/en/zend.gdata.gapps.html

      $user->login->password = $password;
      $user->save();
      
      if ($this->getAccountSetting('accept_terms_date')=='')
      {
        $this
        ->setAccountSetting('accept_terms_date', date('Ymd'))
        ->save();
      }
  
      return $this;
	}


  static public function authenticate()
  {
    
    ProjectConfiguration::registerZend();

    $credentials=sfConfig::get('app_config_googleapps_admin_credentials');
    $email = $credentials[0];
    $passwd = $credentials[1];
    try 
    {
      $client = Zend_Gdata_ClientLogin::getHttpClient($email, $passwd, Zend_Gdata_Gapps::AUTH_SERVICE_NAME);
    } 
    catch (Zend_Gdata_App_CaptchaRequiredException $cre) 
    {
      /*
      echo 'URL of CAPTCHA image: ' . $cre->getCaptchaUrl() . "\n";
      echo 'Token ID: ' . $cre->getCaptchaToken() . "\n";
      */
      // FIXME This should be reported in a log file...
      return null;
    } 
    catch (Zend_Gdata_App_AuthException $ae) 
    {
      /*
      echo 'Problem authenticating: ' . $ae->exception() . "\n";
      */
      // FIXME This should be reported in a log file...
      return null;
    }
    return $client;
  }


}
