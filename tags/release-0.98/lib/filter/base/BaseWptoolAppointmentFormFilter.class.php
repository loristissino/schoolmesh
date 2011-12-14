<?php

/**
 * WptoolAppointment filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseWptoolAppointmentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('wptool_appointment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WptoolAppointment';
  }

  public function getFields()
  {
    return array(
      'appointment_id' => 'ForeignKey',
      'wptool_item_id' => 'ForeignKey',
    );
  }
}
