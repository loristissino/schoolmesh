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
      'id'             => new sfWidgetFormInputHidden(),
      'appointment_id' => new sfWidgetFormPropelChoice(array('model' => 'Appointment', 'add_empty' => true)),
      'wptool_item_id' => new sfWidgetFormPropelChoice(array('model' => 'WptoolItem', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'WptoolAppointment', 'column' => 'id', 'required' => false)),
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
