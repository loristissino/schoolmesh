<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Subnet filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseSubnetFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                => new sfWidgetFormFilterInput(),
      'ip_cidr'             => new sfWidgetFormFilterInput(),
      'subnet_service_list' => new sfWidgetFormPropelChoice(array('model' => 'Service', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'                => new sfValidatorPass(array('required' => false)),
      'ip_cidr'             => new sfValidatorPass(array('required' => false)),
      'subnet_service_list' => new sfValidatorPropelChoice(array('model' => 'Service', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('subnet_filters[%s]');

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

    $criteria->addJoin(SubnetServicePeer::SUBNET_ID, SubnetPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(SubnetServicePeer::SERVICE_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(SubnetServicePeer::SERVICE_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Subnet';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'name'                => 'Text',
      'ip_cidr'             => 'Text',
      'subnet_service_list' => 'ManyKey',
    );
  }
}
