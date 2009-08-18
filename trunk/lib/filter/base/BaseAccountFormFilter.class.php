<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Account filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseAccountFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'             => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'account_type_id'     => new sfWidgetFormPropelChoice(array('model' => 'AccountType', 'add_empty' => true)),
      'info'                => new sfWidgetFormFilterInput(),
      'settings'            => new sfWidgetFormFilterInput(),
      'exists'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_locked'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'temporary_password'  => new sfWidgetFormFilterInput(),
      'info_updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'last_known_login_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'quota_percentage'    => new sfWidgetFormFilterInput(),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'user_id'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'account_type_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'AccountType', 'column' => 'id')),
      'info'                => new sfValidatorPass(array('required' => false)),
      'settings'            => new sfValidatorPass(array('required' => false)),
      'exists'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_locked'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'temporary_password'  => new sfValidatorPass(array('required' => false)),
      'info_updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'last_known_login_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'quota_percentage'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('account_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Account';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'user_id'             => 'ForeignKey',
      'account_type_id'     => 'ForeignKey',
      'info'                => 'Text',
      'settings'            => 'Text',
      'exists'              => 'Boolean',
      'is_locked'           => 'Boolean',
      'temporary_password'  => 'Text',
      'info_updated_at'     => 'Date',
      'last_known_login_at' => 'Date',
      'quota_percentage'    => 'Number',
      'updated_at'          => 'Date',
      'created_at'          => 'Date',
    );
  }
}
