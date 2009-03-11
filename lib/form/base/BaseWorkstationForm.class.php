<?php

/**
 * Workstation form base class.
 *
 * @package    mattiussi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseWorkstationForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'name'                     => new sfWidgetFormInput(),
      'ip_cidr'                  => new sfWidgetFormInput(),
      'mac_address'              => new sfWidgetFormInput(),
      'is_enabled'               => new sfWidgetFormInputCheckbox(),
      'subnet_id'                => new sfWidgetFormPropelChoice(array('model' => 'Subnet', 'add_empty' => true)),
      'workstation_service_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'Service')),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorPropelChoice(array('model' => 'Workstation', 'column' => 'id', 'required' => false)),
      'name'                     => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'ip_cidr'                  => new sfValidatorString(array('max_length' => 20)),
      'mac_address'              => new sfValidatorString(array('max_length' => 17, 'required' => false)),
      'is_enabled'               => new sfValidatorBoolean(array('required' => false)),
      'subnet_id'                => new sfValidatorPropelChoice(array('model' => 'Subnet', 'column' => 'id', 'required' => false)),
      'workstation_service_list' => new sfValidatorPropelChoiceMany(array('model' => 'Service', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('workstation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Workstation';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['workstation_service_list']))
    {
      $values = array();
      foreach ($this->object->getWorkstationServices() as $obj)
      {
        $values[] = $obj->getServiceId();
      }

      $this->setDefault('workstation_service_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveWorkstationServiceList($con);
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
    $c->add(WorkstationServicePeer::WORKSTATION_ID, $this->object->getPrimaryKey());
    WorkstationServicePeer::doDelete($c, $con);

    $values = $this->getValue('workstation_service_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new WorkstationService();
        $obj->setWorkstationId($this->object->getPrimaryKey());
        $obj->setServiceId($value);
        $obj->save();
      }
    }
  }

}
