<?php

/**
 * WptoolAppointment form base class.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseWptoolAppointmentForm extends BaseFormPropel
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
