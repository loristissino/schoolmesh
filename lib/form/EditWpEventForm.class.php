<?php
        class EditWpeventForm extends sfForm
        {
          public function configure()
          {
			
            $this->setWidgets(array(
				'user'  => new sfWidgetFormPropelSelect(array('model'=>'sfGuardUserProfile', 'add_empty'=>'Choose a user')),
				'date' => new sfWidgetFormI18nDateTime(array('culture'=>'it')),
				'comment' => new sfWidgetFormInput(array(), array('size'=>100)),

				));

			$this->widgetSchema->setNameFormat('info[%s]');
			
			$this->setValidators(array(
				'user' => new sfValidatorPropelChoice(array('model'=>'sfGuardUserProfile')),  
				'date' => new sfValidatorDateTime(),
				'comment' => new sfValidatorString(array('trim' => true, 'required' => true, 'max_length'=>255))
			));
			
			}

	}