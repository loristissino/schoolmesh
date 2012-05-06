<?php

/**
 * StudentSyllabusItem form base class.
 *
 * @method StudentSyllabusItem getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseStudentSyllabusItemForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'term_id'          => new sfWidgetFormPropelChoice(array('model' => 'Term', 'add_empty' => false)),
      'appointment_id'   => new sfWidgetFormInputHidden(),
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'syllabus_item_id' => new sfWidgetFormPropelChoice(array('model' => 'SyllabusItem', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'term_id'          => new sfValidatorPropelChoice(array('model' => 'Term', 'column' => 'id')),
      'appointment_id'   => new sfValidatorPropelChoice(array('model' => 'Appointment', 'column' => 'id', 'required' => false)),
      'user_id'          => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'syllabus_item_id' => new sfValidatorPropelChoice(array('model' => 'SyllabusItem', 'column' => 'id', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'StudentSyllabusItem', 'column' => array('term_id', 'appointment_id', 'user_id', 'syllabus_item_id')))
    );

    $this->widgetSchema->setNameFormat('student_syllabus_item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StudentSyllabusItem';
  }


}
