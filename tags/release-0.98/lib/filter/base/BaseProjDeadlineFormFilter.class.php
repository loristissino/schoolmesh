<?php

/**
 * ProjDeadline filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseProjDeadlineFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'schoolproject_id'       => new sfWidgetFormPropelChoice(array('model' => 'Schoolproject', 'add_empty' => true)),
      'user_id'                => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'original_deadline_date' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'current_deadline_date'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'description'            => new sfWidgetFormFilterInput(),
      'notes'                  => new sfWidgetFormFilterInput(),
      'completed'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'needs_attachment'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'schoolproject_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Schoolproject', 'column' => 'id')),
      'user_id'                => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'original_deadline_date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'current_deadline_date'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'description'            => new sfValidatorPass(array('required' => false)),
      'notes'                  => new sfValidatorPass(array('required' => false)),
      'completed'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'needs_attachment'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('proj_deadline_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjDeadline';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'schoolproject_id'       => 'ForeignKey',
      'user_id'                => 'ForeignKey',
      'original_deadline_date' => 'Date',
      'current_deadline_date'  => 'Date',
      'description'            => 'Text',
      'notes'                  => 'Text',
      'completed'              => 'Boolean',
      'needs_attachment'       => 'Boolean',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
    );
  }
}
