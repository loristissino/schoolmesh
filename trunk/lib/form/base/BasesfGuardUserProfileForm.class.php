<?php

/**
 * sfGuardUserProfile form base class.
 *
 * @method sfGuardUserProfile getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BasesfGuardUserProfileForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'                   => new sfWidgetFormInputHidden(),
      'lettertitle'               => new sfWidgetFormInputText(),
      'first_name'                => new sfWidgetFormInputText(),
      'middle_name'               => new sfWidgetFormInputText(),
      'last_name'                 => new sfWidgetFormInputText(),
      'pronunciation'             => new sfWidgetFormInputText(),
      'city'                      => new sfWidgetFormInputText(),
      'address'                   => new sfWidgetFormInputText(),
      'info'                      => new sfWidgetFormTextarea(),
      'role_id'                   => new sfWidgetFormPropelChoice(array('model' => 'Role', 'add_empty' => true)),
      'gender'                    => new sfWidgetFormInputText(),
      'email'                     => new sfWidgetFormInputText(),
      'email_state'               => new sfWidgetFormInputText(),
      'email_verification_code'   => new sfWidgetFormInputText(),
      'mobile'                    => new sfWidgetFormInputText(),
      'website'                   => new sfWidgetFormInputText(),
      'office'                    => new sfWidgetFormInputText(),
      'ptn_notes'                 => new sfWidgetFormInputText(),
      'birthdate'                 => new sfWidgetFormDate(),
      'birthplace'                => new sfWidgetFormInputText(),
      'import_code'               => new sfWidgetFormInputText(),
      'system_alerts'             => new sfWidgetFormInputText(),
      'is_scheduled_for_deletion' => new sfWidgetFormInputCheckbox(),
      'prefers_richtext'          => new sfWidgetFormInputCheckbox(),
      'preferred_format'          => new sfWidgetFormInputText(),
      'preferred_culture'         => new sfWidgetFormInputText(),
      'last_action_at'            => new sfWidgetFormDateTime(),
      'last_login_at'             => new sfWidgetFormDateTime(),
      'last_login_attempt_at'     => new sfWidgetFormDateTime(),
      'known_browsers'            => new sfWidgetFormTextarea(),
      'initialization_key'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'user_id'                   => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'lettertitle'               => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'first_name'                => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'middle_name'               => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'last_name'                 => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'pronunciation'             => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'city'                      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'address'                   => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'info'                      => new sfValidatorString(array('required' => false)),
      'role_id'                   => new sfValidatorPropelChoice(array('model' => 'Role', 'column' => 'id', 'required' => false)),
      'gender'                    => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'email'                     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'email_state'               => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'email_verification_code'   => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'mobile'                    => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'website'                   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'office'                    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ptn_notes'                 => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'birthdate'                 => new sfValidatorDate(array('required' => false)),
      'birthplace'                => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'import_code'               => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'system_alerts'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_scheduled_for_deletion' => new sfValidatorBoolean(array('required' => false)),
      'prefers_richtext'          => new sfValidatorBoolean(array('required' => false)),
      'preferred_format'          => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'preferred_culture'         => new sfValidatorString(array('max_length' => 7, 'required' => false)),
      'last_action_at'            => new sfValidatorDateTime(array('required' => false)),
      'last_login_at'             => new sfValidatorDateTime(array('required' => false)),
      'last_login_attempt_at'     => new sfValidatorDateTime(array('required' => false)),
      'known_browsers'            => new sfValidatorString(array('required' => false)),
      'initialization_key'        => new sfValidatorString(array('max_length' => 32, 'required' => false)),
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
