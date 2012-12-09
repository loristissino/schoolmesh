<?php
  class EditAppointmentForm extends BaseForm
  {
    public function configure()
    {
      $this->setWidgets(array(
      'year_id'  => new sfWidgetFormPropelChoice(array('model'=>'Year', 'add_empty'=>'Choose a year')),
      'schoolclass_id' => new sfWidgetFormPropelChoice(array('model'=>'Schoolclass', 'peer_method'=>'retrieveActive', 'add_empty'=>'Choose a class')),
      'team_id' => new sfWidgetFormPropelChoice(array('model'=>'Team', 'add_empty'=>'Choose a team')),
      'subject_id' => new sfWidgetFormPropelChoice(array('model'=>'Subject', 'add_empty'=>'Choose a subject')),
      'syllabus_id' => new sfWidgetFormPropelChoice(array('model'=>'Syllabus', 'add_empty'=>'Choose a syllabus')), 
      'appointment_type_id' => new sfWidgetFormPropelChoice(array('model'=>'AppointmentType', 'add_empty'=>'Choose an appointment type', 'peer_method'=>'retrieveActive')), 
      'hours' => new sfWidgetFormInputText(array(), array('size'=>5))
      ));
      
      $this['schoolclass_id']->getWidget()->setLabel('Class');

			$this->widgetSchema->setNameFormat('info[%s]');
			
			$this->setValidators(array(
				'year_id' => new sfValidatorPropelChoice(array('model'=>'Year')),  
				'schoolclass_id' => new sfValidatorPropelChoice(array('model'=>'Schoolclass')),
				'team_id' => new sfValidatorPropelChoice(array('model'=>'Team', 'required'=>false)),
        'subject_id' => new sfValidatorPropelChoice(array('model'=>'Subject', 'required'=>false)),
				'syllabus_id' => new sfValidatorPropelChoice(array('model'=>'Syllabus', 'required'=>false)),
				'appointment_type_id' => new sfValidatorPropelChoice(array('model'=>'AppointmentType')),
				'hours' => new sfValidatorInteger(array('required'=>false)),
			));
			
			}

	}
