<?php

/**
 * ProjResourceType filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseProjResourceTypeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'description'                   => new sfWidgetFormFilterInput(),
      'shortcut'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'role_id'                       => new sfWidgetFormPropelChoice(array('model' => 'Role', 'add_empty' => true)),
      'standard_cost'                 => new sfWidgetFormFilterInput(),
      'measurement_unit'              => new sfWidgetFormFilterInput(),
      'is_monetary'                   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'rank'                          => new sfWidgetFormFilterInput(),
      'printed_in_submission_letters' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'printed_in_charge_letters'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'description'                   => new sfValidatorPass(array('required' => false)),
      'shortcut'                      => new sfValidatorPass(array('required' => false)),
      'role_id'                       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Role', 'column' => 'id')),
      'standard_cost'                 => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'measurement_unit'              => new sfValidatorPass(array('required' => false)),
      'is_monetary'                   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'rank'                          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'printed_in_submission_letters' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'printed_in_charge_letters'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('proj_resource_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjResourceType';
  }

  public function getFields()
  {
    return array(
      'id'                            => 'Number',
      'description'                   => 'Text',
      'shortcut'                      => 'Text',
      'role_id'                       => 'ForeignKey',
      'standard_cost'                 => 'Number',
      'measurement_unit'              => 'Text',
      'is_monetary'                   => 'Boolean',
      'rank'                          => 'Number',
      'printed_in_submission_letters' => 'Boolean',
      'printed_in_charge_letters'     => 'Boolean',
    );
  }
}
