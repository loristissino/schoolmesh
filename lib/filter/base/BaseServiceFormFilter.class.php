<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Service filter form base class.
 *
 * @package   schoolmesh
 * @subpackage filter
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseServiceFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                     => new sfWidgetFormFilterInput(),
      'is_enabled_by_default'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'port'                     => new sfWidgetFormFilterInput(),
      'is_udp'                   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'subnet_service_list'      => new sfWidgetFormPropelChoice(array('model' => 'Subnet', 'add_empty' => true)),
      'workstation_service_list' => new sfWidgetFormPropelChoice(array('model' => 'Workstation', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'                     => new sfValidatorPass(array('required' => false)),
      'is_enabled_by_default'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'port'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_udp'                   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'subnet_service_list'      => new sfValidatorPropelChoice(array('model' => 'Subnet', 'required' => false)),
      'workstation_service_list' => new sfValidatorPropelChoice(array('model' => 'Workstation', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('service_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
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
      'subnet_service_list'      => 'ManyKey',
      'workstation_service_list' => 'ManyKey',
    );
  }
}
