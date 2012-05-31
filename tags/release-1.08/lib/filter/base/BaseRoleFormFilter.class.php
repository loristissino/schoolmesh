<?php

/**
 * Role filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseRoleFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'male_description'    => new sfWidgetFormFilterInput(),
      'female_description'  => new sfWidgetFormFilterInput(),
      'quality_code'        => new sfWidgetFormFilterInput(),
      'posix_name'          => new sfWidgetFormFilterInput(),
      'may_be_main_role'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'needs_charge_letter' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_key'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'default_guardgroup'  => new sfWidgetFormFilterInput(),
      'min'                 => new sfWidgetFormFilterInput(),
      'max'                 => new sfWidgetFormFilterInput(),
      'forfait_pay'         => new sfWidgetFormFilterInput(),
      'charge_notes'        => new sfWidgetFormFilterInput(),
      'confirmation_notes'  => new sfWidgetFormFilterInput(),
      'rank'                => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'male_description'    => new sfValidatorPass(array('required' => false)),
      'female_description'  => new sfValidatorPass(array('required' => false)),
      'quality_code'        => new sfValidatorPass(array('required' => false)),
      'posix_name'          => new sfValidatorPass(array('required' => false)),
      'may_be_main_role'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'needs_charge_letter' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_key'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'default_guardgroup'  => new sfValidatorPass(array('required' => false)),
      'min'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'max'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'forfait_pay'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'charge_notes'        => new sfValidatorPass(array('required' => false)),
      'confirmation_notes'  => new sfValidatorPass(array('required' => false)),
      'rank'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('role_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Role';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'male_description'    => 'Text',
      'female_description'  => 'Text',
      'quality_code'        => 'Text',
      'posix_name'          => 'Text',
      'may_be_main_role'    => 'Boolean',
      'needs_charge_letter' => 'Boolean',
      'is_key'              => 'Boolean',
      'default_guardgroup'  => 'Text',
      'min'                 => 'Number',
      'max'                 => 'Number',
      'forfait_pay'         => 'Number',
      'charge_notes'        => 'Text',
      'confirmation_notes'  => 'Text',
      'rank'                => 'Number',
    );
  }
}
