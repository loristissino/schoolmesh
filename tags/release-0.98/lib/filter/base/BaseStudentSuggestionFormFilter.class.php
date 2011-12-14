<?php

/**
 * StudentSuggestion filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseStudentSuggestionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'term_id'        => new sfWidgetFormPropelChoice(array('model' => 'Term', 'add_empty' => true)),
      'user_id'        => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'suggestion_id'  => new sfWidgetFormPropelChoice(array('model' => 'Suggestion', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'term_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Term', 'column' => 'id')),
      'user_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'suggestion_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Suggestion', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('student_suggestion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StudentSuggestion';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'term_id'        => 'ForeignKey',
      'appointment_id' => 'ForeignKey',
      'user_id'        => 'ForeignKey',
      'suggestion_id'  => 'ForeignKey',
    );
  }
}
