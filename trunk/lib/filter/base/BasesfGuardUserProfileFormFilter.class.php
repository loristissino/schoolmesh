<?php

/**
 * sfGuardUserProfile filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasesfGuardUserProfileFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'first_name'                => new sfWidgetFormFilterInput(),
      'middle_name'               => new sfWidgetFormFilterInput(),
      'last_name'                 => new sfWidgetFormFilterInput(),
      'pronunciation'             => new sfWidgetFormFilterInput(),
      'info'                      => new sfWidgetFormFilterInput(),
      'role_id'                   => new sfWidgetFormPropelChoice(array('model' => 'Role', 'add_empty' => true)),
      'gender'                    => new sfWidgetFormFilterInput(),
      'email'                     => new sfWidgetFormFilterInput(),
      'email_state'               => new sfWidgetFormFilterInput(),
      'email_verification_code'   => new sfWidgetFormFilterInput(),
      'birthdate'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'birthplace'                => new sfWidgetFormFilterInput(),
      'import_code'               => new sfWidgetFormFilterInput(),
      'system_alerts'             => new sfWidgetFormFilterInput(),
      'is_scheduled_for_deletion' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'last_action_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'last_login_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'first_name'                => new sfValidatorPass(array('required' => false)),
      'middle_name'               => new sfValidatorPass(array('required' => false)),
      'last_name'                 => new sfValidatorPass(array('required' => false)),
      'pronunciation'             => new sfValidatorPass(array('required' => false)),
      'info'                      => new sfValidatorPass(array('required' => false)),
      'role_id'                   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Role', 'column' => 'id')),
      'gender'                    => new sfValidatorPass(array('required' => false)),
      'email'                     => new sfValidatorPass(array('required' => false)),
      'email_state'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'email_verification_code'   => new sfValidatorPass(array('required' => false)),
      'birthdate'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'birthplace'                => new sfValidatorPass(array('required' => false)),
      'import_code'               => new sfValidatorPass(array('required' => false)),
      'system_alerts'             => new sfValidatorPass(array('required' => false)),
      'is_scheduled_for_deletion' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'last_action_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'last_login_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }

  public function getFields()
  {
    return array(
      'user_id'                   => 'ForeignKey',
      'first_name'                => 'Text',
      'middle_name'               => 'Text',
      'last_name'                 => 'Text',
      'pronunciation'             => 'Text',
      'info'                      => 'Text',
      'role_id'                   => 'ForeignKey',
      'gender'                    => 'Text',
      'email'                     => 'Text',
      'email_state'               => 'Number',
      'email_verification_code'   => 'Text',
      'birthdate'                 => 'Date',
      'birthplace'                => 'Text',
      'import_code'               => 'Text',
      'system_alerts'             => 'Text',
      'is_scheduled_for_deletion' => 'Boolean',
      'last_action_at'            => 'Date',
      'last_login_at'             => 'Date',
    );
  }
}
