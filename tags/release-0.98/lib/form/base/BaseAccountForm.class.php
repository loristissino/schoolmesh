<?php

/**
 * Account form base class.
 *
 * @method Account getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseAccountForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'user_id'             => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'account_type_id'     => new sfWidgetFormPropelChoice(array('model' => 'AccountType', 'add_empty' => false)),
      'info'                => new sfWidgetFormTextarea(),
      'settings'            => new sfWidgetFormTextarea(),
      'exists'              => new sfWidgetFormInputCheckbox(),
      'is_locked'           => new sfWidgetFormInputCheckbox(),
      'temporary_password'  => new sfWidgetFormInputText(),
      'info_updated_at'     => new sfWidgetFormDateTime(),
      'last_known_login_at' => new sfWidgetFormDateTime(),
      'quota_percentage'    => new sfWidgetFormInputText(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'created_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'user_id'             => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'account_type_id'     => new sfValidatorPropelChoice(array('model' => 'AccountType', 'column' => 'id')),
      'info'                => new sfValidatorString(array('required' => false)),
      'settings'            => new sfValidatorString(array('required' => false)),
      'exists'              => new sfValidatorBoolean(array('required' => false)),
      'is_locked'           => new sfValidatorBoolean(array('required' => false)),
      'temporary_password'  => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'info_updated_at'     => new sfValidatorDateTime(array('required' => false)),
      'last_known_login_at' => new sfValidatorDateTime(array('required' => false)),
      'quota_percentage'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'updated_at'          => new sfValidatorDateTime(array('required' => false)),
      'created_at'          => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Account', 'column' => array('user_id', 'account_type_id')))
    );

    $this->widgetSchema->setNameFormat('account[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Account';
  }


}
