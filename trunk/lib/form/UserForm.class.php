<?php
        class UserForm extends sfForm
        {
          public function configure()
          {
			
			$years_min=sfConfig::get('app_config_current_year')-65;
			$years_max=sfConfig::get('app_config_current_year')-13;
			foreach(range($years_min, $years_max) as $year)
			{
				$years[$year]=$year;
			}

			
            $this->setWidgets(array(
			  'old_user_id'  => new sfWidgetFormInput(array('type'=>'hidden', 'is_hidden'=>true)),
			  'posix_uid' => new sfWidgetFormInput(),
			  'old_username' =>  new sfWidgetFormInput(array('type'=>'hidden', 'is_hidden'=>true)),
			  'username' => new sfWidgetFormInput(),
              'first_name'    => new sfWidgetFormInput(),
              'middle_name'   => new sfWidgetFormInput(),
              'last_name' => new sfWidgetFormInput(),
			  'email' => new sfWidgetFormInput(),
			  'birthdate' => new sfWidgetFormI18nDate(array('culture'=>'it', 'years'=>$years)),  
			  'main_role' => new sfWidgetFormPropelSelect(array('model'=>'role')),  
			  
            ));
			
			$this->widgetSchema->setNameFormat('userinfo[%s]');
			
			$this->setValidators(array(
				'username' => new sfValidatorAnd(array(
					new sfValidatorString(array('trim' => true, 'min_length'=>4, 'max_length'=>20)),
					new sfValidatorRegex(array('pattern'=>'/^[a-z.0-9]*$/')),
			)),
				'first_name' => new sfValidatorString(array('trim' => true)),
				'old_username' => new sfValidatorString(),
				'old_user_id' => new sfValidatorNumber(),
				'posix_uid' => new sfValidatorNumber(array('required'=>false)),  
				'last_name' => new sfValidatorString(array('trim' => true)),
				'middle_name'  => new sfValidatorString(array('trim' => true, 'required' => false)),
				'email'   => new sfValidatorEmail(array('trim' => true, 'required'=>false)),
				'birthdate' => new sfValidatorDate(array('required'=>false)),
				'main_role' => new sfValidatorPropelChoice(array('model'=>'role')),  
			));
/*

This seems to work only for new records, not when updating.

see http://groups.google.com/group/symfony-users/browse_thread/thread/7592a2a80dd1385


			$this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
					new sfValidatorPropelUnique(
						array('model'=>'ReservedUsername', 'column'=>'username', 'primary_key'=>'user_id'),
						array('invalid'=>'This is a reserved username')),
					new sfValidatorPropelUnique(
						array('model'=>'sfGuardUser', 'column'=>'username', 'field'=>'username'))
						))
					);
*/
			}

	}