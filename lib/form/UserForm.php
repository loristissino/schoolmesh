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
			  'username' => new sfWidgetFormInput(),
              'first_name'    => new sfWidgetFormInput(),
              'middle_name'   => new sfWidgetFormInput(),
              'last_name' => new sfWidgetFormInput(),
			  'email' => new sfWidgetFormInput(),
			  'birthdate' => new sfWidgetFormI18nDate(array('culture'=>'it', 'years'=>$years)),  
            ));
			
			$this->widgetSchema->setNameFormat('userinfo[%s]');
			
			$this->setValidators(array(
				'username' => new sfValidatorString(array('trim' => true, 'min_length'=>4)),
				'first_name' => new sfValidatorString(array('trim' => true)),
				'old_user_id' => new sfValidatorNumber(),
				'last_name' => new sfValidatorString(array('trim' => true)),
				'middle_name'  => new sfValidatorString(array('trim' => true, 'required' => false)),
				'email'   => new sfValidatorEmail(array('trim' => true, 'required'=>false)),
				'birthdate' => new sfValidatorDate(array('required'=>false))
			));

			
          }
        }
