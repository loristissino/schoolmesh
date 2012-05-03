<?php

/**
 * schoolmeshFixAppointmentsTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class schoolmeshFixAppointmentsTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
	    new sfCommandOption('year', null, sfCommandOption::PARAMETER_REQUIRED, 'School year', ''), 
	    new sfCommandOption('subject', null, sfCommandOption::PARAMETER_REQUIRED, 'Subject shortcut', ''), 
      new sfCommandOption('dry-run', null, sfCommandOption::PARAMETER_NONE, 'Whether the command will be executed leaving the db intact'),
      new sfCommandOption('also-not-submitted', null, sfCommandOption::PARAMETER_NONE, 'Whether the documents not yet submitted must be considered'),
      new sfCommandOption('replace-bad-formatted-contents', null, sfCommandOption::PARAMETER_NONE, 'Whether some common errors in contents formatting must be fixed'),
    ));

    $this->namespace        = 'schoolmesh';
    $this->name             = 'fix-appointments';
    $this->briefDescription = 'Fixes appointments, making all needed checks';
    $this->detailedDescription = <<<EOF
This task can be used for several general checks and fixes about appointments.
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    $year=YearPeer::retrieveByDescription($options['year']);
    if (!$year)
    {
      $this->log($this->formatter->format('Not a valid year specified: ' . $options['year'], 'ERROR'));
      return false;
    }

    $con = Propel::getConnection(AppointmentPeer::DATABASE_NAME);
		$con->beginTransaction();

    $c=new Criteria();
    $c->add(AppointmentPeer::YEAR_ID, $year);

    $appointments=AppointmentPeer::doSelect($c);
    foreach($appointments as $appointment)
    {
      $this->logSection('appoint. '.$appointment->getId(), 'under check...', null, 'COMMENT');
      
      if($appointment->getState()>Workflow::WP_DRAFT)
      {
        $dateA=$appointment->getUpdatedAt();
        
        $dirtyA=false;
        
        if(!$appointment->getIsPublic())
        {
          $appointment
          ->setIsPublic(true)
          ->save($con);
          $dirtyA=true;
        }
        
        if($dirtyA)
        {
          $appointment
          ->setUpdatedAt($dateA)
          ->save($con);
          $this->logSection('appoint. '.$appointment->getId(), 'fixed public bit', null, 'NOTICE');
        }
      }
      if($options['also-not-submitted'] || $appointment->getState()>Workflow::WP_DRAFT)
      {
        $count=0;

          foreach($appointment->getWpinfos() as $wpinfo)
          {
            $date=$wpinfo->getUpdatedAt();
            if($options['replace-bad-formatted-contents'])
            {
              $dirty=false;
              
              $old=$wpinfo->getContent();
              $new=ltrim(rtrim($old));
              if($old!=$new)
              {
                $wpinfo->setContent($new);
                $dirty=true;
              }
            
              if($wpinfo->getContent() && $wpinfo->getWpinfoType()->getStateMin()>$appointment->getState())
              {
                $this->logSection('wpinfo-', sprintf('%d, removed content «%s» ', $wpinfo->getId(), $new), null, 'INFO');
                $wpinfo->setContent('');
                $dirty=true;
              }
            
              if($dirty)
              {
                $wpinfo->save($con);
                $wpinfo
                ->setUpdatedAt($date)
                ->save($con)
                ;
              }
            } // end if replace wrong-contents
          }


          foreach($appointment->getWpmodules() as $wpmodule)
          {
            $date=$wpmodule->getUpdatedAt();
            
            if($options['replace-bad-formatted-contents'])
            {
              $dirtyW=false;
              
              if(strpos($wpmodule->getTitle(), '---')!==false)
              {
                $old=$wpmodule->getTitle();
                $new=str_replace('---', '', $old);
                $this->logSection('wpmodule ' . $wpmodule->getId(), sprintf('replaced «%s» with «%s»', $old, $new), null, 'NOTICE');
                $wpmodule->setTitle($new);
                $dirtyW=true;
              }
              
              $old=$wpmodule->getTitle();
              $new=ltrim(rtrim($old));
              if($old!=$new)
              {
                $this->logSection('wpmodule ' . $wpmodule->getId(), sprintf('replaced «%s» with «%s»', $old, $new), null, 'NOTICE');
                $wpmodule->setTitle($new);
                $dirtyW=true;
              }


              if(strpos($wpmodule->getPeriod(), '---')!==false)
              {
                $old=$wpmodule->getPeriod();
                $new=str_replace('---', '', $old);
                $this->logSection('wpmodule ' . $wpmodule->getId(), sprintf('replaced «%s» with «%s»', $old, $new), null, 'NOTICE');
                $wpmodule->setPeriod($new);
                $dirtyW=true;
              }
              if($dirtyW)
              {
                $wpmodule->save($con);
                $wpmodule
                ->setUpdatedAt($date)
                ->save($con)
                ;
              }
            } // end if replace-bad-formatted-contents
          
          if($appointment->getState()>=Workflow::IR_DRAFT)
          {
            if(!$wpmodule->getIsPublic())
            {
              // It seems that it happened, we must introduce transactions to avoid this problem
              $wpmodule
              ->setIsPublic(true)
              ->save($con)
              ;
              $wpmodule
              ->setUpdatedAt($date)
              ->save($con)
              ;
              
              $this->logSection('wpmodule ' . $wpmodule->getId(), 'fixed public bit', null, 'NOTICE'); 
            }
          }

          if($wpmodule->getUserId()!=$appointment->getUserId())
          {
            // It was reassigned...
            $wpmodule
            ->setUserId($appointment->getUserId())
            ->save($con)
            ;
            $this->logSection('wpmodule ' . $wpmodule->getId(), sprintf('changed owner to %s', $appointment->getOwner()), null, 'NOTICE'); 
          }
          
          foreach($wpmodule->getWpItemGroups() as $WpitemGroup)
          {
            if($WpitemGroup->getWpitemType()->getStateMin()>$appointment->getState())
            {
              // imported by error
              if($WpitemGroup->countWpmoduleItems())
              {
                $this->logSection('wpitemgroup-', 'removed children items (id=' . $WpitemGroup->getId() . ')', null, 'NOTICE');
                $WpitemGroup->deleteItems($con);
              }
            }

            if($options['replace-bad-formatted-contents'])
            {
            
              foreach($WpitemGroup->getWpmoduleItems() as $Wpitem)
              {
                $old=$Wpitem->getContent();
                $new=$old;
                $new=str_replace('---', '', $new);
                $new=str_replace(array("\r\n", "\n", "\r", '  '), ' ', $new);

                if($new!=$old)
                {
                  $Wpitem
                  ->setContent($new)
                  ->save($con);
                  $this->logSection('wpitem ' . $Wpitem->getId(), sprintf('replaced «%s» with «%s»', $old, $new), null, 'NOTICE');
                  echo "»»» OLD TEXT «««\n";
                  echo $old . "\n";
                  echo "»»» NEW TEXT «««\n";
                  echo $new . "\n";
                  echo "^^^^^^^^^^^^^^^^\n";
                }
              }
            } // end if replace-wrong-contents
          }
        }
        if($count>0)
        {
          $this->logSection('appoint.'.$appointment->getId(), sprintf('fixed %d module(s)', $count), null, 'NOTICE');
        }
      }

      if($appointment->getState()>=Workflow::IR_DRAFT)
        {
          $seen=array();
          foreach($appointment->getWpmoduleSyllabusItems() as $wpmoduleSyllabusItem)
          {
            //echo "wmsi:      ". $wpmoduleSyllabusItem->getId() . "\n";
            //echo "wmsi_siid: ". $wpmoduleSyllabusItem->getSyllabusItemId() . "\n";
            if($wpmoduleSyllabusItem->getEvaluation()==-1)
            {
              //echo "value -1, skipped\n";
              continue;
            }
            if (!in_array($wpmoduleSyllabusItem->getSyllabusItemId(), $seen))
            {
              $seen[]=$wpmoduleSyllabusItem->getSyllabusItemId();
              //echo "Seen: \n"; print_r($seen);
            }
            else
            {
              if($wpmoduleSyllabusItem->getEvaluation()!=-1)
              {
                $wpmoduleSyllabusItem
                ->setEvaluation(-1)
                ->save($con);
                $this->logSection('appoint. '.$appointment->getId(), sprintf('set syllabus item %d to unused', $wpmoduleSyllabusItem->getId()), null, 'NOTICE');
              }
              else
              {
                //echo "Left untouched\n";
              }
            }
          }
        }
      
      $checkList=$appointment->getChecks($con);
      
	  }  // appointment loop
    
    if ($options['dry-run'])
    {
      echo "Rolled back!\n";
      $con->rollback();
    }
    else
    {
      echo "Executed!\n";
      $con->commit();
    }

  } // execute function

}  // class
