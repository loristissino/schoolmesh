<?php
class SyncPasswordForm extends BaseForm
        {
          public function configure()
          {
			
            $this->setWidgets(array(
			  'current_password' => new sfWidgetFormInputPassword(array(), array('size'=>25)),
        'accept_terms'=> new sfWidgetFormInputCheckbox(),
			  'type'  => new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true)),
            ));
			
			$this->widgetSchema->setNameFormat('userinfo[%s]');
			
			$this->setValidators(array(
				'current_password' => new sfValidatorString(),
        'accept_terms'=> new sfValidatorBoolean(), 
				'type' => new sfValidatorString(),
			));
			
			}

	}