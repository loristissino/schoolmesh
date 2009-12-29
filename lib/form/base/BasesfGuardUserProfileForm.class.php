<?php

/**
 * sfGuardUserProfile form base class.
 *
 * @method sfGuardUserProfile getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserProfileForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'                   => new sfWidgetFormInputHidden(),
      'first_name'                => new sfWidgetFormInputText(),
      'middle_name'               => new sfWidgetFormInputText(),
      'last_name'                 => new sfWidgetFormInputText(),
      'pronunciation'             => new sfWidgetFormInputText(),
      'info'                      => new sfWidgetFormTextarea(),
      'role_id'                   => new sfWidgetFormPropelChoice(array('model' => 'Role', 'add_empty' => true)),
      'gender'                    => new sfWidgetFormInputText(),
      'email'                     => new sfWidgetFormInputText(),
      'email_state'               => new sfWidgetFormInputText(),
      'email_verification_code'   => new sfWidgetFormInputText(),
      'birthdate'                 => new sfWidgetFormDate(),
      'birthplace'                => new sfWidgetFormInputText(),
      'import_code'               => new sfWidgetFormInputText(),
      'system_alerts'             => new sfWidgetFormInputText(),
      'is_scheduled_for_deletion' => new sfWidgetFormInputCheckbox(),
      'last_action_at'            => new sfWidgetFormDateTime(),
      'last_login_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'user_id'                   => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'first_name'                => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'middle_name'               => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'last_name'                 => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'pronunciation'             => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'info'                      => new sfValidatorString(array('required' => false)),
      'role_id'                   => new sfValidatorPropelChoice(array('model' => 'Role', 'column' => 'id', 'required' => false)),
      'gender'                    => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'email'                     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'email_state'               => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'email_verification_code'   => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'birthdate'                 => new sfValidatorDate(array('required' => false)),
      'birthplace'                => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'import_code'               => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'system_alerts'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_scheduled_for_deletion' => new sfValidatorBoolean(array('required' => false)),
      'last_action_at'            => new sfValidatorDateTime(array('required' => false)),
      'last_login_at'             => new sfValidatorDateTime(array('required' => false)),
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
