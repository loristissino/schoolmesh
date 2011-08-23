<?php

/**
 * ProjExpense form base class.
 *
 * @method ProjExpense getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseProjExpenseForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'schoolproject_id'     => new sfWidgetFormPropelChoice(array('model' => 'Schoolproject', 'add_empty' => true)),
      'proj_expense_type_id' => new sfWidgetFormPropelChoice(array('model' => 'ProjExpenseType', 'add_empty' => true)),
      'hours_estimated'      => new sfWidgetFormInputText(),
      'hours_approved'       => new sfWidgetFormInputText(),
      'amount_estimated'     => new sfWidgetFormInputText(),
      'amount_approved'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'schoolproject_id'     => new sfValidatorPropelChoice(array('model' => 'Schoolproject', 'column' => 'id', 'required' => false)),
      'proj_expense_type_id' => new sfValidatorPropelChoice(array('model' => 'ProjExpenseType', 'column' => 'id', 'required' => false)),
      'hours_estimated'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'hours_approved'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'amount_estimated'     => new sfValidatorNumber(array('required' => false)),
      'amount_approved'      => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('proj_expense[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjExpense';
  }


}
