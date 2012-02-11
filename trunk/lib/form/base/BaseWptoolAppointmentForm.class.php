<?php

/**
 * WptoolAppointment form base class.
 *
 * @method WptoolAppointment getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseWptoolAppointmentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'appointment_id' => new sfWidgetFormInputHidden(),
      'wptool_item_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'appointment_id' => new sfValidatorPropelChoice(array('model' => 'Appointment', 'column' => 'id', 'required' => false)),
      'wptool_item_id' => new sfValidatorPropelChoice(array('model' => 'WptoolItem', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('wptool_appointment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WptoolAppointment';
  }


}
