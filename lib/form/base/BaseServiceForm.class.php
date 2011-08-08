<?php

/**
 * Service form base class.
 *
 * @method Service getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseServiceForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'name'                     => new sfWidgetFormInputText(),
      'is_enabled_by_default'    => new sfWidgetFormInputCheckbox(),
      'port'                     => new sfWidgetFormInputText(),
      'is_udp'                   => new sfWidgetFormInputCheckbox(),
      'workstation_service_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Workstation')),
      'subnet_service_list'      => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Subnet')),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'                     => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'is_enabled_by_default'    => new sfValidatorBoolean(array('required' => false)),
      'port'                     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'is_udp'                   => new sfValidatorBoolean(array('required' => false)),
      'workstation_service_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Workstation', 'required' => false)),
      'subnet_service_list'      => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Subnet', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Service', 'column' => array('port', 'is_udp')))
    );

    $this->widgetSchema->setNameFormat('service[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Service';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['workstation_service_list']))
    {
      $values = array();
      foreach ($this->object->getWorkstationServices() as $obj)
      {
        $values[] = $obj->getWorkstationId();
      }

      $this->setDefault('workstation_service_list', $values);
    }

    if (isset($this->widgetSchema['subnet_service_list']))
    {
      $values = array();
      foreach ($this->object->getSubnetServices() as $obj)
      {
        $values[] = $obj->getSubnetId();
      }

      $this->setDefault('subnet_service_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveWorkstationServiceList($con);
    $this->saveSubnetServiceList($con);
  }

  public function saveWorkstationServiceList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['workstation_service_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(WorkstationServicePeer::SERVICE_ID, $this->object->getPrimaryKey());
    WorkstationServicePeer::doDelete($c, $con);

    $values = $this->getValue('workstation_service_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new WorkstationService();
        $obj->setServiceId($this->object->getPrimaryKey());
        $obj->setWorkstationId($value);
        $obj->save();
      }
    }
  }

  public function saveSubnetServiceList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['subnet_service_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(SubnetServicePeer::SERVICE_ID, $this->object->getPrimaryKey());
    SubnetServicePeer::doDelete($c, $con);

    $values = $this->getValue('subnet_service_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new SubnetService();
        $obj->setServiceId($this->object->getPrimaryKey());
        $obj->setSubnetId($value);
        $obj->save();
      }
    }
  }

}
