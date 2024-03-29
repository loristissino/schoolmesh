<?php

/**
 * Account class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class Account extends BaseAccount
{
	
	protected $_info = array();
	protected $_settings = array();
	
	public function __construct()
	{
		parent::__construct();
		//$this->_info=unserialize($this->getInfo());
		if ($this->getInfo())
		{
			$this->_info=unserialize($this->getInfo());
		}
		else
		{
			$this->_info=array();
		}
		if ($this->getSettings())
		{
			$this->_settings=unserialize($this->getSettings());
		}
		else
		{
			$this->_settings=array();
		}
	}
	
	public function __toString()
	{
		return sprintf('Account «%s»', $this->getAccountType()->getName());
	}

	public function getUsername()
	{
    return $this->getSfGuardUser()->getUsername();
	}
	
	public function getProfile()
	{
		$c=new Criteria();
		$c->add(sfGuardUserProfilePeer::USER_ID, $this->getUserId());
		$t=sfGuardUserProfilePeer::doSelectOne($c);
		return $t;
	}
  
  public function unlock()
  {
    /* this has to be reimplemented in subclasses... */
    $result['result']='error';
    $result['message']='This account cannot be unlocked.';
    return $result;
  }
  
  public function getAccountIsUnlockable()
	{
		return false;
	}
	
	public function getSiblingAccountByType($type)
	{
		return AccountPeer::retrieveByUserIdAndType($this->getUserId(), $type);
	}
	
	public function save(PropelPDO $con = null)
	{
		$this->setInfo(serialize($this->_info));
		$this->setSettings(serialize($this->_settings));
		parent::save();
	}
	
   public function setAccountInfo($key, $value)
	{
		$this->_info[$key]=$value;
		return $this;
	}
   public function resetInfo()
	{
		$this->_info=array();
		return $this;
	}

    public function getAccountInfo($key)
	{
		if (@array_key_exists($key, $this->_info))
		{
			return $this->_info[$key];
		}
		else
		{
			return null;
		}
	}
		
   public function setAccountSetting($key, $value)
	{
		$this->_settings[$key]=$value;
		$this->save();


		return $this;
	}

    public function getAccountSetting($key)
	{
		$this->_settings=unserialize($this->getSettings());
		if (is_array($this->_settings) and array_key_exists($key, $this->_settings))
		{
			return $this->_settings[$key];
		}
		else
		{
			return null;
		}
	}

	function getRealAccount()
	{
		
		$type=ucfirst($this->getAccountType()->getName()). 'Account';		
		
		$realAccount = new $type();
		
		foreach($this as $key=>$value)
		{
			$realAccount->$key = $value;
		}
		
		$realAccount->_info=unserialize($this->getInfo()); // We need it!!
		$realAccount->_settings=unserialize($this->getSettings()); // We need it!!
		
		$realAccount->setNew(false);
		
		return $realAccount;
	}
	
/**
   * Makes somehow a query to the real world, updating all relevant fields.
   * This function may store information with the setAccountInfo() function.
   * It must take care of updating the info_updated_at field when updating data.
   * Also, if relevant, it must calculate the quota_percentage field.
   *
   * @return self
   */
	public function updateInfoFromRealWorld()
	{
		throw new Exception(sprintf('This function must be implemented in the derived class «%s»', $this->getAccountType()));
		return $this;
	}
	
	public function getChecks($checkGroup, &$checkList=null, $alerts='')
	{
		throw new Exception(sprintf('This function must be implemented in the derived class «%s»', $this->getAccountType()));
		return $this;
	}
	
	public function saveSettings($params)
	{
		throw new Exception(sprintf('This function must be implemented in the derived class «%s»', $this->getAccountType()));
		return $this;
	}

	public function getImage()
	{
		throw new Exception(sprintf('This function must be implemented in the derived class «%s»', $this->getAccountType()));
	}
	
	public function getBasicInfo()
	{
		return array();
	}
	
  /**
   * Creates the External account
   *
   * @return Boolean true if the account was created, false otherwise
   */
  public function createAccount()
	{
		return false;
	}
	
  /**
   * Informs about whether the account can be definitely removed
   *
   * @return Boolean|String true if the account can be definitely removed, a string with the explanation of the reason otherwise
   */
  public function getIsDeletable()
	{
		return false;
	}
	

  public function changePassword($password, $is_reset=false)
	{
		throw new Exception(sprintf('This function must be implemented in the derived class «%s»', $this->getAccountType()));
		return $this;
	}
	
	
  public function resetPassword()
	{
		$password=rand(1000000,9999999);
		
		$this
		->setTemporaryPassword($password)
		->changePassword($password)
		->save();
		
		return $this;
	}
	
	
  public function getPasswordIsResettable()
	{
		return false;
	}
  
  public function getPasswordIsSynchronizable()
	{
		return false;
	}
  
  public function getLoginUrl()
  {
    return false;
  }
  
  public function getCredentialShouldBeAdded()
  {
    return false;
  }

	protected function makeComparisons(&$checkList, $checks, $checkGroup)
	{
			foreach($checks as $check)
			{
				
				if (is_array($check['field']))
				{
					if (sizeof($check['field'])!=sizeof($check['match']))
					{
						throw new Exception ('The comparison arrays have not the same size.');
					}
					$test=true;
					for($i=0; $i<sizeof($check['field']); $i++)
					{
						$test=$test && ($this->getAccountInfo($check['field'][$i])==$check['match'][$i]);
					}
				}
				else
				{
					$test=$this->getAccountInfo($check['field'])==$check['match'];
				}
				
				if ($test)
				{
					$checkList->addCheck(new Check(Check::PASSED, $this->getAccountType() . ': '. $check['true'], $checkGroup));
				}
				else
				{
					
					if (is_array($check['field']))
					{
						$got=array();
						foreach($check['field'] as $field)
						{
							$got[]=$this->getAccountInfo($field);
						}
						$got=implode(', ', $got);
						$expected=array();
						foreach($check['match'] as $match)
						{
							$expected[]=$match;
						}
						$expected=implode(', ', $expected);
					}
					else
					{
						$got=$this->getAccountInfo($check['field']);
						$expected=$check['match'];
					}
					
					$checkList->addCheck(new Check(Check::WARNING, $this->getAccountType()->getName().  ': '. $check['false'] . sprintf(' (got «%s», expected «%s»)', $got, $expected), $checkGroup, 
					
					isset($check['command'])? array('command'=>$check['command']) : array()
					
					));
				}
			}
		}

  public function copySettings($settings, $to)
  {
    Generic::logMessage('copysettings', $to);
    $ids=explode(',', $to);
    $back=array();
    
    $accounts=AccountPeer::retrieveByPKs($ids);
    
    try
    {
      foreach($accounts as $account)
      {
        $account=$account->getRealAccount();
        $back[]=$account->getsfGuardUser()->getId();
        
        switch($settings)
        {
          case 'blocks':
            $keys=array('soft_blocks_quota', 'hard_blocks_quota',); break;
          case 'files':
            $keys=array('soft_files_quota', 'hard_files_quota',); break;
        }
        foreach($keys as $key)
        {
          $account->setAccountSetting($key, $this->getAccountSetting($key));
        }
        $result['result']='notice';
        $result['message']='Settings successfully copied.';

      }
    }
    catch(Exception $e)
    {
      $result['result']='error';
      $result['message']='Something got wrong: ' . $e->getMessage();
    }
    
    $result['back']=implode(',', $back);
    return $result;
  }

	
}
