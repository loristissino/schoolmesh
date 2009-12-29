<?php

/**
 * Subnet form base class.
 *
 * @method Subnet getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseSubnetForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'name'                => new sfWidgetFormInputText(),
      'ip_cidr'             => new sfWidgetFormInputText(),
      'subnet_service_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Service')),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorPropelChoice(array('model' => 'Subnet', 'column' => 'id', 'required' => false)),
      'name'                => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'ip_cidr'             => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'subnet_service_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Service', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('subnet[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Subnet';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['subnet_service_list']))
    {
      $values = array();
      foreach ($this->object->getSubnetServices() as $obj)
      {
        $values[] = $obj->getServiceId();
      }

      $this->setDefault('subnet_service_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveSubnetServiceList($con);
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
    $c->add(SubnetServicePeer::SUBNET_ID, $this->object->getPrimaryKey());
    SubnetServicePeer::doDelete($c, $con);

    $values = $this->getValue('subnet_service_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new SubnetService();
        $obj->setSubnetId($this->object->getPrimaryKey());
        $obj->setServiceId($value);
        $obj->save();
      }
    }
  }

}
