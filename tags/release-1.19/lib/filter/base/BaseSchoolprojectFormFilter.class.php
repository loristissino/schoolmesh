<?php

/**
 * Schoolproject filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseSchoolprojectFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'proj_category_id'    => new sfWidgetFormPropelChoice(array('model' => 'ProjCategory', 'add_empty' => true)),
      'code'                => new sfWidgetFormFilterInput(),
      'year_id'             => new sfWidgetFormPropelChoice(array('model' => 'Year', 'add_empty' => true)),
      'user_id'             => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'team_id'             => new sfWidgetFormPropelChoice(array('model' => 'Team', 'add_empty' => true)),
      'title'               => new sfWidgetFormFilterInput(),
      'hours_approved'      => new sfWidgetFormFilterInput(),
      'state'               => new sfWidgetFormFilterInput(),
      'submission_date'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'reference_number'    => new sfWidgetFormFilterInput(),
      'approval_date'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'approval_notes'      => new sfWidgetFormFilterInput(),
      'financing_date'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'financing_notes'     => new sfWidgetFormFilterInput(),
      'confirmation_date'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'confirmation_notes'  => new sfWidgetFormFilterInput(),
      'rejection_date'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'rejection_notes'     => new sfWidgetFormFilterInput(),
      'evaluation_min'      => new sfWidgetFormFilterInput(),
      'evaluation_max'      => new sfWidgetFormFilterInput(),
      'no_activity_confirm' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'proj_category_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ProjCategory', 'column' => 'id')),
      'code'                => new sfValidatorPass(array('required' => false)),
      'year_id'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Year', 'column' => 'id')),
      'user_id'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'team_id'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Team', 'column' => 'id')),
      'title'               => new sfValidatorPass(array('required' => false)),
      'hours_approved'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'state'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'submission_date'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'reference_number'    => new sfValidatorPass(array('required' => false)),
      'approval_date'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'approval_notes'      => new sfValidatorPass(array('required' => false)),
      'financing_date'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'financing_notes'     => new sfValidatorPass(array('required' => false)),
      'confirmation_date'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'confirmation_notes'  => new sfValidatorPass(array('required' => false)),
      'rejection_date'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'rejection_notes'     => new sfValidatorPass(array('required' => false)),
      'evaluation_min'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'evaluation_max'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'no_activity_confirm' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('schoolproject_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Schoolproject';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'proj_category_id'    => 'ForeignKey',
      'code'                => 'Text',
      'year_id'             => 'ForeignKey',
      'user_id'             => 'ForeignKey',
      'team_id'             => 'ForeignKey',
      'title'               => 'Text',
      'hours_approved'      => 'Number',
      'state'               => 'Number',
      'submission_date'     => 'Date',
      'reference_number'    => 'Text',
      'approval_date'       => 'Date',
      'approval_notes'      => 'Text',
      'financing_date'      => 'Date',
      'financing_notes'     => 'Text',
      'confirmation_date'   => 'Date',
      'confirmation_notes'  => 'Text',
      'rejection_date'      => 'Date',
      'rejection_notes'     => 'Text',
      'evaluation_min'      => 'Number',
      'evaluation_max'      => 'Number',
      'no_activity_confirm' => 'Boolean',
      'created_at'          => 'Date',
    );
  }
}
