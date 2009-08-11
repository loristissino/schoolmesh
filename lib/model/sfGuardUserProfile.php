<?php

/**
 * Subclass for representing a row from the 'sf_guard_user_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class sfGuardUserProfile extends BasesfGuardUserProfile
{
	
		protected $countFailedChecks;
		
		protected $checks=array();
		
		
		public function findGoodUsername()
		{
			
			$try=Generic::slugify($this->getFirstName().'.'.$this->getLastname());
			
			if ($this->getUsernameIsValid($try))
			{
				return array('username'=>$try, 'invented'=>false);
			}
			
			else
			{
				$try='u'. date('U').rand(100000,900000);
			}
			
				return array('username'=>$try, 'invented'=>true);
					
		}
		
		
		public function addSystemAlert($alert, $only_if=false)
		{
			if($only_if)
			{
				$previous= ($this->getSystemAlerts()=='') ? '' : $this->getSystemAlerts() . ' - ';
				$this->setSystemAlerts($previous.$alert);
			}
			return $this;
		}
		
		public function addCheck($check)
		{
			$this->checks[]=$check;
			return $this;
		}

		public function getChecks()
		{
			return $this->checks;
		}
		
		public function setCountFailedChecks($value)
		{
			$this->failedChecks=$value;
			return $this;
		}
		
		public function getCountFailedChecks()
		{
			return $this->failedChecks;
		}

		public function incCountFailedChecks()
		{
			$this->failedChecks++;
			return $this;
		}

		public function updateMiddlename($middlename)
		{
			if ($this->getMiddlename()=='')
			{
				$this->setMiddlename($middlename);
			}
			return $this;
		}
			
		public function updateEmail($value)
		{
			if ($this->getEmail()=='')
			{
				$this->setEmail($value);
			}
			return $this;
		}

		public function updateBirthplace($value)
		{
			if ($this->getBirthplace()=='')
			{
				$this->setBirthplace($value);
			}
			return $this;
		}
		public function updateBirthdate($value)
		{
			if ($this->getBirthdate()=='')
			{
				$this->setBirthdate($value);
			}
			return $this;
		}

		public function getGenderChoice()
		{
			switch($this->getGender())
			{
				case 'M': return 1;
				case 'F': return 0;
				default: return 2;
			}
		}

		public function setGenderChoice($gender)
		{
			switch($gender)
			{
				case 1: $this->setGender('M'); break;
				case 0: $this->setGender('F'); break;
				default: $this->setGender(null);
			}
			return $this;
		}
		public function __toString()
		{
				return $this->getFullName();
		}
        public function getFullName()
        {
                return $this->getFirstName() . ' ' . $this->getLastName();
        }

        public function getUsername()
        {
                return $this->getsfGuardUser()->getUsername();
        }

		public function getIsDeletable()
		{
			$appointments=AppointmentPeer::countAppointmentsOfUser($this->getUserId());
			$enrolments=EnrolmentPeer::countCurrentEnrolmentsOfUser($this->getUserId());
			if($appointments==0 && $enrolments==0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

        public function getCurrentAppointments()
        {
	        $c = new Criteria();
		$c->add(AppointmentPeer::USER_ID, $this->getUserId());
		$c->add(AppointmentPeer::YEAR_ID, sfConfig::get('app_config_current_year'));
		$t = AppointmentPeer::doSelectJoinAllExceptsfGuardUser($c);
		return $t;
        }

        public function getWorkplans()
        {
	    $c = new Criteria();
		$c->add(AppointmentPeer::USER_ID, $this->getUserId());
		$c->addDescendingOrderByColumn(AppointmentPeer::YEAR_ID);
		$c->addAscendingOrderByColumn(AppointmentPeer::STATE);
		$c->addAscendingOrderByColumn(AppointmentPeer::SCHOOLCLASS_ID);
		$c->addAscendingOrderByColumn(AppointmentPeer::SUBJECT_ID);
		$t = AppointmentPeer::doSelectJoinAll($c);
		return $t;
        }

        public function getTeams()
        {
	        $c = new Criteria();
		$c->add(UserTeamPeer::USER_ID, $this->getUserId());
		$t = UserTeamPeer::doSelectJoinAllExceptsfGuardUser($c);
		return $t;
        }

        public function getIsMale()
        {
            return $this->getGender()=='M' ? 1: 0;
        }


		protected function getGoogleappsAccountAlerts()
		
		{
		
			if($this->getGoogleappsAccountApprovedAt())
			{
				// The account is approved, we assume that the user should have it
				
				if($this->getGoogleappsAccountStatus()==0)
				{
					$this->addSystemAlert('googleapps account missing');
				}
			}
			else
			{
				// The account is not approved, so the user should not have it
				if($this->getGoogleappsAccountStatus()>0)
				{
					$this->addSystemAlert('googleapps account active but not approved');
				}
			}
		}

		public function GoogleappsEnable()
		{
			$this->setGoogleappsAccountApprovedAt(time());
			
			$temporaryPassword=rand(1000000,9999999);
			$this->setGoogleappsAccountTemporaryPassword($temporaryPassword);
			$this->save();
		}

		public function GoogleappsDisable()
		{
			$this->setGoogleappsAccountApprovedAt(null);
			$this->setGoogleappsAccountTemporaryPassword(null);
			$this->save();
		}

        protected function posix_getpwnam($username)
        {
			// We can't use posix_getpwnam() here, because it doesn't support /etc/nsswithc.conf setup
			// So we fallback to the old getent passwd as an external command

			$result=array();
			$return_var=0;
			$cmd = 'getent passwd ' . $username;
			exec($cmd, $result, $return_var);
			
			if ($return_var!=0)
			{
				return false;
			}

			$userinfo=array();

			list($userinfo['name'], $userinfo['passwd'], $userinfo['uid'], $userinfo['gid'], $userinfo['gecos'], $userinfo['dir'], $userinfo['shell'])=explode(':', $result[0]);

			$result=array();
			$cmd = sprintf('id -gn ' .$username);
			exec($cmd, $result, $return_var);

			$userinfo['group']=$result[0];
			return $userinfo;
			
		}

        protected function posix_getpwuid($uid)
        {
			// We can't use posix_getpwnam() here, because it doesn't support /etc/nsswithc.conf setup
			// So we fallback to the old getent passwd as an external command

			$result=array();
			$return_var=0;
			$cmd = sprintf('getent passwd | gawk \'BEGIN {FS=":"} {if ($3==%d) print $0}\' ', $uid);
			exec($cmd, $result, $return_var);
			
			if ($return_var!=0)
			{
				return false;
			}

			$userinfo=array();

			@list($userinfo['name'], $userinfo['passwd'], $userinfo['uid'], $userinfo['gid'], $userinfo['gecos'], $userinfo['dir'], $userinfo['shell'])=@explode(':', $result[0]);
			
			
			return $userinfo;
			
		}


		public function getQuotaInfo()
		{
		
			$result=array();
			$return_var=0;
			$cmd='schoolmesh_user_quotaget ' . $this->getUsername();
			exec($cmd, $result, $return_var);
			
			if(isset($result[0]))
				{
					$quotainfo=array();
					list(
						$quotainfo['used_blocks'],
						$quotainfo['soft_blocks_quota'],
						$quotainfo['hard_blocks_quota'],
						$quotainfo['blocks_grace'],
						$quotainfo['used_files'],
						$quotainfo['soft_files_quota'],
						$quotainfo['hard_files_quota'],
						$quotainfo['files_grace']
						) = explode(':', $result[0]);
					
					return $quotainfo;
				}
			else
			{
				return false;
			}

		}

		public function updateQuotaInfo()
		{

			$quotainfo=$this->getQuotaInfo();

			$this->setDiskUsedBlocks($quotainfo['used_blocks']);
			$this->setDiskUsedFiles($quotainfo['used_files']);
			$this->setDiskUpdatedAt(time());
			if($quotainfo['soft_blocks_quota']==0||$quotainfo['soft_files_quota']==0)
			{
				$this->addSystemAlert('disk quota not set');
			}
			elseif($quotainfo['used_blocks']>$quotainfo['soft_blocks_quota']*.8||$quotainfo['used_files']>$quotainfo['soft_files_quota']*.8)
			{
				$this->addSystemAlert('disk quota nearly reached');
			}
			$this->save();
			return $quotainfo;
			
		}


		public function getUsernameIsAlreadyUsed($username, $checkself=true)
		
		{

			if ($checkself && ($username==$this->getUsername()))
			{
				return false;
			}
				
			if(ReservedUsernamePeer::retrieveByUsername($username))
			{
				return true;
			}
			
			if(sfGuardUserProfilePeer::retrieveByUsername($username))
			
			{
				return true;
			}
			
			return false;
			
		}


		public function getUsernameIsValid($try='')
		{

			if ($try!='')
			{
				$username=$try;
				$checkself=false;
			}
			else
			{
				$username=$this->getUsername();
				$checkself=true;
			}
			
			if ($this->getUsernameIsAlreadyUsed($username, $checkself))
			{
				return false;
			}
			
			if (preg_match('/^[a-z][a-z0-9\.]{3,19}$/', $username))
			{
				return true;
			}
			
			return false;
			
		}

		public function checkPosix()
		{
			$checks=array();
			
			$role=RolePeer::retrieveByPK($this->getRoleId());
			
			// First thing, we see if the username is less than 20 characters long and matches a Regexp
			// Input form does this checks, but data could be changed in other manners (or badly uploaded)
			
			if (!$this->getUsernameIsValid())
				{
					$checks[]=new Check(false, 'username is not valid', $this->getFullName());
					$this->addSystemAlert('username not valid');
					$this->save();
					return $checks;
				}
			
			

			// Second, we see if there is a Posix account

			$userinfo = $this->posix_getpwnam($this->getUsername());
						
			if (!$userinfo)
				{
					// maybe the username has been changed
					
					if ($this->getPosixUid() && $userinfo= $this->posix_getpwuid($this->getPosixUid()))
								{
									
									// user exists, but username has been changed
									$checks[]=new Check(false, 'username has been changed', $this->getFullName(),
										array('command'=>sprintf(
											'schoolmesh_user_changeusername %s "%s" %s', 
											$this->getUsername(), 
											sfConfig::get('app_config_posix_homedir'), 
											$userinfo['name'])));
								}
					else
					{


					$checks[]=new Check(false, 'user does not exists', $this->getFullName(),
						array('command'=>sprintf(
							'schoolmesh_user_add %s "%s" %s "%s"',
							$this->getUsername(),
							sfConfig::get('app_config_posix_homedir'),
							$role->getPosixName(),
							$this->getFullname()
							))
					);
					}
					
				return $checks;
				}
				
			// From now on, we know that the user exists, since we got $userinfo
				
			$checks[]=new Check(true, 'user exists', $this->getFullName(), array('link_to'=>'users/edit?id='.$this->getsfGuardUser()->getId()));
			
			$this->setSystemAlerts('');
			
			// Let's check the UID
			
			if($this->getPosixUid()>0)
			{
				if($userinfo['uid']!=$this->getPosixUid())
				{
					$checks[]=new Check(false, 'UIDs do not match', $this->getFullName());
					$this->addSystemAlert(sprintf('system UID is %d', $userinfo['uid']));
				}
				else
				{
					$checks[]=new Check(true, 'UIDs match', $this->getFullName());
				}
			}
			else
			{
				$checks[]=new Check(true, 'UID saved', $this->getFullName());
				$this->setPosixUid($userinfo['uid']);
				$this->save();
			}
			
			if ($this->getFullName()==$userinfo['gecos'])
			{
				$checks[]=new Check(true, 'full name is ok', $this->getFullName());
			}
			else
			{
					$checks[]=new Check(false, 'full name is not ok', $this->getFullName(),
					array('command'=>sprintf('schoolmesh_user_changefullname "%s" %s', 
						$this->getFullname(),
						$this->getUsername()
						))
					);
				
			}
			
			if ($role->getPosixName()==$userinfo['group'])
			{
				$checks[]=new Check(true, 'main group is ok', $this->getFullName());
			}
			else
			{
					$checks[]=new Check(false, 'main group is not ok', $this->getFullName(),
					array('command'=>sprintf('schoolmesh_user_changegroup %s %s', 
						$role->getPosixName(),
						$this->getUsername()
						))
					);
				
			}
			
			if ($this->getGender()!='M' && $this->getGender()!='F')
			{
				$this->addSystemAlert('gender not set');
			}
			
			$this->getGoogleappsAccountAlerts();
			
			if ($this->getIsDeleted())
			{
					$checks[]=new Check(false, 'user must be deleted', $this->getFullName(),
					array('command'=>sprintf('schoolmesh_user_del %s', 
						$this->getUsername()
						))
					);
					return $checks;
			}
			
			$dir=sfConfig::get('app_config_posix_homedir') . '/' . $this->getUsername();
			$result=array();
			$return_var=0;
			$cmd = 'sudo stat -c "%F:%u:%g:%a" "'. $dir .'"';

			exec($cmd, $result, $return_var);
			// here we expect a result like "directory:<uid>:0:711"

			if ($return_var!=0)
			{
				$checks[]=new Check(false, 'missing home directory', $this->getFullName(),
				array('command'=>'sudo mkdir "' . $dir . '"'));
				
				return $checks;
				
			}
			
			list($type, $uid, $gid, $access)=explode(':', $result[0]);
			
			if ($type!='directory')
			{
				$checks[]=new Check(false, 'home directory is not a directory', $this->getFullName(),
					array('command'=>'echo "not a directory:"  "' . $dir . '"'));
				
				return $checks;
				
			}

			// Since now on, we assume that the directory exists

			$checks[]=new Check(true, 'home directory is correctly set', $this->getFullName());
				
			if ($access!='711')
			{
				$checks[]=new Check(false, 'home directory has not proper permissions', $this->getFullName(),
					array('command'=>sprintf('schoolmesh_dir_changeperms 711 "%s"', $dir)));
			}
			else
			{
				$checks[]=new Check(true, 'home directory has proper permissions', $this->getFullName());
			}
				
			if ($uid!=$this->getPosixUid() || $gid!=0)
			{
				$checks[]=new Check(false, 'home directory does not belong to user:root', $this->getFullName(),
					array('command'=>sprintf('schoolmesh_dir_changeowner %s "%s"', $this->getUsername(), $dir)));
			}
			else
			{
				$checks[]=new Check(true, 'home directory belongs to user', $this->getFullName());
			}

			$quotainfo=$this->updateQuotaInfo();
			
			if ($quotainfo['soft_blocks_quota']!=$this->getDiskSetSoftBlocksQuota()
				or $quotainfo['hard_blocks_quota']!=$this->getDiskSetHardBlocksQuota()
				or $quotainfo['soft_files_quota']!=$this->getDiskSetSoftFilesQuota()				
				or $quotainfo['soft_blocks_quota']!=$this->getDiskSetSoftBlocksQuota())
			{
				$checks[]=new Check(false, "set quotas do not match", $this->getFullName(),
					array('command'=>sprintf('schoolmesh_user_quotaset %s %d %d %d %d %s',
						$this->getUsername(),
						$this->getDiskSetSoftBlocksQuota(),
						$this->getDiskSetHardBlocksQuota(),
						$this->getDiskSetSoftFilesQuota(),
						$this->getDiskSetHardFilesQuota(),
						sfConfig::get('app_config_posix_homedir')
						)));
			}
			else
			{
				$checks[]=new Check(true, "set quotas match", $this->getFullName());
			}
				

			$basefolder=sfConfig::get('app_config_posix_homedir') . '/' . $this->getUsername() . '/'. sfConfig::get('app_config_posix_basefolder');
			$cmd = 'sudo stat -c "%F:%u:%g:%a" "'. $basefolder .'"';

			exec($cmd, $result, $return_var);
			// here we expect a result like "directory:<uid>:0:711"

			if ($return_var!=0)
			{
				$checks[]=new Check(false, 'missing basefolder', $this->getFullName(),
				array('command'=>'schoolmesh_dir_create "' . $basefolder . '"'));
				
				return $checks;
				
			}
			
			list($type, $uid, $gid, $access)=explode(':', $result[0]);
			
			if ($type!='directory')
			{
				$checks[]=new Check(false, 'basefolder is not a directory', $this->getFullName(),
					array('command'=>'echo "not a directory:"  "' . $basefolder . '"'));
				
				return $checks;
				
			}

			// Since now on, we assume that the basefolder exists
				
			if ($access!='711')
			{
				$checks[]=new Check(false, 'basefolder has not proper permissions', $this->getFullName(),
					array('command'=>sprintf('schoolmesh_dir_changeperms 711 "%s"', $basefolder)));
			}
			else
			{
				$checks[]=new Check(true, 'basefolder has proper permissions', $this->getFullName());
			}
				
			if ($uid!=$this->getPosixUid() || $gid!=0)
			{
				$checks[]=new Check(false, 'basefolder does not belong to user:root', $this->getFullName(),
					array('command'=>sprintf('schoolmesh_dir_changeowner %s "%s"', $this->getUsername(), $basefolder)));
			}
			else
			{
				$checks[]=new Check(true, 'basefolder belongs to user:root', $this->getFullName());
			}
				

			$result=array();
			$cmd = 'sudo lsattr -d "'. $basefolder .'"';

			exec($cmd, $result, $return_var);
			
			if (substr($result[0],4,1)!='i')
			{
				$checks[]=new Check(false, "basefolder has not immutable flag set", $this->getFullName(),
					array('command'=>sprintf('schoolmesh_dir_extattrset +i "%s"', $basefolder)));
			}
			else
			{
				$checks[]=new Check(true, "basefolder has immutable flag set", $this->getFullName());
			}



			return $checks;
		}


}