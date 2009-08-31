<?php
        class TeamChangeRoleForm extends sfForm
        {
          public function configure()
          {
			
            $this->setWidgets(array(
				'id'  => new sfWidgetFormInput(array('type'=>'hidden', 'is_hidden'=>true)),
				'team'  => new sfWidgetFormInput(array('type'=>'hidden', 'is_hidden'=>true)),
				'role' => new sfWidgetFormPropelSelect(array('model'=>'role', 'add_empty'=>'Choose a role'))
				));

			$this->widgetSchema->setNameFormat('info[%s]');
			
			$this->setValidators(array(
				'id' => new sfValidatorInteger(),
				'team' => new sfValidatorInteger(),
				'role' => new sfValidatorPropelChoice(array('model'=>'role')),  
			));
			
			}

	}