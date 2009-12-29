<?php
        class TeamChangeRoleForm extends BaseForm
        {
          public function configure()
          {
			
            $this->setWidgets(array(
				'id'  => new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true)),
				'team'  => new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true)),
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