<?php

/**
 * Enrolment form base class.
 *
 * @package    mattiussi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseEnrolmentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'user_id'        => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'schoolclass_id' => new sfWidgetFormPropelChoice(array('model' => 'Schoolclass', 'add_empty' => false)),
      'year_id'        => new sfWidgetFormPropelChoice(array('model' => 'Year', 'add_empty' => false)),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'import_code'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'Enrolment', 'column' => 'id', 'required' => false)),
      'user_id'        => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'schoolclass_id' => new sfValidatorPropelChoice(array('model' => 'Schoolclass', 'column' => 'id')),
      'year_id'        => new sfValidatorPropelChoice(array('model' => 'Year', 'column' => 'id')),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
      'import_code'    => new sfValidatorString(array('max_length' => 20, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Enrolment', 'column' => array('user_id', 'schoolclass_id', 'year_id')))
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
