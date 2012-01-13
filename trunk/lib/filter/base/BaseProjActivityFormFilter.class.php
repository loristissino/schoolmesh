<?php

/**
 * ProjActivity filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseProjActivityFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'proj_resource_id'     => new sfWidgetFormPropelChoice(array('model' => 'ProjResource', 'add_empty' => true)),
      'user_id'              => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'beginning'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'quantity'             => new sfWidgetFormFilterInput(),
      'notes'                => new sfWidgetFormFilterInput(),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'acknowledged_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'acknowledger_user_id' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'added_by_coordinator' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'paper_log'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'proj_resource_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ProjResource', 'column' => 'id')),
      'user_id'              => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'beginning'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'quantity'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'notes'                => new sfValidatorPass(array('required' => false)),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'acknowledged_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'acknowledger_user_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'added_by_coordinator' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'paper_log'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('proj_activity_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjActivity';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'proj_resource_id'     => 'ForeignKey',
      'user_id'              => 'ForeignKey',
      'beginning'            => 'Date',
      'quantity'             => 'Number',
      'notes'                => 'Text',
      'created_at'           => 'Date',
      'acknowledged_at'      => 'Date',
      'acknowledger_user_id' => 'ForeignKey',
      'added_by_coordinator' => 'Boolean',
      'paper_log'            => 'Boolean',
    );
  }
}
