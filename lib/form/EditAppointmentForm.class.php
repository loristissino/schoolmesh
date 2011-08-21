<?php
  class EditAppointmentForm extends BaseForm
  {
    public function configure()
    {
      $this->setWidgets(array(
      'year'  => new sfWidgetFormPropelChoice(array('model'=>'Year', 'add_empty'=>'Choose a year')),
      'class' => new sfWidgetFormPropelChoice(array('model'=>'Schoolclass', 'add_empty'=>'Choose a class')),
      'subject' => new sfWidgetFormPropelChoice(array('model'=>'Subject', 'add_empty'=>'Choose a subject')),
      'syllabus' => new sfWidgetFormPropelChoice(array('model'=>'Syllabus', 'add_empty'=>'Choose a syllabus')), 
      'hours' => new sfWidgetFormInputText(array(), array('size'=>5))
      ));

			$this->widgetSchema->setNameFormat('info[%s]');
			
			$this->setValidators(array(
				'year' => new sfValidatorPropelChoice(array('model'=>'Year')),  
				'class' => new sfValidatorPropelChoice(array('model'=>'Schoolclass')),  
				'subject' => new sfValidatorPropelChoice(array('model'=>'Subject')),
				'syllabus' => new sfValidatorPropelChoice(array('model'=>'Syllabus')),
				'hours' => new sfValidatorInteger(array('required'=>true, 'min'=>1)),
			));
			
			}

	}