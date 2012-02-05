<?php

class TeamEditJoiningForm extends BaseForm
{
  public function configure()
  {
    
    $years=Generic::getNumbersBetweenAsOptionsArray(sfConfig::get('app_config_current_year'), sfConfig::get('app_config_current_year')+5);
    $this->setWidgets(array(
      'id'  => new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true)),
      'team'  => new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true)),
      'role' => new sfWidgetFormPropelChoice(array('model'=>'role', 'add_empty'=>'Choose a role')),
      'expiry' => new sfWidgetFormI18nDate(array('culture'=>sfConfig::get('sf_default_culture'), 'years'=>$years)),  

      ));

    $this->widgetSchema->setNameFormat('info[%s]');
			
    $this->setValidators(array(
      'id' => new sfValidatorInteger(),
      'team' => new sfValidatorInteger(),
      'role' => new sfValidatorPropelChoice(array('model'=>'role')), 
      'expiry' => new sfValidatorDate(array('required'=>false)), 
    ));
			
  }

}
