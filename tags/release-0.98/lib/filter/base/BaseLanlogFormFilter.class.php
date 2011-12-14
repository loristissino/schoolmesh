<?php

/**
 * Lanlog filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseLanlogFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'        => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'workstation_id' => new sfWidgetFormPropelChoice(array('model' => 'Workstation', 'add_empty' => true)),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'is_online'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'os_used'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'workstation_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Workstation', 'column' => 'id')),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'is_online'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'os_used'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lanlog_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lanlog';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'user_id'        => 'ForeignKey',
      'workstation_id' => 'ForeignKey',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
      'is_online'      => 'Boolean',
      'os_used'        => 'Text',
    );
  }
}
