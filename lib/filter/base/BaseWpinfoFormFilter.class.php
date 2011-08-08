<?php

/**
 * Wpinfo filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseWpinfoFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'appointment_id' => new sfWidgetFormPropelChoice(array('model' => 'Appointment', 'add_empty' => true)),
      'wpinfo_type_id' => new sfWidgetFormPropelChoice(array('model' => 'WpinfoType', 'add_empty' => true)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'content'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'appointment_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Appointment', 'column' => 'id')),
      'wpinfo_type_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'WpinfoType', 'column' => 'id')),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'content'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('wpinfo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Wpinfo';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'appointment_id' => 'ForeignKey',
      'wpinfo_type_id' => 'ForeignKey',
      'updated_at'     => 'Date',
      'content'        => 'Text',
    );
  }
}
