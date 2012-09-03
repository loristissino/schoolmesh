<?php
    class TwoFactorAuthenticationForm extends BaseForm
    {
      public function configure()
      {
  
        $this->setWidgets(array(
          'code' => new sfWidgetFormInputText(array(), array('size'=>10)),
          'remember_browser' => new sfWidgetFormInputCheckbox(),
              ));
  
        $this->widgetSchema->setNameFormat('signin[%s]');
        
        $this->setValidators(array(
          'code' => new sfValidatorString(array('required'=>true)),
          'remember_browser' => new sfValidatorBoolean(),
        ));
			
			}

	}
