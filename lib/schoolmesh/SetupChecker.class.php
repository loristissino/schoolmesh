<?php

class SetupChecker
{
  
  public function getChecks()
  {
    $checkList=new CheckList();

    foreach(array(
      'app_school_name'=>'apps/frontend/config/app.yml',
      'app_school_website'=>'apps/frontend/config/app.yml',
      'app_school_principal'=>'apps/frontend/config/app.yml',
      'app_mail_template_directory'=>'apps/frontend/config/app.yml',
      'app_mail_webmaster'=>'apps/frontend/config/app.yml',
      'app_config_current_year'=>'apps/frontend/config/app.yml',
      'app_config_current_term'=>'apps/frontend/config/app.yml',
      'app_config_teachers_default_posix_group'=>'apps/frontend/config/app.yml',
      'app_config_students_default_posix_group'=>'apps/frontend/config/app.yml',
      'app_config_default_teams_role'=>'apps/frontend/config/app.yml',
      'app_lucene_directory'=>'apps/frontend/config/app.yml',
      'app_sf_guard_plugin_success_signout_url'=>'apps/frontend/config/app.yml',
      'app_opendocument_template_directory'=>'apps/frontend/config/app.yml',
      'app_documents_main_directory'=>'apps/frontend/config/app.yml',
      'app_documents_attachments'=>'apps/frontend/config/app.yml',
      'app_config_help_index'=>'apps/frontend/config/app.yml',
      'app_config_timeslotsfile'=>'apps/frontend/config/app.yml',
      'app_config_logfile'=>'apps/frontend/config/app.yml',
      ) as $item=>$group)
    {
      if($text=sfConfig::get($item))
      {
        $checkList->addCheck(new Check(
          Check::PASSED,
          sprintf('%s is set («%s»)', $item, is_array($text)? serialize($text): $text),
          $group
          ));
      }
      else
      {
        $checkList->addCheck(new Check(
          Check::FAILED,
          $item . ' is not set',
          $group
          ));
      }
    }

    foreach(array(
      'app_sf_guard_plugin_check_password_callable'=>'apps/frontend/config/app.yml',
      'app_config_default_male_teachertitle'=>'apps/frontend/config/app.yml',
      'app_config_default_female_teachertitle'=>'apps/frontend/config/app.yml',
      'app_opendocument_formats'=>'apps/frontend/config/app.yml',
      ) as $item=>$group)
    {
      if($text=sfConfig::get($item))
      {
        $checkList->addCheck(new Check(
          Check::PASSED,
          sprintf('%s is set («%s»)', $item, is_array($text)? serialize($text): $text),
          $group
          ));
      }
      else
      {
        $checkList->addCheck(new Check(
          Check::WARNING,
          $item . ' is not set, the default value will be used',
          $group
          ));
      }
    }

    foreach(array(
      'document_approval.yml',
      'document_rejection.yml',
      'document_submission.yml',
      'email_change_confirmation.yml',
      'informative_message.yml',
      'project_activity.yml',
      'project_alert.yml',
      'projects_submission.yml',
      ) as $file)
    {
      $path=sfConfig::get('app_mail_template_directory'). '/' . $file;
      if(file_exists($path))
      {
        $checkList->addCheck(new Check(
          Check::PASSED,
          sprintf('File «%s» exists', $path),
          'mail templates'
          ));
      }
      else
      {
        $checkList->addCheck(new Check(
          Check::FAILED,
          sprintf('File «%s» does not exist', $path),
          'mail templates'
          ));
      }
    }


    foreach(array(
      'projects_charges.odt',
      'projects_submission.odt',
      'recuperation.odt',
      'teachers_signs.odt',
      'workplan20_n.odt',
      'workplan20_s.odt',
      'workplan30_n.odt',
      'workplan30_s.odt',
      'workplan40_n.odt',
      'workplan40_s.odt',
      'workplan41_n.odt',
      'workplan41_s.odt',
      'workplan50_n.odt',
      'workplan50_s.odt',
      'workplan60_n.odt',
      'workplan60_s.odt',
      'workplan70_n.odt',
      'workplan70_s.odt',
      'workplan80_n.odt',
      'workplan80_s.odt',
      'workplan90_n.odt',
      'workplan90_s.odt',
      ) as $file)
    {
      $path=sfConfig::get('app_opendocument_template_directory'). '/' . $file;
      if(file_exists($path))
      {
        $checkList->addCheck(new Check(
          Check::PASSED,
          sprintf('File «%s» exists', $path),
          'opendocument templates'
          ));
      }
      else
      {
        $checkList->addCheck(new Check(
          Check::FAILED,
          sprintf('File «%s» does not exist', $path),
          'opendocument templates'
          ));
      }
    }

    foreach(array(
      'userlist_googleapps.odt',
      'userlist_htmltable.odt',
      'userlist_teachersregisterheading.odt',
      ) as $file)
    {
      $path=sfConfig::get('app_opendocument_template_directory'). '/' . $file;
      if(file_exists($path))
      {
        $checkList->addCheck(new Check(
          Check::PASSED,
          sprintf('File «%s» exists', $path),
          'opendocument templates'
          ));
      }
      else
      {
        $checkList->addCheck(new Check(
          Check::WARNING,
          sprintf('File «%s» does not exist (but maybe you do not really need it)', $path),
          'opendocument templates'
          ));
      }
    }



    foreach(RolePeer::retrieveMainRoles() as $role)
    {
      $path=sfConfig::get('app_opendocument_template_directory'). '/welcomeletter_' . $role->getPosixName() . '.odt';
      if(file_exists($path))
      {
        $checkList->addCheck(new Check(
          Check::PASSED,
          sprintf('File «%s» exists', $path),
          'opendocument templates'
          ));
      }
      else
      {
        $checkList->addCheck(new Check(
          Check::FAILED,
          sprintf('File «%s» does not exist', $path),
          'opendocument templates'
          ));
      }
    }


    return $checkList;
    
  }
  
  
};
