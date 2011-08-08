<?php

/**
 * SubnetService filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseSubnetServiceFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('subnet_service_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SubnetService';
  }

  public function getFields()
  {
    return array(
      'subnet_id'  => 'ForeignKey',
      'service_id' => 'ForeignKey',
    );
  }
}
