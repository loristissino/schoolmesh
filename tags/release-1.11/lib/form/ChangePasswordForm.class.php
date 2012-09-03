<?php
        class ChangePasswordForm extends BaseForm
        {
          public function configure()
          {
			
            $this->setWidgets(array(
			  'current_password' => new sfWidgetFormInputPassword(array(), array('size'=>25)),
			  'password' => new sfWidgetFormInputPassword(array(), array('size'=>25, 'class'=>'password')),
			  'password_again' => new sfWidgetFormInputPassword(array(), array('size'=>25)),
			  'type'  => new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true)),
            ));
			
			$this->widgetSchema->setNameFormat('userinfo[%s]');
			
			$this->setValidators(array(
				'current_password' => new sfValidatorString(),
				'password' => new sfValidatorString(array('min_length'=>7), array('min_length' => 'The password must be of 7 characters (minimum)')),
				'password_again' => new sfValidatorString(array('min_length'=>7), array('min_length' => 'The password must be of 7 characters (minimum)')),
				'type' => new sfValidatorString(),
			));
			
			$this->validatorSchema->setPostValidator(
					new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again', array(), array('invalid'=>'Passwords do not match.'))
					);
			}

	}
