<?php

/**
 * sfGuardUserProfile filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BasesfGuardUserProfileFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'lettertitle'               => new sfWidgetFormFilterInput(),
      'first_name'                => new sfWidgetFormFilterInput(),
      'middle_name'               => new sfWidgetFormFilterInput(),
      'last_name'                 => new sfWidgetFormFilterInput(),
      'pronunciation'             => new sfWidgetFormFilterInput(),
      'city'                      => new sfWidgetFormFilterInput(),
      'address'                   => new sfWidgetFormFilterInput(),
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
      'prefers_richtext'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'preferred_format'          => new sfWidgetFormFilterInput(),
      'preferred_culture'         => new sfWidgetFormFilterInput(),
      'last_action_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'last_login_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'lettertitle'               => new sfValidatorPass(array('required' => false)),
      'first_name'                => new sfValidatorPass(array('required' => false)),
      'middle_name'               => new sfValidatorPass(array('required' => false)),
      'last_name'                 => new sfValidatorPass(array('required' => false)),
      'pronunciation'             => new sfValidatorPass(array('required' => false)),
      'city'                      => new sfValidatorPass(array('required' => false)),
      'address'                   => new sfValidatorPass(array('required' => false)),
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
      'prefers_richtext'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'preferred_format'          => new sfValidatorPass(array('required' => false)),
      'preferred_culture'         => new sfValidatorPass(array('required' => false)),
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
      'lettertitle'               => 'Text',
      'first_name'                => 'Text',
      'middle_name'               => 'Text',
      'last_name'                 => 'Text',
      'pronunciation'             => 'Text',
      'city'                      => 'Text',
      'address'                   => 'Text',
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
      'prefers_richtext'          => 'Boolean',
      'preferred_format'          => 'Text',
      'preferred_culture'         => 'Text',
      'last_action_at'            => 'Date',
      'last_login_at'             => 'Date',
    );
  }
}
