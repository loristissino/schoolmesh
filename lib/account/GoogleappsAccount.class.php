<?php

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
          'date',
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
  
	public function setFormDefaults(&$form)
	{
		if (! $form instanceof GoogleappsAccountForm)
		{
			throw new Exception('The form must be a GoogleappsAccountForm instance');
		}


	$form->setDefaults(
		array(
			'id' => $this->getId(),
			'used_files' => $this->getAccountInfo('used_files'),
			'used_blocks' => $this->getAccountInfo('used_blocks'),
			'soft_blocks_quota' => $this->getAccountSetting('soft_blocks_quota'),
			'hard_blocks_quota' => $this->getAccountSetting('hard_blocks_quota'),
			'soft_files_quota' => $this->getAccountSetting('soft_files_quota'),
			'hard_files_quota' => $this->getAccountSetting('hard_files_quota'),
			)
		);
	}


}
