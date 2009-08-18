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
			  'id'  => new sfWidgetFormInput(array('type'=>'hidden', 'is_hidden'=>true)),
			  'old_username' =>  new sfWidgetFormInput(array('type'=>'hidden', 'is_hidden'=>true)),
			  'username' => new sfWidgetFormInput(array(), array('size'=>25)),
			  'is_active'=> new sfWidgetFormSelect(array('choices' =>array('no', 'yes'))), 
              'first_name'    => new sfWidgetFormInput(array(), array('size'=>50)),
              'middle_name'   => new sfWidgetFormInput(array(), array('size'=>15)),
              'last_name' => new sfWidgetFormInput(array(), array('size'=>50)),
              'pronunciation' => new sfWidgetFormInput(array(), array('size'=>70)),
			  'gender' => new sfWidgetFormSelect(array('choices' =>array('F', 'M', 'unknown'))),  
			  'email' => new sfWidgetFormInput(),
			  'email_state' => new sfWidgetFormSelect(array('choices' =>
Workflow::getEmailVerificationStates())),  
			  'birthdate' => new sfWidgetFormI18nDate(array('culture'=>'it', 'years'=>$years)),  
			  'birthplace' => new sfWidgetFormInput(array(), array('size'=>50)),  
			  'main_role' => new sfWidgetFormPropelSelect(array('model'=>'role', 'add_empty'=>'Choose a role', 'peer_method'=>'retrieveMainRoles')),
/*			  'soft_blocks_quota' => new sfWidgetFormInput(array(), array('size'=>8)),
			  'hard_blocks_quota' => new sfWidgetFormInput(array(), array('size'=>8)),
			  'soft_files_quota' => new sfWidgetFormInput(array(), array('size'=>8)),
			  'hard_files_quota' => new sfWidgetFormInput(array(), array('size'=>8)),*/
            ));

			if(isset($this->options['new']))
			{
            $this->setWidgets(array(
			  'username' => new sfWidgetFormInput(array(), array('size'=>25)),
			  'main_role' => new sfWidgetFormPropelSelect(array('model'=>'role', 'add_empty'=>'Choose a role', 'peer_method'=>'retrieveMainRoles')),
            ));
			}
			$this->widgetSchema->setNameFormat('userinfo[%s]');
			
			$this->setValidators(array(
				'username' => new sfValidatorAnd(array(
					new sfValidatorString(array('trim' => true, 'min_length'=>4, 'max_length'=>20)),
					new sfValidatorRegex(array('pattern'=>'/^[a-z][a-z0-9\.]{3,19}$/')),
			)),
				'first_name' => new sfValidatorString(array('trim' => true)),
				'old_username' => new sfValidatorString(),
				'id' => new sfValidatorInteger(),
				'posix_uid' => new sfValidatorInteger(array('required'=>false, 'min'=>500, 'max'=>65534)),  
				'is_active' => new sfValidatorInteger(array('min'=>0, 'max'=>1)),
				'last_name' => new sfValidatorString(array('trim' => true)),
				'middle_name'  => new sfValidatorString(array('trim' => true, 'required' => false)),
				'pronunciation'  => new sfValidatorString(array('trim' => true, 'required' => false, 'max_length'=>100)),
				'gender' => new sfValidatorInteger(array('min'=>0, 'max'=>2)),
				'email'   => new sfValidatorEmail(array('trim' => true, 'required'=>false)),
				'email_state' => new sfValidatorInteger(array('min'=>0, 'max'=>2)),  
				'birthdate' => new sfValidatorDate(array('required'=>false)),
				'birthplace' => new sfValidatorString(array('trim'=>true, 'required'=>false)),
				'main_role' => new sfValidatorPropelChoice(array('model'=>'role')),  
/*				'soft_blocks_quota' => new sfValidatorInteger(array('required'=>false, 'min'=>0)),  
				'hard_blocks_quota' => new sfValidatorInteger(array('required'=>false, 'min'=>0)),  
				'soft_files_quota' => new sfValidatorInteger(array('required'=>false, 'min'=>0)),  
				'hard_files_quota' => new sfValidatorInteger(array('required'=>false, 'min'=>0)),  */
			));
			
			if(isset($this->options['new']))
			{
				$this->setValidators(array(
					'username' => new sfValidatorAnd(array(
						new sfValidatorString(array('trim' => true, 'min_length'=>4, 'max_length'=>20)),
						new sfValidatorRegex(array('pattern'=>'/^[a-z.0-9]*$/')),
				)),
					'main_role' => new sfValidatorPropelChoice(array('model'=>'role')),  
				));
			}
			
		$this->validatorSchema->setPostValidator(
				new sfValidatorOr(array(
					new sfValidatorSchemaCompare('username', sfValidatorSchemaCompare::EQUAL, 'old_username'),
					new smValidatorUsername('username')))
				);
		/* KEPT FOR REFERENCE 
		$this->validatorSchema->setPostValidator(
			new sfValidatorAnd(array(
				new sfValidatorOr(array(
					new sfValidatorSchemaCompare('username', sfValidatorSchemaCompare::EQUAL, 'old_username'),
					new smValidatorUsername('username'))),
				new sfValidatorSchemaCompare('soft_blocks_quota',
					sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'hard_blocks_quota',
					array(),
					array('invalid' => 'The soft blocks quota ("%left_field%") must be less than the hard blocks quota ("%right_field%").')
				),
				new sfValidatorSchemaCompare('soft_files_quota',
					sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'hard_files_quota',
					array(),
					array('invalid' => 'The soft files quota ("%left_field%") must be less than the hard files quota ("%right_field%").')
				)
			))
		);
*/
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