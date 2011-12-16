<?php

/**
 * StudentSyllabusItem filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseStudentSyllabusItemFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'term_id'          => new sfWidgetFormPropelChoice(array('model' => 'Term', 'add_empty' => true)),
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'syllabus_item_id' => new sfWidgetFormPropelChoice(array('model' => 'SyllabusItem', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'term_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Term', 'column' => 'id')),
      'user_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'syllabus_item_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SyllabusItem', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('student_syllabus_item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StudentSyllabusItem';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'term_id'          => 'ForeignKey',
      'appointment_id'   => 'ForeignKey',
      'user_id'          => 'ForeignKey',
      'syllabus_item_id' => 'ForeignKey',
    );
  }
}
