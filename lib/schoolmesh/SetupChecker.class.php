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
      'app_lucene_directory'=>'apps/frontend/config/app.yml',
      'app_sf_guard_plugin_check_password_callable'=>'apps/frontend/config/app.yml',
      'app_sf_guard_plugin_success_signout_url'=>'apps/frontend/config/app.yml',
      'app_opendocument_template_directory'=>'apps/frontend/config/app.yml',
      'app_documents_main_directory'=>'apps/frontend/config/app.yml',
      'app_documents_attachments'=>'apps/frontend/config/app.yml',
      'app_config_help_index'=>'apps/frontend/config/app.yml',
      'app_config_timeslotsfile'=>'apps/frontend/config/app.yml',
      'app_config_logfile'=>'apps/frontend/config/app.yml',
      'app_config_debug'=>'apps/frontend/config/app.yml',

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
      if(file_exists(sfConfig::get('app_mail_template_directory'). '/' . $file))
      {
        $checkList->addCheck(new Check(
          Check::PASSED,
          sprintf('File «%s» exists', $file),
          'mail templates'
          ));
      }
      else
      {
        $checkList->addCheck(new Check(
          Check::FAILED,
          sprintf('File «%s» does not exist', $file),
          'mail templates'
          ));
      }
    }

    return $checkList;
    
  }
  
  
};
