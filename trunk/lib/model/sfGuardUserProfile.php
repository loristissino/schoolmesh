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


		public function isValidUsername($username)
		
		{
			
			if ($username==$this->getUsername())
			{
				return true;
			}
				
			if(!($user=ReservedUsernamePeer::retrieveByUsername($username) or sfGuardUserProfilePeer::retrieveByUsername($username)))
			
			{
				return true;
			}
			
			return false;
			
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


		public function checkPosix()
		{
			$checks=array();

			// First, we see if there is a Posix account

			$userinfo = $this->posix_getpwnam($this->getUsername());
						
			if (!$userinfo)
				{
					// maybe the username has been changed
					
					if ($this->getPosixUid() && $userinfo= $this->posix_getpwuid($this->getPosixUid()))
								{
									
									// user exists, but username has been changed
									$checks[]=new Check(false, 'username has been changed', $this->getFullName(),
										array('command'=>
											sprintf('sudo usermod -l %s -d "%s" %s', $this->getUsername(), sfConfig::get('app_config_posix_homedir') .'/'. $this->getUsername(), $userinfo['name'])));
								}

					else
					{

					$role=RolePeer::retrieveByPK($this->getRoleId());

					$checks[]=new Check(false, 'user does not exists', $this->getFullName(),
					array('command'=>'sudo useradd -d ' . sfConfig::get('app_config_posix_homedir') .'/'. $this->getUsername() . ' -m -s /bin/false -g ' . $role->getPosixName() . ' ' . $this->getUsername())
					);
					}
					
				return $checks;
				}
				
			// From now on, we know that the user exists, since we got $userinfo
				
			$checks[]=new Check(true, 'user exists', $this->getFullName());
			
			// Let's check the UID
			
			if($this->getPosixUid()>0)
			{
				if($userinfo['uid']!=$this->getPosixUid())
				{
					$checks[]=new Check(false, 'UIDs do not match', $this->getFullName(),
					array('command'=>sprintf('echo "Check UID of user %s (%d in the DB, %d in the system)"', 
						$this->getUsername(),
						$this->getPosixUid(),
						$userinfo['uid'])
						)
					);
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
					array('command'=>sprintf('sudo usermod -c "%s" %s', 
						$this->getFullname(),
						$this->getUsername()
						))
					);
				
			}
			
			$dir=sfConfig::get('app_config_posix_homedir') . '/' . $this->getUsername();
			$result=array();
			$return_var=0;
			$cmd = 'sudo stat -c "%F:%u:%a" "'. $dir .'"';

			exec($cmd, $result, $return_var);
			// here we expect a result like "directory:<uid>:711"

			if ($return_var!=0)
			{
				$checks[]=new Check(false, 'missing home directory', $this->getFullName(),
				array('command'=>'sudo mkdir "' . $dir . '"'));
				
				return $checks;
				
			}
			
			list($type, $uid, $access)=explode(':', $result[0]);
			
			if ($type!='directory')
			{
				$checks[]=new Check(false, 'home directory is not a directory', $this->getFullName(),
					array('command'=>'echo "not a directory:"  "' . $dir . '"'));
				
				return $checks;
				
			}

			// Since now on, we assume that the directory exists

			if ($userinfo['dir']!=$dir)
			{
				$checks[]=new Check(false, 'home directory is not correctly set', $this->getFullName(),
					array('command'=>sprintf('sudo usermod -d "%s" %s', $dir, $this->getUsername())));
				}

			return $checks;
		}


}
