<?php

class TeamEditJoiningForm extends BaseForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'id'  => new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true)),
      'team'  => new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true)),
      'role' => new sfWidgetFormPropelChoice(array('model'=>'role', 'add_empty'=>'Choose a role')),
      'expiry' => new sfWidgetFormI18nDate(array('culture'=>'it')),  

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
