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
      'id'                => new sfWidgetFormInputHidden(),
      'proj_category_id'  => new sfWidgetFormPropelChoice(array('model' => 'ProjCategory', 'add_empty' => true)),
      'proj_financing_id' => new sfWidgetFormPropelChoice(array('model' => 'ProjFinancing', 'add_empty' => true)),
      'year_id'           => new sfWidgetFormPropelChoice(array('model' => 'Year', 'add_empty' => false)),
      'user_id'           => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'title'             => new sfWidgetFormInputText(),
      'description'       => new sfWidgetFormInputText(),
      'notes'             => new sfWidgetFormTextarea(),
      'hours_approved'    => new sfWidgetFormInputText(),
      'state'             => new sfWidgetFormInputText(),
      'submission_date'   => new sfWidgetFormDate(),
      'approval_date'     => new sfWidgetFormDate(),
      'approval_notes'    => new sfWidgetFormTextarea(),
      'financing_date'    => new sfWidgetFormDate(),
      'financing_notes'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'proj_category_id'  => new sfValidatorPropelChoice(array('model' => 'ProjCategory', 'column' => 'id', 'required' => false)),
      'proj_financing_id' => new sfValidatorPropelChoice(array('model' => 'ProjFinancing', 'column' => 'id', 'required' => false)),
      'year_id'           => new sfValidatorPropelChoice(array('model' => 'Year', 'column' => 'id')),
      'user_id'           => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'title'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'notes'             => new sfValidatorString(array('required' => false)),
      'hours_approved'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'state'             => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'submission_date'   => new sfValidatorDate(array('required' => false)),
      'approval_date'     => new sfValidatorDate(array('required' => false)),
      'approval_notes'    => new sfValidatorString(array('required' => false)),
      'financing_date'    => new sfValidatorDate(array('required' => false)),
      'financing_notes'   => new sfValidatorString(array('required' => false)),
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
