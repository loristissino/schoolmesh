<?php

/**
 * ProjResourceType filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseProjResourceTypeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'description'      => new sfWidgetFormFilterInput(),
      'role_id'          => new sfWidgetFormPropelChoice(array('model' => 'Role', 'add_empty' => true)),
      'standard_cost'    => new sfWidgetFormFilterInput(),
      'measurement_unit' => new sfWidgetFormFilterInput(),
      'is_monetary'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'description'      => new sfValidatorPass(array('required' => false)),
      'role_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Role', 'column' => 'id')),
      'standard_cost'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'measurement_unit' => new sfValidatorPass(array('required' => false)),
      'is_monetary'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
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
      'id'               => 'Number',
      'description'      => 'Text',
      'role_id'          => 'ForeignKey',
      'standard_cost'    => 'Number',
      'measurement_unit' => 'Text',
      'is_monetary'      => 'Boolean',
    );
  }
}
