<?php

/**
 * Schoolproject form base class.
 *
 * @method Schoolproject getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseSchoolprojectForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'proj_category_id'   => new sfWidgetFormPropelChoice(array('model' => 'ProjCategory', 'add_empty' => true)),
      'proj_financing_id'  => new sfWidgetFormPropelChoice(array('model' => 'ProjFinancing', 'add_empty' => true)),
      'year_id'            => new sfWidgetFormPropelChoice(array('model' => 'Year', 'add_empty' => false)),
      'user_id'            => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'title'              => new sfWidgetFormInputText(),
      'description'        => new sfWidgetFormTextarea(),
      'notes'              => new sfWidgetFormTextarea(),
      'addressees'         => new sfWidgetFormTextarea(),
      'purposes'           => new sfWidgetFormTextarea(),
      'goals'              => new sfWidgetFormTextarea(),
      'final_report'       => new sfWidgetFormTextarea(),
      'proposals'          => new sfWidgetFormTextarea(),
      'hours_approved'     => new sfWidgetFormInputText(),
      'state'              => new sfWidgetFormInputText(),
      'submission_date'    => new sfWidgetFormDate(),
      'reference_number'   => new sfWidgetFormInputText(),
      'approval_date'      => new sfWidgetFormDate(),
      'approval_notes'     => new sfWidgetFormTextarea(),
      'financing_date'     => new sfWidgetFormDate(),
      'financing_notes'    => new sfWidgetFormTextarea(),
      'confirmation_date'  => new sfWidgetFormDate(),
      'confirmation_notes' => new sfWidgetFormTextarea(),
      'evaluation_min'     => new sfWidgetFormInputText(),
      'evaluation_max'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'proj_category_id'   => new sfValidatorPropelChoice(array('model' => 'ProjCategory', 'column' => 'id', 'required' => false)),
      'proj_financing_id'  => new sfValidatorPropelChoice(array('model' => 'ProjFinancing', 'column' => 'id', 'required' => false)),
      'year_id'            => new sfValidatorPropelChoice(array('model' => 'Year', 'column' => 'id')),
      'user_id'            => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'title'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'        => new sfValidatorString(array('required' => false)),
      'notes'              => new sfValidatorString(array('required' => false)),
      'addressees'         => new sfValidatorString(array('required' => false)),
      'purposes'           => new sfValidatorString(array('required' => false)),
      'goals'              => new sfValidatorString(array('required' => false)),
      'final_report'       => new sfValidatorString(array('required' => false)),
      'proposals'          => new sfValidatorString(array('required' => false)),
      'hours_approved'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'state'              => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'submission_date'    => new sfValidatorDate(array('required' => false)),
      'reference_number'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'approval_date'      => new sfValidatorDate(array('required' => false)),
      'approval_notes'     => new sfValidatorString(array('required' => false)),
      'financing_date'     => new sfValidatorDate(array('required' => false)),
      'financing_notes'    => new sfValidatorString(array('required' => false)),
      'confirmation_date'  => new sfValidatorDate(array('required' => false)),
      'confirmation_notes' => new sfValidatorString(array('required' => false)),
      'evaluation_min'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'evaluation_max'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('schoolproject[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Schoolproject';
  }


}
