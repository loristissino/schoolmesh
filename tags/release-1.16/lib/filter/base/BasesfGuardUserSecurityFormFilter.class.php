<?php

/**
 * sfGuardUserSecurity filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BasesfGuardUserSecurityFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'last_login_attempt_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'trusted_browsers_serialized' => new sfWidgetFormFilterInput(),
      'initialization_key'          => new sfWidgetFormFilterInput(),
      'created_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'last_login_attempt_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'trusted_browsers_serialized' => new sfValidatorPass(array('required' => false)),
      'initialization_key'          => new sfValidatorPass(array('required' => false)),
      'created_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_security_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserSecurity';
  }

  public function getFields()
  {
    return array(
      'user_id'                     => 'ForeignKey',
      'last_login_attempt_at'       => 'Date',
      'trusted_browsers_serialized' => 'Text',
      'initialization_key'          => 'Text',
      'created_at'                  => 'Date',
      'updated_at'                  => 'Date',
    );
  }
}
