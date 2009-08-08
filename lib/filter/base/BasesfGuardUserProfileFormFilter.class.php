<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * sfGuardUserProfile filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BasesfGuardUserProfileFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'first_name'                            => new sfWidgetFormFilterInput(),
      'middle_name'                           => new sfWidgetFormFilterInput(),
      'last_name'                             => new sfWidgetFormFilterInput(),
      'pronunciation'                         => new sfWidgetFormFilterInput(),
      'role_id'                               => new sfWidgetFormPropelChoice(array('model' => 'Role', 'add_empty' => true)),
      'gender'                                => new sfWidgetFormFilterInput(),
      'email'                                 => new sfWidgetFormFilterInput(),
      'email_state'                           => new sfWidgetFormFilterInput(),
      'email_verification_code'               => new sfWidgetFormFilterInput(),
      'birthdate'                             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'birthplace'                            => new sfWidgetFormFilterInput(),
      'import_code'                           => new sfWidgetFormFilterInput(),
      'posix_uid'                             => new sfWidgetFormFilterInput(),
      'disk_set_soft_blocks_quota'            => new sfWidgetFormFilterInput(),
      'disk_set_hard_blocks_quota'            => new sfWidgetFormFilterInput(),
      'disk_set_soft_files_quota'             => new sfWidgetFormFilterInput(),
      'disk_set_hard_files_quota'             => new sfWidgetFormFilterInput(),
      'disk_used_blocks'                      => new sfWidgetFormFilterInput(),
      'disk_used_files'                       => new sfWidgetFormFilterInput(),
      'disk_updated_at'                       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'system_alerts'                         => new sfWidgetFormFilterInput(),
      'is_deleted'                            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'googleapps_account_status'             => new sfWidgetFormFilterInput(),
      'googleapps_account_approved_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'googleapps_account_temporary_password' => new sfWidgetFormFilterInput(),
      'has_moodle_account'                    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'moodle_account_temporary_password'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'first_name'                            => new sfValidatorPass(array('required' => false)),
      'middle_name'                           => new sfValidatorPass(array('required' => false)),
      'last_name'                             => new sfValidatorPass(array('required' => false)),
      'pronunciation'                         => new sfValidatorPass(array('required' => false)),
      'role_id'                               => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Role', 'column' => 'id')),
      'gender'                                => new sfValidatorPass(array('required' => false)),
      'email'                                 => new sfValidatorPass(array('required' => false)),
      'email_state'                           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'email_verification_code'               => new sfValidatorPass(array('required' => false)),
      'birthdate'                             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'birthplace'                            => new sfValidatorPass(array('required' => false)),
      'import_code'                           => new sfValidatorPass(array('required' => false)),
      'posix_uid'                             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'disk_set_soft_blocks_quota'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'disk_set_hard_blocks_quota'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'disk_set_soft_files_quota'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'disk_set_hard_files_quota'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'disk_used_blocks'                      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'disk_used_files'                       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'disk_updated_at'                       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'system_alerts'                         => new sfValidatorPass(array('required' => false)),
      'is_deleted'                            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'googleapps_account_status'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'googleapps_account_approved_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'googleapps_account_temporary_password' => new sfValidatorPass(array('required' => false)),
      'has_moodle_account'                    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'moodle_account_temporary_password'     => new sfValidatorPass(array('required' => false)),
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
      'user_id'                               => 'ForeignKey',
      'first_name'                            => 'Text',
      'middle_name'                           => 'Text',
      'last_name'                             => 'Text',
      'pronunciation'                         => 'Text',
      'role_id'                               => 'ForeignKey',
      'gender'                                => 'Text',
      'email'                                 => 'Text',
      'email_state'                           => 'Number',
      'email_verification_code'               => 'Text',
      'birthdate'                             => 'Date',
      'birthplace'                            => 'Text',
      'import_code'                           => 'Text',
      'posix_uid'                             => 'Number',
      'disk_set_soft_blocks_quota'            => 'Number',
      'disk_set_hard_blocks_quota'            => 'Number',
      'disk_set_soft_files_quota'             => 'Number',
      'disk_set_hard_files_quota'             => 'Number',
      'disk_used_blocks'                      => 'Number',
      'disk_used_files'                       => 'Number',
      'disk_updated_at'                       => 'Date',
      'system_alerts'                         => 'Text',
      'is_deleted'                            => 'Boolean',
      'googleapps_account_status'             => 'Number',
      'googleapps_account_approved_at'        => 'Date',
      'googleapps_account_temporary_password' => 'Text',
      'has_moodle_account'                    => 'Boolean',
      'moodle_account_temporary_password'     => 'Text',
    );
  }
}
