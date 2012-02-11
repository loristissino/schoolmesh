<?php

/**
 * StudentHint filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseStudentHintFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'term_id'              => new sfWidgetFormPropelChoice(array('model' => 'Term', 'add_empty' => true)),
      'user_id'              => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'recuperation_hint_id' => new sfWidgetFormPropelChoice(array('model' => 'RecuperationHint', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'term_id'              => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Term', 'column' => 'id')),
      'user_id'              => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'recuperation_hint_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'RecuperationHint', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('student_hint_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StudentHint';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'term_id'              => 'ForeignKey',
      'appointment_id'       => 'ForeignKey',
      'user_id'              => 'ForeignKey',
      'recuperation_hint_id' => 'ForeignKey',
    );
  }
}
