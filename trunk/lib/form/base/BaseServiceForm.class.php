<?php

/**
 * Service form base class.
 *
 * @package    mattiussi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseServiceForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'name'                     => new sfWidgetFormInput(),
      'is_enabled_by_default'    => new sfWidgetFormInputCheckbox(),
      'port'                     => new sfWidgetFormInput(),
      'is_udp'                   => new sfWidgetFormInputCheckbox(),
      'subnet_service_list'      => new sfWidgetFormPropelChoiceMany(array('model' => 'Subnet')),
      'workstation_service_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'Workstation')),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorPropelChoice(array('model' => 'Service', 'column' => 'id', 'required' => false)),
      'name'                     => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'is_enabled_by_default'    => new sfValidatorBoolean(array('required' => false)),
      'port'                     => new sfValidatorInteger(),
      'is_udp'                   => new sfValidatorBoolean(array('required' => false)),
      'subnet_service_list'      => new sfValidatorPropelChoiceMany(array('model' => 'Subnet', 'required' => false)),
      'workstation_service_list' => new sfValidatorPropelChoiceMany(array('model' => 'Workstation', 'required' => false)),
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

    if (isset($this->widgetSchema['subnet_service_list']))
    {
      $values = array();
      foreach ($this->object->getSubnetServices() as $obj)
      {
        $values[] = $obj->getSubnetId();
      }

      $this->setDefault('subnet_service_list', $values);
    }

    if (isset($this->widgetSchema['workstation_service_list']))
    {
      $values = array();
      foreach ($this->object->getWorkstationServices() as $obj)
      {
        $values[] = $obj->getWorkstationId();
      }

      $this->setDefault('workstation_service_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveSubnetServiceList($con);
    $this->saveWorkstationServiceList($con);
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

    if (is_null($con))
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

    if (is_null($con))
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

}
