<?php

/**
 * ProjResource filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseProjResourceFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'schoolproject_id'      => new sfWidgetFormPropelChoice(array('model' => 'Schoolproject', 'add_empty' => true)),
      'proj_resource_type_id' => new sfWidgetFormPropelChoice(array('model' => 'ProjResourceType', 'add_empty' => true)),
      'description'           => new sfWidgetFormFilterInput(),
      'quantity_estimated'    => new sfWidgetFormFilterInput(),
      'quantity_approved'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'schoolproject_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Schoolproject', 'column' => 'id')),
      'proj_resource_type_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ProjResourceType', 'column' => 'id')),
      'description'           => new sfValidatorPass(array('required' => false)),
      'quantity_estimated'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'quantity_approved'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('proj_resource_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjResource';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'schoolproject_id'      => 'ForeignKey',
      'proj_resource_type_id' => 'ForeignKey',
      'description'           => 'Text',
      'quantity_estimated'    => 'Number',
      'quantity_approved'     => 'Number',
    );
  }
}
