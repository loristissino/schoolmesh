<?php
        class EditAppointmentForm extends BaseForm
        {
          public function configure()
          {
			
            $this->setWidgets(array(
				'year'  => new sfWidgetFormPropelChoice(array('model'=>'Year', 'add_empty'=>'Choose a year')),
				'class' => new sfWidgetFormPropelChoice(array('model'=>'Schoolclass', 'add_empty'=>'Choose a class')),
				'subject' => new sfWidgetFormPropelChoice(array('model'=>'Subject', 'add_empty'=>'Choose a subject')),
				'hours' => new sfWidgetFormInputText(array(), array('size'=>5))
				));

			$this->widgetSchema->setNameFormat('info[%s]');
			
			$this->setValidators(array(
				'year' => new sfValidatorPropelChoice(array('model'=>'Year')),  
				'class' => new sfValidatorPropelChoice(array('model'=>'Schoolclass')),  
				'subject' => new sfValidatorPropelChoice(array('model'=>'Subject')),
				'hours' => new sfValidatorInteger(array('required'=>true, 'min'=>1)),
			));
			
			}

	}