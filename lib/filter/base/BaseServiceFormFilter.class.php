<?php

/**
 * Service filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseServiceFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                     => new sfWidgetFormFilterInput(),
      'is_enabled_by_default'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'port'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_udp'                   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'workstation_service_list' => new sfWidgetFormPropelChoice(array('model' => 'Workstation', 'add_empty' => true)),
      'subnet_service_list'      => new sfWidgetFormPropelChoice(array('model' => 'Subnet', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'                     => new sfValidatorPass(array('required' => false)),
      'is_enabled_by_default'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'port'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_udp'                   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'workstation_service_list' => new sfValidatorPropelChoice(array('model' => 'Workstation', 'required' => false)),
      'subnet_service_list'      => new sfValidatorPropelChoice(array('model' => 'Subnet', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('service_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addWorkstationServiceListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(WorkstationServicePeer::SERVICE_ID, ServicePeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(WorkstationServicePeer::WORKSTATION_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(WorkstationServicePeer::WORKSTATION_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function addSubnetServiceListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(SubnetServicePeer::SERVICE_ID, ServicePeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(SubnetServicePeer::SUBNET_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(SubnetServicePeer::SUBNET_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Service';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'name'                     => 'Text',
      'is_enabled_by_default'    => 'Boolean',
      'port'                     => 'Number',
      'is_udp'                   => 'Boolean',
      'workstation_service_list' => 'ManyKey',
      'subnet_service_list'      => 'ManyKey',
    );
  }
}
