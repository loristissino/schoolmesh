<?php

/**
 * Wpmodule form base class.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseWpmoduleForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'user_id'         => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'title'           => new sfWidgetFormInput(),
      'period'          => new sfWidgetFormInput(),
      'hours_estimated' => new sfWidgetFormInput(),
      'hours_used'      => new sfWidgetFormInput(),
      'appointment_id'  => new sfWidgetFormPropelChoice(array('model' => 'Appointment', 'add_empty' => true)),
      'rank'            => new sfWidgetFormInput(),
      'is_public'       => new sfWidgetFormInputCheckbox(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'Wpmodule', 'column' => 'id', 'required' => false)),
      'user_id'         => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'title'           => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'period'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'hours_estimated' => new sfValidatorInteger(array('required' => false)),
      'hours_used'      => new sfValidatorInteger(array('required' => false)),
      'appointment_id'  => new sfValidatorPropelChoice(array('model' => 'Appointment', 'column' => 'id', 'required' => false)),
      'rank'            => new sfValidatorInteger(array('required' => false)),
      'is_public'       => new sfValidatorBoolean(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'updated_at'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('wpmodule[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Wpmodule';
  }


}
