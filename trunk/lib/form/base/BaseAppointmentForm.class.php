<?php

/**
 * Appointment form base class.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseAppointmentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'user_id'                 => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'subject_id'              => new sfWidgetFormPropelChoice(array('model' => 'Subject', 'add_empty' => false)),
      'schoolclass_id'          => new sfWidgetFormPropelChoice(array('model' => 'Schoolclass', 'add_empty' => false)),
      'year_id'                 => new sfWidgetFormPropelChoice(array('model' => 'Year', 'add_empty' => false)),
      'state'                   => new sfWidgetFormInput(),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
      'import_code'             => new sfWidgetFormInput(),
      'wptool_appointment_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'WptoolItem')),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorPropelChoice(array('model' => 'Appointment', 'column' => 'id', 'required' => false)),
      'user_id'                 => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'subject_id'              => new sfValidatorPropelChoice(array('model' => 'Subject', 'column' => 'id')),
      'schoolclass_id'          => new sfValidatorPropelChoice(array('model' => 'Schoolclass', 'column' => 'id')),
      'year_id'                 => new sfValidatorPropelChoice(array('model' => 'Year', 'column' => 'id')),
      'state'                   => new sfValidatorInteger(array('required' => false)),
      'created_at'              => new sfValidatorDateTime(array('required' => false)),
      'updated_at'              => new sfValidatorDateTime(array('required' => false)),
      'import_code'             => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'wptool_appointment_list' => new sfValidatorPropelChoiceMany(array('model' => 'WptoolItem', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Appointment', 'column' => array('user_id', 'subject_id', 'schoolclass_id', 'year_id')))
    );

    $this->widgetSchema->setNameFormat('appointment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Appointment';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['wptool_appointment_list']))
    {
      $values = array();
      foreach ($this->object->getWptoolAppointments() as $obj)
      {
        $values[] = $obj->getWptoolItemId();
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

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(WptoolAppointmentPeer::APPOINTMENT_ID, $this->object->getPrimaryKey());
    WptoolAppointmentPeer::doDelete($c, $con);

    $values = $this->getValue('wptool_appointment_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new WptoolAppointment();
        $obj->setAppointmentId($this->object->getPrimaryKey());
        $obj->setWptoolItemId($value);
        $obj->save();
      }
    }
  }

}
