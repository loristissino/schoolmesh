<?php

/**
 * ProjExpense filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseProjExpenseFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'schoolproject_id'     => new sfWidgetFormPropelChoice(array('model' => 'Schoolproject', 'add_empty' => true)),
      'proj_expense_type_id' => new sfWidgetFormPropelChoice(array('model' => 'ProjExpenseType', 'add_empty' => true)),
      'hours_estimated'      => new sfWidgetFormFilterInput(),
      'hours_approved'       => new sfWidgetFormFilterInput(),
      'amount_estimated'     => new sfWidgetFormFilterInput(),
      'amount_approved'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'schoolproject_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Schoolproject', 'column' => 'id')),
      'proj_expense_type_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ProjExpenseType', 'column' => 'id')),
      'hours_estimated'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'hours_approved'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'amount_estimated'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'amount_approved'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('proj_expense_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjExpense';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'schoolproject_id'     => 'ForeignKey',
      'proj_expense_type_id' => 'ForeignKey',
      'hours_estimated'      => 'Number',
      'hours_approved'       => 'Number',
      'amount_estimated'     => 'Number',
      'amount_approved'      => 'Number',
    );
  }
}
