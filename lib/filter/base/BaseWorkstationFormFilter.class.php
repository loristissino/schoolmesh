<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Workstation filter form base class.
 *
 * @package   schoolmesh
 * @subpackage filter
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseWorkstationFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                     => new sfWidgetFormFilterInput(),
      'ip_cidr'                  => new sfWidgetFormFilterInput(),
      'mac_address'              => new sfWidgetFormFilterInput(),
      'is_enabled'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'subnet_id'                => new sfWidgetFormPropelChoice(array('model' => 'Subnet', 'add_empty' => true)),
      'workstation_service_list' => new sfWidgetFormPropelChoice(array('model' => 'Service', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'                     => new sfValidatorPass(array('required' => false)),
      'ip_cidr'                  => new sfValidatorPass(array('required' => false)),
      'mac_address'              => new sfValidatorPass(array('required' => false)),
      'is_enabled'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'subnet_id'                => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Subnet', 'column' => 'id')),
      'workstation_service_list' => new sfValidatorPropelChoice(array('model' => 'Service', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('workstation_filters[%s]');

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

    $criteria->addJoin(WorkstationServicePeer::WORKSTATION_ID, WorkstationPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(WorkstationServicePeer::SERVICE_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(WorkstationServicePeer::SERVICE_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Workstation';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'name'                     => 'Text',
      'ip_cidr'                  => 'Text',
      'mac_address'              => 'Text',
      'is_enabled'               => 'Boolean',
      'subnet_id'                => 'ForeignKey',
      'workstation_service_list' => 'ManyKey',
    );
  }
}
