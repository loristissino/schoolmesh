<?php
  class UserForm extends BaseForm
  {
    public function configure()
    {
      
      $formats=sfConfig::get('app_opendocument_formats');
      
      $years=Generic::getNumbersBetweenAsOptionsArray(sfConfig::get('app_config_current_year')-70, sfConfig::get('app_config_current_year')-5);
      $emailstates=Workflow::getEmailVerificationStates();
			
    $this->setWidgets(array(
      'id'  => new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true)),
      'old_username' =>  new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true)),
      'username' => new sfWidgetFormInputText(array(), array('size'=>25)),
      'import_code' => new sfWidgetFormInputText(array(), array('size'=>20)),
      'is_active'=> new sfWidgetFormSelect(array('choices' =>array('no', 'yes'))),
      'lettertitle' => new sfWidgetFormInputText(array(), array('size'=>20)), 
      'first_name'    => new sfWidgetFormInputText(array(), array('size'=>50)),
      'middle_name'   => new sfWidgetFormInputText(array(), array('size'=>15)),
      'last_name' => new sfWidgetFormInputText(array(), array('size'=>50)),
      'pronunciation' => new sfWidgetFormInputText(array(), array('size'=>70)),
      'gender' => new sfWidgetFormSelect(array('choices' =>array('F', 'M', 'unknown'))),
      'prefers_richtext' => new sfWidgetFormInputCheckbox(),
      'preferred_format' => new sfWidgetFormSelect(array('choices' =>array_merge(array('---'), $formats))),
      'email' => new sfWidgetFormInputText(),
      'email_state' => new sfWidgetFormSelect(array('choices' =>$emailstates)),
      'website' => new sfWidgetFormInputText(array(), array('size'=>70)),
      'office' => new sfWidgetFormInputText(array(), array('size'=>40)),
      'ptn_notes' => new sfWidgetFormInputText(array(), array('size'=>70)),
      'birthdate' => new sfWidgetFormI18nDate(array('culture'=>'it', 'years'=>$years)),  
      'birthplace' => new sfWidgetFormInputText(array(), array('size'=>50)),  
      'main_role' => new sfWidgetFormPropelChoice(array('model'=>'role', 'add_empty'=>'Choose a role', 'peer_method'=>'retrieveMainRoles')),
            ));

    $this['lettertitle']->getWidget()->setLabel('Title');
    $this['ptn_notes']->getWidget()->setLabel('PTN notes');


			if(isset($this->options['new']))
			{
            $this->setWidgets(array(
			  'username' => new sfWidgetFormInputText(array(), array('size'=>25)),
			  'main_role' => new sfWidgetFormPropelChoice(array('model'=>'role', 'add_empty'=>'Choose a role', 'peer_method'=>'retrieveMainRoles')),
            ));
			}
			$this->widgetSchema->setNameFormat('userinfo[%s]');
			
			$this->setValidators(array(
				'username' => new sfValidatorAnd(array(
					new sfValidatorString(array('trim' => true, 'min_length'=>4, 'max_length'=>20)),
					new sfValidatorRegex(array('pattern'=>'/^[a-z][a-z0-9\.]{3,19}$/')),
			)),
        'lettertitle' => new sfValidatorString(array('trim' => true, 'required'=>false)),
        'old_username' => new sfValidatorString(),
				'id' => new sfValidatorInteger(),
				'posix_uid' => new sfValidatorInteger(array('required'=>false, 'min'=>500, 'max'=>65534)),  
				'is_active' => new sfValidatorInteger(array('min'=>0, 'max'=>1)),
				'first_name' => new sfValidatorString(array('trim' => true)),
				'middle_name'  => new sfValidatorString(array('trim' => true, 'required' => false)),
				'last_name' => new sfValidatorString(array('trim' => true)),
				'import_code' => new sfValidatorString(array('trim' => true)),
				'pronunciation'  => new sfValidatorString(array('trim' => true, 'required' => false, 'max_length'=>100)),
				'gender' => new sfValidatorInteger(array('min'=>0, 'max'=>2)),
				'email'   => new sfValidatorEmail(array('trim' => true, 'required'=>false)),
				'email_state' => new sfValidatorInteger(array('min'=>0, 'max'=>sizeof($emailstates)-1)), 
        'website'  => new sfValidatorUrl(array('protocols'=>array('http','https'), 'trim' => true, 'required' => false, 'max_length'=>255)), 
				'office'  => new sfValidatorString(array('trim' => true, 'required' => false, 'max_length'=>255)),
				'ptn_notes'  => new sfValidatorString(array('trim' => true, 'required' => false, 'max_length'=>255)),
				'birthdate' => new sfValidatorDate(array('required'=>false)),
				'birthplace' => new sfValidatorString(array('trim'=>true, 'required'=>false)),
				'main_role' => new sfValidatorPropelChoice(array('model'=>'role')),
        'prefers_richtext' => new sfValidatorBoolean(),
        'preferred_format' => new sfValidatorChoice(array('choices' => array_keys($formats), 'multiple'=>false)),

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
