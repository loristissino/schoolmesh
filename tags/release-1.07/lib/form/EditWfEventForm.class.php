<?php
/* deprecated
        class EditWfeventForm extends BaseForm
        {
          public function configure()
          {
			
            $this->setWidgets(array(
				'user'  => new sfWidgetFormPropelChoice(array('model'=>'sfGuardUserProfile', 'peer_method'=>'retrieveAllButStudents', 'add_empty'=>'Choose a user')),
				'date' => new sfWidgetFormI18nDateTime(array('culture'=>'it')),
				'comment' => new sfWidgetFormInputText(array(), array('size'=>100)),
				'state' => new sfWidgetFormSelect(array('choices' =>Workflow::getWpfrStates())),
				'update_state' => new sfWidgetFormInputCheckbox(),
				));

			$this->widgetSchema->setNameFormat('info[%s]');
			
			$this->setValidators(array(
				'user' => new sfValidatorPropelChoice(array('model'=>'sfGuardUserProfile')),  
				'date' => new sfValidatorDateTime(),
				'comment' => new sfValidatorString(array('trim' => true, 'required' => true, 'max_length'=>255)),
				'state' => new sfValidatorInteger(),
				'update_state' => new sfValidatorPass()
			));
			
			}
*/
	}