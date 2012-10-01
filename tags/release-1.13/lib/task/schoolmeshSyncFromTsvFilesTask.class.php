<?php

define('OUTPUT_NULL', '«null»');

/**
 * schoolmeshSyncFromTsvFilesTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshSyncFromTsvFilesTask extends sfBaseTask
{
  
  private function _bool2text($bool)
  {
    return $bool?'true':'false';
  }
  
  private function _sendConfirmationMessage($permission, $type, $dryrun=false)
  {
    
    $base=$type . '_imported';
    
    if ($type=='users' and isset($this->notices['users']))
    {
      $text='';
      
      if(isset($this->notices['users']['imported']))
      {
        $text .= $this->context->getI18N()->__('New users') . ":\n";
        foreach($this->notices['users']['imported'] as $profile)
        {
          $text.='* ' .$profile->getUsername() . ' => ' . $profile->getFullName() . "\n";
          $text.='  ' .sfConfig::get('app_school_schoolmesh_url').'/users/edit?id=' . $profile->getId() . "\n\n";
        }
      }

      if(isset($this->notices['users']['failed']))
      {
        $text .= $this->context->getI18N()->__('Not imported users') . ":\n";
        foreach($this->notices['users']['failed'] as $value)
        {
          $text.='* ' .$value . "\n";
        }
      }
      
      
    }

    if ($type=='enrolments' and isset($this->notices['enrolments']))
    {
      $text='';
      
      foreach(array('new', 'updated') as $nu)
      {
        if(isset($this->notices['enrolments'][$nu]))
        {
          $t=$nu=='new'?'New enrolments':'Updated enrolments';
          
          $text .= $this->context->getI18N()->__($t) . ":\n";
          
          foreach($this->notices['enrolments'][$nu] as $enrolment)
          {
            $profile=$enrolment->getsfGuardUser()->getProfile();
            $text.='* ' .$profile->getFullName() . ' => ' . $enrolment->getSchoolclassId() . "\n";
            $text.='  ' .sfConfig::get('app_school_schoolmesh_url').'/users/edit?id=' . $profile->getId() . "#enrolments\n\n";
          }
        }
        $text.="\n";
      }
      
      if(isset($this->notices['enrolments']['failed']))
      {
        $text .= $this->context->getI18N()->__('Invalid data') . ":\n";
        
        foreach($this->notices['enrolments']['failed'] as $v)
        {
          $text.='* ' .$v['USER_IMPORT_CODE'] . ' ' . $v['SCHOOLCLASS_ID'] . "\n";
        }
        $text.="\n";
      }
      
    }

    if ($type=='appointments' and isset($this->notices['appointments']))
    {
      $text='';
      
      foreach(array('new', 'updated') as $nu)
      {
        if(isset($this->notices['appointments'][$nu]))
        {
          $t=$nu=='new'?'New appointments':'Updated appointments';
          
          $text .= $this->context->getI18N()->__($t) . ":\n";
          
          foreach($this->notices['appointments'][$nu] as $appointment)
          {
            if($appointment instanceof Appointment)
            {
              $profile=$appointment->getsfGuardUser()->getProfile();
              $text.='* ' .$profile->getFullName() . ' => ' . $appointment . "\n";
              $text.='  ' .sfConfig::get('app_school_schoolmesh_url').'/users/edit?id=' . $profile->getId() . "#appointments\n\n";
            }
            else
            {
              $text.=' (missing information -- this should not happen)' . "\n";
            }
          }
        }
        $text.="\n";
      }
      
      if(isset($this->notices['appointments']['failed']))
      {
        $text .= $this->context->getI18N()->__('Invalid data') . ":\n";
        
        foreach($this->notices['appointments']['failed'] as $v)
        {
          $text.='* ' .$v['USER_IMPORT_CODE'] . ' ' . $v['SCHOOLCLASS_ID'] . ' ' . $v['SUBJECT_SHORTCUT']. "\n";
        }
        $text.="\n";
      }
      
    }

      
    $users=sfGuardUserProfilePeer::retrieveByPermission($permission);
    
    $addressees='';
    if (sizeof($users)>1)
    {
      foreach($users as $user)
      {
        $addressees.=$user->getFullName()."\n";
      }
    }
    
    foreach($users as $user)
    {
      $user->sendWorkflowConfirmationMessage($this->context, $base, array(
        '%items%'=>$text,
        '%addressees%'=>($addressees=='' ? '' : $this->context->getI18N()->__('This message has been sent to:') . "\n" . $addressees),
        '%dryrun%'=>($dryrun ? '('.$this->context->getI18N()->__('simulation only') . ')' : ''),
        ));
      $this->logSection('mail@', sprintf('%s - %s (%s)', 
        $user->getUsername(), 
        sizeof($this->notices[$type]),
        $base
        ), null, 'NOTICE');
    }
    
    
  }

  private function _applyChanges($object, $type, $changes=array())
  {
    if(sizeof($changes))
    {
      $object->save($this->con);
      $this->notices[$type]['updated'][]=$object;
      $this->logSection(strtolower(get_class($object)) . '*', sprintf('%s: (%s)', $object, implode('; ', $changes)), null, 'NOTICE');
    }
  }
  
  protected function updateUsers(smTsvReader $tsv)
  {
    
    $count=0;
    
    $culture=sfConfig::get('app_config_culture');

    $teacherRole=RolePeer::retrieveByPosixName(sfConfig::get('app_config_teachers_default_posix_group'));
    $teacherGuardGroup=sfGuardGroupProfilePeer::retrieveGuardGroupByName($teacherRole->getDefaultGuardGroup());
		$studentRole=RolePeer::retrieveByPosixName(sfConfig::get('app_config_students_default_posix_group'));
    $studentGuardGroup=sfGuardGroupProfilePeer::retrieveGuardGroupByName($studentRole->getDefaultGuardGroup());
    
    while($v=$tsv->fetchAssoc())
    {
      // some hard-coded defaults:
      foreach(array(
        'MIDDLE_NAME'  => '', 
        'BIRTH_PLACE'  => '', 
        'BIRTH_DATE'   => '', 
        'EMAIL'        => '',
        'IS_ACTIVE'    => 0,
        'EXTRASEARCHKEY'  => '',
        ) as $vk=>$vv)
      {
        if(!isset($v[$vk])) $v[$vk]=$vv;
      }
      
      $profile=sfGuardUserProfilePeer::retrieveByImportCode($v['USER_IMPORT_CODE']);
      if($profile)
      {
        $changes=array();
        $uchanges=array();
        
        if($profile->getIsActive()!=$v['IS_ACTIVE'])
        {
          $profile->getsfGuardUser()->setIsActive($v['IS_ACTIVE'])->save();
          $uchanges[] = sprintf('active: %s -> %s', $this->_bool2text(!$v['IS_ACTIVE']), $this->_bool2text($v['IS_ACTIVE']));
        }
        
        if($profile->getStoredInfo('extrasearchkey')!=$v['EXTRASEARCHKEY'])
        {
          $old=$profile->getStoredInfo('extrasearchkey');
          $profile->setStoredInfo('extrasearchkey', $v['EXTRASEARCHKEY']);
          $changes[] = sprintf('extrasearchkey: %s -> %s', $old?$old:OUTPUT_NULL, $profile->getStoredInfo('extrasearchkey'));
        }
        
        $this->_applyChanges($profile->getsfGuardUser(), 'users', $uchanges);
        $this->_applyChanges($profile, 'users', $changes);
        
      }
      else
      {
        if(!$v['USER_IMPORT_CODE'])
        {
          $this->logSection('user/', $v['FIRST_NAME'] . ' ' . $v['LAST_NAME'] . ' (skipped: no import code)', null, 'ERROR');
          continue;
        }
        
        switch($v['TYPE'])
        {
          case 'S':
            $role=$studentRole;
            $guardgroup=$studentGuardGroup;
            break;
          case 'T':
            $role=$teacherRole;
            $guardgroup=$teacherGuardGroup;
            break;
          case 'O':
            $role=null;
            $guardgroup=null;
            break;
          default:
            $this->logSection('user/', $v['LAST_NAME'] . ' skipped', null, 'COMMENT');
        }
        
        $profile=new sfGuardUserProfile();
				
				$profile
				->setFirstName(Generic::clever_ucwords($culture, $v['FIRST_NAME']))
				->setMiddleName(Generic::clever_ucwords($culture, $v['MIDDLE_NAME']))
				->setLastName(Generic::clever_ucwords($culture, $v['LAST_NAME']))
				->setGender($v['GENDER'])
				->setBirthplace(Generic::clever_ucwords($culture, $v['BIRTH_PLACE']))
				->setBirthdate($v['BIRTH_DATE'])
				->setEmail($v['EMAIL'])
				->setImportCode($v['USER_IMPORT_CODE'])
        ->setStoredInfo('extrasearchkey', $v['EXTRASEARCHKEY'])
        ;
        
        if($v['TYPE']=='T')
        {
          $profile->setLettertitle($profile->getIsMale()? sfConfig::get('app_config_default_male_teachertitle', 'Mr'): sfConfig::get('app_config_default_female_teachertitle', 'Ms'));
        }
        
        $profile->setRole($role);

        $user = new sfGuardUser();
        
        if(array_key_exists('USERNAME', $v) and $v['USERNAME'])
        {
          $username=$v['USERNAME'];
        }
        else
        {
          $username_found=$profile->findGoodUsername();
          $username=$username_found['username'];
        }

        if(sfGuardUserProfilePeer::retrieveByUsername($username))
        {
          // we cannot use a try-catch, because we would cause nested transactions...
          // so we check the presence before inserting...
          $this->logSection('user', $username . ' => ' . $v['FIRST_NAME'] . ' ' . $v['LAST_NAME'], null, 'ERROR');
          $this->notices['users']['failed'][]=$v['FIRST_NAME'] . ' ' . $v['LAST_NAME'];
        }
        else
        {
          
          $password=Authentication::generateRandomPassword();
          
          $user
          ->setUsername($username)
          ->setPassword($password)
          ;
          $user->save($this->con);
          $profile
          ->setUserId($user->getId())
          ->setPlaintextPassword($password)
          ->setStoredEncryptedPassword($password)
          ->setPreferredFormat('odt')
          ->setPreferredCulture(sfConfig::get('app_config_culture'))
          ->save($this->con);
          
          $this->notices['users']['imported'][]=$profile;

          // we do this now, because we could not before, since the object was not yet saved
          if($guardgroup)
          {
            $profile->addToGuardGroup($guardgroup);
          }

          $this->logSection('user+', $profile->getUsername() . ' => ' . $profile->getFullName(), null, 'NOTICE');
        }
        
        $count++;

      }
    }
    
   return $count;
    
  }

  protected function updateEnrolments(smTsvReader $tsv)
  {
    $count=0;
        
    while($v=$tsv->fetchAssoc())
    {
      $enrolment=EnrolmentPeer::retrieveByImportCode($v['USER_IMPORT_CODE']);
      if($enrolment)
      {
        $changes=array();
        $uchanges=array();
        if($enrolment->getSchoolclassId()!=$v['SCHOOLCLASS_ID'])
        {
          $schoolclass=SchoolclassPeer::retrieveByPK($v['SCHOOLCLASS_ID']);
          if($schoolclass)
          {
            $old=$enrolment->getSchoolclassId()?$enrolment->getSchoolclassId():OUTPUT_NULL;
            $enrolment->setSchoolclass($schoolclass);
            
            $changes[] = sprintf('class: %s -> %s', $old, $enrolment->getSchoolclassId());
          }
          else
          {
            $this->notices['enrolments']['failed'][]=$v;
            $this->logSection('enrolment', sprintf('%s:%s', $v['USER_IMPORT_CODE'], $v['SCHOOLCLASS_ID']), null, 'ERROR');
          }
        }
        
        if(!$enrolment->getSfGuardUser()->getIsActive())
        {
          $enrolment->getSfGuardUser()->setIsActive(true);
          $uchanges[]= sprintf('state: inactive -> active');
        }
        
        $this->_applyChanges($enrolment, 'enrolments', $changes);
        $this->_applyChanges($enrolment->getSfGuardUser(), 'users', $uchanges);
        
      }
      else
      {
        $profile=sfGuardUserProfilePeer::retrieveByImportCode($v['USER_IMPORT_CODE']);
        $schoolclass=SchoolclassPeer::retrieveByPK($v['SCHOOLCLASS_ID']);
        if(!$profile or !$schoolclass)
        {
          $this->notices['enrolments']['failed'][]=$v;
          $this->logSection('enrolment', sprintf('%s:%s', $v['USER_IMPORT_CODE'], $v['SCHOOLCLASS_ID']), null, 'ERROR');
          $count++;
          continue;
        }
        
        $enrolment = new Enrolment();
        $enrolment
        ->setSchoolclass($schoolclass)
        ->setUserId($profile->getUserId())
        ->setYearId(sfConfig::get('app_config_current_year'))
        ->save($this->con)
        ;
        
        $this->notices['enrolments']['new'][]=$enrolment;
        $this->logSection('enrolment+', sprintf('%s:%s', $v['USER_IMPORT_CODE'], $v['SCHOOLCLASS_ID']), null, 'NOTICE');
        $count++;
        
      }
    } 
    
    return $count;

    
  }

  protected function updateAppointments(smTsvReader $tsv)
  {
    $count=0;
        
    while($v=$tsv->fetchAssoc())
    {
      $hours=$v['HOURS']*sfConfig::get('app_config_year_weeks', 33);
      $newtype=isset($v['TYPE_SHORTCUT'])?$v['TYPE_SHORTCUT']:sfConfig::get('app_config_default_appointment_type', null);
      $newsyllabus=isset($v['SYLLABUS_ID'])?$v['SYLLABUS_ID']:sfConfig::get('app_config_default_syllabus', null);
      $appointment=AppointmentPeer::retrieveByImportCodeSchoolclassIdSubjectShortcut(
        $v['USER_IMPORT_CODE'],
        $v['SCHOOLCLASS_ID'],
        $v['SUBJECT_SHORTCUT']
        );
      if($appointment)
      {
        
        $changes=array();
        
        if($appointment->getHours()!=$hours)
        {
          $old=$appointment->getHours();
          $appointment->setHours($hours);
          $changes[] = sprintf('hours: %d -> %d', $old, $appointment->getHours());
        }

        if(!$appointment->getState())
        {
          $appointment->setState(Workflow::AP_ASSIGNED);
          $changes[] = sprintf('state: %s -> %d', OUTPUT_NULL, $appointment->getState());
        }

        $old=$appointment->getAppointmentTypeId() ? $appointment->getAppointmentType()->getShortCut() : null;
        if($old!=$newtype)
        {
          $type=AppointmentTypePeer::retrieveByShortcut($newtype);
          if($type)
          {
            $appointment->setAppointmentTypeId($type->getId());
            if(!$old)
            {
              $old=OUTPUT_NULL;
            }
            $changes[] = sprintf('type: %s -> %s', $old, $type->getShortcut());
          }
        }
        
        $old=$appointment->getSyllabusId();
        if($old!=$newsyllabus)
        {
          $syllabus=SyllabusPeer::retrieveByPK($newsyllabus);
          if($syllabus)
          {
            $appointment->setSyllabusId($syllabus->getId());
            if(!$old)
            {
              $old=OUTPUT_NULL;
            }
            $changes[] = sprintf('syllabus: %s -> %s', $old, $syllabus->getId());
          }
        }
        
        $this->_applyChanges($appointment, 'appointments', $changes);
        $count++;
        
      }
      else
      {
        $profile=sfGuardUserProfilePeer::retrieveByImportCode($v['USER_IMPORT_CODE']);
        $schoolclass=SchoolclassPeer::retrieveByPK($v['SCHOOLCLASS_ID']);
        $subject=SubjectPeer::retrieveByShortcut($v['SUBJECT_SHORTCUT']);
        $type=AppointmentTypePeer::retrieveByShortcut($newtype);
        $syllabus=SyllabusPeer::retrieveByPK($newsyllabus);
        if(!$profile or !$schoolclass or !$subject or !$type)
        {
          $this->notices['appointments']['failed'][]=$v;
          $this->logSection('appointment', sprintf('%s:%s:%s', $v['USER_IMPORT_CODE'], $v['SCHOOLCLASS_ID'], $v['SUBJECT_SHORTCUT']), null, 'ERROR');
          if(!$profile)
          {
            echo "-- profile not found\n";
          }
          if(!$schoolclass)
          {
            echo "-- class not found\n";
          }
          if(!$subject)
          {
            echo "-- subject not found\n";
          }
          if(!$type)
          {
            echo "-- type not found: $newtype\n";
          }
          $count++;
          continue;
        }
        
        $appointment = new Appointment();
        $appointment
        ->setUserId($profile->getUserId())
        ->setSubject($subject)
        ->setSchoolclass($schoolclass)
        ->setYearId(sfConfig::get('app_config_current_year'))
        ->setState(Workflow::AP_ASSIGNED)
        ->setSyllabus($syllabus)
        ->save($this->con)
        ;
        $this->notices['appointments']['new'][]=$v;
        $this->logSection('appointment+', $appointment, null, 'NOTICE');
        
      }
    } 
    
    return $count;
    
  }

  protected function updatePwdsync(smTsvReader $tsv)
  {
    //this just delete encrypted passwords for users, after synchronization
    $count=0;
        
    while($v=$tsv->fetchAssoc())
    {
      $user = sfGuardUserProfilePeer::retrieveByUsername($v['USERNAME']);
      if($user)
      {
        if($user->getProfile()->clearEncryptedPassword())
        {
          $this->logSection('password-', $v['USERNAME'], null, 'NOTICE');
          $count++;
        }
      }
    }
    return $count;
  }

  
  protected function configure()
  {

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      new sfCommandOption('dry-run', null, sfCommandOption::PARAMETER_NONE, 'Whether the command will be executed leaving the db intact'),
      new sfCommandOption('no-mail', null, sfCommandOption::PARAMETER_NONE, 'Whether email notices should be avoided'),
    ));
    
    $this->addArgument('type', sfCommandArgument::REQUIRED, 'The information type to update');
    $this->addArgument('file', sfCommandArgument::REQUIRED, 'The tsv file to read information from');

    $this->namespace        = 'schoolmesh';
    $this->name             = 'sync-from-tsv-files';
    $this->briefDescription = 'Synchronizes DB from information read by tab-separated-values files.';
    $this->detailedDescription = <<<EOF
This task will update the database taking information from TSV files properly formatted.
EOF;
  }


  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    $this->context = sfContext::createInstance($this->configuration);

    $this->con = Propel::getConnection(AppointmentPeer::DATABASE_NAME);
		$this->con->beginTransaction();

    $type=$arguments['type'];

    $tsvfile=$arguments['file'];
    
    if(!is_readable($tsvfile))
    {
      throw new Exception('File not readable: ' . $tsvfile);
    }
    
    $tsv=new smTsvReader($tsvfile);
    $tsv->open();

    $validtypes=array('users', 'enrolments', 'appointments', 'pwdsync');
    
    switch ($type)
    {
      case 'users':
        $count = $this->updateUsers($tsv);
        break;
      case 'enrolments':
        $count = $this->updateEnrolments($tsv);
        break;
      case 'appointments':
        $count = $this->updateAppointments($tsv);
        break;
      case 'pwdsync':
        $this->updatePwdsync($tsv);
        $count = 0; // we don't need emails about this...
        break;
      default:
        throw new Exception("Not a valid type specified. Should be one of the following:\n  -" . implode ("\n  -", $validtypes));
    }

    if(!$options['no-mail'])
    {
      if($count>0)
      {
        $this->_sendConfirmationMessage('backadmin', $type, $options['dry-run']);
      }
    }
    
    if ($options['dry-run'])
    {
      echo "Rolled back!\n";
      $this->con->rollback();
    }
    else
    {
      echo "Executed!\n";
      $this->con->commit();
    }

  }

}
