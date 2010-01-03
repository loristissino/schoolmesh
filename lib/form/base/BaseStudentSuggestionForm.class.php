<?php

/**
 * StudentSuggestion form base class.
 *
 * @method StudentSuggestion getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseStudentSuggestionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'term_id'        => new sfWidgetFormPropelChoice(array('model' => 'Term', 'add_empty' => false)),
      'appointment_id' => new sfWidgetFormInputHidden(),
      'user_id'        => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'suggestion_id'  => new sfWidgetFormPropelChoice(array('model' => 'Suggestion', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'StudentSuggestion', 'column' => 'id', 'required' => false)),
      'term_id'        => new sfValidatorPropelChoice(array('model' => 'Term', 'column' => 'id')),
      'appointment_id' => new sfValidatorPropelChoice(array('model' => 'Appointment', 'column' => 'id', 'required' => false)),
      'user_id'        => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'suggestion_id'  => new sfValidatorPropelChoice(array('model' => 'Suggestion', 'column' => 'id', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'StudentSuggestion', 'column' => array('term_id', 'appointment_id', 'user_id', 'suggestion_id')))
    );

    $this->widgetSchema->setNameFormat('student_suggestion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StudentSuggestion';
  }


}
