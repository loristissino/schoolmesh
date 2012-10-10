<?php

/**
 * sfGuardUserSecurity form base class.
 *
 * @method sfGuardUserSecurity getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BasesfGuardUserSecurityForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'                     => new sfWidgetFormInputHidden(),
      'last_login_attempt_at'       => new sfWidgetFormDateTime(),
      'trusted_browsers_serialized' => new sfWidgetFormTextarea(),
      'initialization_key'          => new sfWidgetFormInputText(),
      'created_at'                  => new sfWidgetFormDateTime(),
      'updated_at'                  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'user_id'                     => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'last_login_attempt_at'       => new sfValidatorDateTime(array('required' => false)),
      'trusted_browsers_serialized' => new sfValidatorString(array('required' => false)),
      'initialization_key'          => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'created_at'                  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'                  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_security[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserSecurity';
  }


}
