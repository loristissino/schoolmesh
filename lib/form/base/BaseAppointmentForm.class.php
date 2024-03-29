<?php

/**
 * Appointment form base class.
 *
 * @method Appointment getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseAppointmentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'user_id'                 => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'subject_id'              => new sfWidgetFormPropelChoice(array('model' => 'Subject', 'add_empty' => true)),
      'schoolclass_id'          => new sfWidgetFormPropelChoice(array('model' => 'Schoolclass', 'add_empty' => true)),
      'team_id'                 => new sfWidgetFormPropelChoice(array('model' => 'Team', 'add_empty' => true)),
      'year_id'                 => new sfWidgetFormPropelChoice(array('model' => 'Year', 'add_empty' => false)),
      'state'                   => new sfWidgetFormInputText(),
      'hours'                   => new sfWidgetFormInputText(),
      'is_public'               => new sfWidgetFormInputCheckbox(),
      'syllabus_id'             => new sfWidgetFormPropelChoice(array('model' => 'Syllabus', 'add_empty' => true)),
      'appointment_type_id'     => new sfWidgetFormPropelChoice(array('model' => 'AppointmentType', 'add_empty' => true)),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
      'import_code'             => new sfWidgetFormInputText(),
      'wptool_appointment_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'WptoolItem')),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'user_id'                 => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'subject_id'              => new sfValidatorPropelChoice(array('model' => 'Subject', 'column' => 'id', 'required' => false)),
      'schoolclass_id'          => new sfValidatorPropelChoice(array('model' => 'Schoolclass', 'column' => 'id', 'required' => false)),
      'team_id'                 => new sfValidatorPropelChoice(array('model' => 'Team', 'column' => 'id', 'required' => false)),
      'year_id'                 => new sfValidatorPropelChoice(array('model' => 'Year', 'column' => 'id')),
      'state'                   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'hours'                   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'is_public'               => new sfValidatorBoolean(array('required' => false)),
      'syllabus_id'             => new sfValidatorPropelChoice(array('model' => 'Syllabus', 'column' => 'id', 'required' => false)),
      'appointment_type_id'     => new sfValidatorPropelChoice(array('model' => 'AppointmentType', 'column' => 'id', 'required' => false)),
      'created_at'              => new sfValidatorDateTime(array('required' => false)),
      'updated_at'              => new sfValidatorDateTime(array('required' => false)),
      'import_code'             => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'wptool_appointment_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'WptoolItem', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Appointment', 'column' => array('user_id', 'subject_id', 'appointment_type_id', 'schoolclass_id', 'year_id')))
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

    if (null === $con)
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
