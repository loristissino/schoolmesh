<?php

/**
 * Enrolment form base class.
 *
 * @method Enrolment getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseEnrolmentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'user_id'        => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'schoolclass_id' => new sfWidgetFormPropelChoice(array('model' => 'Schoolclass', 'add_empty' => false)),
      'year_id'        => new sfWidgetFormPropelChoice(array('model' => 'Year', 'add_empty' => false)),
      'info'           => new sfWidgetFormTextarea(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'import_code'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'user_id'        => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'schoolclass_id' => new sfValidatorPropelChoice(array('model' => 'Schoolclass', 'column' => 'id')),
      'year_id'        => new sfValidatorPropelChoice(array('model' => 'Year', 'column' => 'id')),
      'info'           => new sfValidatorString(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
      'import_code'    => new sfValidatorString(array('max_length' => 20, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Enrolment', 'column' => array('user_id', 'year_id')))
    );

    $this->widgetSchema->setNameFormat('enrolment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Enrolment';
  }


}
