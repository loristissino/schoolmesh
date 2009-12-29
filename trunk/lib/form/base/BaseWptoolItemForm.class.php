<?php

/**
 * WptoolItem form base class.
 *
 * @method WptoolItem getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseWptoolItemForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'description'             => new sfWidgetFormInputText(),
      'wptool_item_type_id'     => new sfWidgetFormPropelChoice(array('model' => 'WptoolItemType', 'add_empty' => true)),
      'wptool_appointment_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Appointment')),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorPropelChoice(array('model' => 'WptoolItem', 'column' => 'id', 'required' => false)),
      'description'             => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'wptool_item_type_id'     => new sfValidatorPropelChoice(array('model' => 'WptoolItemType', 'column' => 'id', 'required' => false)),
      'wptool_appointment_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Appointment', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('wptool_item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WptoolItem';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['wptool_appointment_list']))
    {
      $values = array();
      foreach ($this->object->getWptoolAppointments() as $obj)
      {
        $values[] = $obj->getAppointmentId();
      }

      $this->setDefault('wptool_appointment_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveWptoolAppointmentList($con);
  }

  public function saveWptoolAppointmentList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['wptool_appointment_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(WptoolAppointmentPeer::WPTOOL_ITEM_ID, $this->object->getPrimaryKey());
    WptoolAppointmentPeer::doDelete($c, $con);

    $values = $this->getValue('wptool_appointment_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new WptoolAppointment();
        $obj->setWptoolItemId($this->object->getPrimaryKey());
        $obj->setAppointmentId($value);
        $obj->save();
      }
    }
  }

}
