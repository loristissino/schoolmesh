<?php
  class UserForm extends BaseForm
  {
    
    private function configureDefaultForm()
    {
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
        'preferred_format' => new sfWidgetFormSelect(array('choices' =>array_merge(array('---'), $this->formats))),
        'email' => new sfWidgetFormInputText(),
        'email_state' => new sfWidgetFormSelect(array('choices' =>$this->emailstates)),
        'website' => new sfWidgetFormInputText(array(), array('size'=>70)),
        'office' => new sfWidgetFormInputText(array(), array('size'=>40)),
        'ptn_notes' => new sfWidgetFormInputText(array(), array('size'=>70)),
        'birthdate' => new sfWidgetFormI18nDate(array('culture'=>'it', 'years'=>$this->years)),  
        'birthplace' => new sfWidgetFormInputText(array(), array('size'=>50)),  
        'role_id' => new sfWidgetFormPropelChoice(array('model'=>'role', 'add_empty'=>'Choose a role', 'peer_method'=>'retrieveMainRoles')),
              ));

      $this['lettertitle']->getWidget()->setLabel('Title');
      $this['ptn_notes']->getWidget()->setLabel('PTN notes');
      $this['role_id']->getWidget()->setLabel('Main role');

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
				'email_state' => new sfValidatorInteger(array('min'=>0, 'max'=>sizeof($this->emailstates)-1)), 
        'website'  => new sfValidatorUrl(array('protocols'=>array('http','https'), 'trim' => true, 'required' => false, 'max_length'=>255)), 
				'office'  => new sfValidatorString(array('trim' => true, 'required' => false, 'max_length'=>255)),
				'ptn_notes'  => new sfValidatorString(array('trim' => true, 'required' => false, 'max_length'=>255)),
				'birthdate' => new sfValidatorDate(array('required'=>false)),
				'birthplace' => new sfValidatorString(array('trim'=>true, 'required'=>false)),
				'role_id' => new sfValidatorPropelChoice(array('model'=>'role')),
        'prefers_richtext' => new sfValidatorBoolean(),
        'preferred_format' => new sfValidatorChoice(array('choices' => array_keys($this->formats), 'multiple'=>false)),

			));

      $this->validatorSchema->setPostValidator(
				new sfValidatorOr(array(
					new sfValidatorSchemaCompare('username', sfValidatorSchemaCompare::EQUAL, 'old_username'),
					new smValidatorUsername('username')))
				);

      
    }
    
    public function configure()
    {
      
      $this->formats=sfConfig::get('app_opendocument_formats');
      
      $this->years=Generic::getNumbersBetweenAsOptionsArray(sfConfig::get('app_config_current_year')-70, sfConfig::get('app_config_current_year')-5);
      $this->emailstates=Workflow::getEmailVerificationStates();

			if(isset($this->options['new']))
			{
        $this->setWidgets(array(
          'username' => new sfWidgetFormInputText(array(), array('size'=>25)),
          'role_id' => new sfWidgetFormPropelChoice(array('model'=>'role', 'add_empty'=>'Choose a role', 'peer_method'=>'retrieveMainRoles')),
            ));
            
 				$this->setValidators(array(
					'username' => new sfValidatorAnd(array(
						new sfValidatorString(array('trim' => true, 'min_length'=>4, 'max_length'=>20)),
						new sfValidatorRegex(array('pattern'=>'/^[a-z.0-9]*$/')),
				)),
					'role_id' => new sfValidatorPropelChoice(array('model'=>'role')),  
				));
			}
      else
      {
        $this->configureDefaultForm();
      }

			$this->widgetSchema->setNameFormat('userinfo[%s]');


			if(isset($this->options['prenew']))
      {
        unset(
          $this['id'],
          $this['old_username'],
          $this['username'],
          $this['middle_name'],
          $this['import_code'],
          $this['is_active'],
          $this['lettertitle'],
          $this['pronunciation'],
          $this['gender'],
          $this['prefers_richtext'],
          $this['preferred_format'],
          $this['email'],
          $this['email_state'],
          $this['website'],
          $this['office'],
          $this['ptn_notes'],
          $this['birthdate'],
          $this['birthplace'],
          $this['role_id']
        );
        
      }
      
      
    }

	}
