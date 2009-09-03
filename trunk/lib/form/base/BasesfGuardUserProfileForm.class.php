<?php

/**
 * sfGuardUserProfile form base class.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BasesfGuardUserProfileForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'                   => new sfWidgetFormInputHidden(),
      'first_name'                => new sfWidgetFormInput(),
      'middle_name'               => new sfWidgetFormInput(),
      'last_name'                 => new sfWidgetFormInput(),
      'pronunciation'             => new sfWidgetFormInput(),
      'extra_info'                => new sfWidgetFormTextarea(),
      'role_id'                   => new sfWidgetFormPropelChoice(array('model' => 'Role', 'add_empty' => true)),
      'gender'                    => new sfWidgetFormInput(),
      'email'                     => new sfWidgetFormInput(),
      'email_state'               => new sfWidgetFormInput(),
      'email_verification_code'   => new sfWidgetFormInput(),
      'birthdate'                 => new sfWidgetFormDate(),
      'birthplace'                => new sfWidgetFormInput(),
      'import_code'               => new sfWidgetFormInput(),
      'system_alerts'             => new sfWidgetFormInput(),
      'is_scheduled_for_deletion' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'user_id'                   => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'first_name'                => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'middle_name'               => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'last_name'                 => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'pronunciation'             => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'extra_info'                => new sfValidatorString(array('required' => false)),
      'role_id'                   => new sfValidatorPropelChoice(array('model' => 'Role', 'column' => 'id', 'required' => false)),
      'gender'                    => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'email'                     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'email_state'               => new sfValidatorInteger(array('required' => false)),
      'email_verification_code'   => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'birthdate'                 => new sfValidatorDate(array('required' => false)),
      'birthplace'                => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'import_code'               => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'system_alerts'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_scheduled_for_deletion' => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }


}
