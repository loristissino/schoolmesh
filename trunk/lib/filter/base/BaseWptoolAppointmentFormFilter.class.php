<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * WptoolAppointment filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseWptoolAppointmentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'appointment_id' => new sfWidgetFormPropelChoice(array('model' => 'Appointment', 'add_empty' => true)),
      'wptool_item_id' => new sfWidgetFormPropelChoice(array('model' => 'WptoolItem', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'appointment_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Appointment', 'column' => 'id')),
      'wptool_item_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'WptoolItem', 'column' => 'id')),
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
      'id'             => 'Number',
      'appointment_id' => 'ForeignKey',
      'wptool_item_id' => 'ForeignKey',
    );
  }
}
