<?php

/**
 * Schoolproject filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseSchoolprojectFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'proj_category_id'  => new sfWidgetFormPropelChoice(array('model' => 'ProjCategory', 'add_empty' => true)),
      'proj_financing_id' => new sfWidgetFormPropelChoice(array('model' => 'ProjFinancing', 'add_empty' => true)),
      'year_id'           => new sfWidgetFormPropelChoice(array('model' => 'Year', 'add_empty' => true)),
      'user_id'           => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'title'             => new sfWidgetFormFilterInput(),
      'description'       => new sfWidgetFormFilterInput(),
      'notes'             => new sfWidgetFormFilterInput(),
      'addressees'        => new sfWidgetFormFilterInput(),
      'purposes'          => new sfWidgetFormFilterInput(),
      'goals'             => new sfWidgetFormFilterInput(),
      'final_report'      => new sfWidgetFormFilterInput(),
      'hours_approved'    => new sfWidgetFormFilterInput(),
      'state'             => new sfWidgetFormFilterInput(),
      'submission_date'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'approval_date'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'approval_notes'    => new sfWidgetFormFilterInput(),
      'financing_date'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'financing_notes'   => new sfWidgetFormFilterInput(),
      'evaluation_min'    => new sfWidgetFormFilterInput(),
      'evaluation_max'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'proj_category_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ProjCategory', 'column' => 'id')),
      'proj_financing_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ProjFinancing', 'column' => 'id')),
      'year_id'           => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Year', 'column' => 'id')),
      'user_id'           => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'title'             => new sfValidatorPass(array('required' => false)),
      'description'       => new sfValidatorPass(array('required' => false)),
      'notes'             => new sfValidatorPass(array('required' => false)),
      'addressees'        => new sfValidatorPass(array('required' => false)),
      'purposes'          => new sfValidatorPass(array('required' => false)),
      'goals'             => new sfValidatorPass(array('required' => false)),
      'final_report'      => new sfValidatorPass(array('required' => false)),
      'hours_approved'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'state'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'submission_date'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'approval_date'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'approval_notes'    => new sfValidatorPass(array('required' => false)),
      'financing_date'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'financing_notes'   => new sfValidatorPass(array('required' => false)),
      'evaluation_min'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'evaluation_max'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
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
      'id'                => 'Number',
      'proj_category_id'  => 'ForeignKey',
      'proj_financing_id' => 'ForeignKey',
      'year_id'           => 'ForeignKey',
      'user_id'           => 'ForeignKey',
      'title'             => 'Text',
      'description'       => 'Text',
      'notes'             => 'Text',
      'addressees'        => 'Text',
      'purposes'          => 'Text',
      'goals'             => 'Text',
      'final_report'      => 'Text',
      'hours_approved'    => 'Number',
      'state'             => 'Number',
      'submission_date'   => 'Date',
      'approval_date'     => 'Date',
      'approval_notes'    => 'Text',
      'financing_date'    => 'Date',
      'financing_notes'   => 'Text',
      'evaluation_min'    => 'Number',
      'evaluation_max'    => 'Number',
    );
  }
}
