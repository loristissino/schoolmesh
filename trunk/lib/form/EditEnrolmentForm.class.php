<?php
        class EditEnrolmentForm extends BaseForm
        {
          public function configure()
          {
			
            $this->setWidgets(array(
				'year'  => new sfWidgetFormPropelSelect(array('model'=>'Year', 'add_empty'=>'Choose a year')),
				'class' => new sfWidgetFormPropelSelect(array('model'=>'Schoolclass', 'add_empty'=>'Choose a class'))
				));

			$this->widgetSchema->setNameFormat('info[%s]');
			
			$this->setValidators(array(
				'year' => new sfValidatorPropelChoice(array('model'=>'Year')),  
				'class' => new sfValidatorPropelChoice(array('model'=>'Schoolclass')),  
			));
			
			}

	}