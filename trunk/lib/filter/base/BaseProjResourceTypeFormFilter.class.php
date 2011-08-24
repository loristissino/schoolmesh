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
      'description'   => new sfWidgetFormFilterInput(),
      'resource_type' => new sfWidgetFormFilterInput(),
      'role_id'       => new sfWidgetFormPropelChoice(array('model' => 'Role', 'add_empty' => true)),
      'standard_cost' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'description'   => new sfValidatorPass(array('required' => false)),
      'resource_type' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'role_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Role', 'column' => 'id')),
      'standard_cost' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
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
      'id'            => 'Number',
      'description'   => 'Text',
      'resource_type' => 'Number',
      'role_id'       => 'ForeignKey',
      'standard_cost' => 'Number',
    );
  }
}
