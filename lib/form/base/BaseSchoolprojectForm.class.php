<?php

/**
 * Schoolproject form base class.
 *
 * @method Schoolproject getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseSchoolprojectForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'proj_category_id'    => new sfWidgetFormPropelChoice(array('model' => 'ProjCategory', 'add_empty' => true)),
      'code'                => new sfWidgetFormInputText(),
      'year_id'             => new sfWidgetFormPropelChoice(array('model' => 'Year', 'add_empty' => false)),
      'user_id'             => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'team_id'             => new sfWidgetFormPropelChoice(array('model' => 'Team', 'add_empty' => true)),
      'title'               => new sfWidgetFormInputText(),
      'hours_approved'      => new sfWidgetFormInputText(),
      'state'               => new sfWidgetFormInputText(),
      'submission_date'     => new sfWidgetFormDate(),
      'reference_number'    => new sfWidgetFormInputText(),
      'approval_date'       => new sfWidgetFormDate(),
      'approval_notes'      => new sfWidgetFormTextarea(),
      'financing_date'      => new sfWidgetFormDate(),
      'financing_notes'     => new sfWidgetFormTextarea(),
      'confirmation_date'   => new sfWidgetFormDate(),
      'confirmation_notes'  => new sfWidgetFormTextarea(),
      'rejection_date'      => new sfWidgetFormDate(),
      'rejection_notes'     => new sfWidgetFormTextarea(),
      'evaluation_min'      => new sfWidgetFormInputText(),
      'evaluation_max'      => new sfWidgetFormInputText(),
      'no_activity_confirm' => new sfWidgetFormInputCheckbox(),
      'created_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'proj_category_id'    => new sfValidatorPropelChoice(array('model' => 'ProjCategory', 'column' => 'id', 'required' => false)),
      'code'                => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'year_id'             => new sfValidatorPropelChoice(array('model' => 'Year', 'column' => 'id')),
      'user_id'             => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'team_id'             => new sfValidatorPropelChoice(array('model' => 'Team', 'column' => 'id', 'required' => false)),
      'title'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'hours_approved'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'state'               => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'submission_date'     => new sfValidatorDate(array('required' => false)),
      'reference_number'    => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'approval_date'       => new sfValidatorDate(array('required' => false)),
      'approval_notes'      => new sfValidatorString(array('required' => false)),
      'financing_date'      => new sfValidatorDate(array('required' => false)),
      'financing_notes'     => new sfValidatorString(array('required' => false)),
      'confirmation_date'   => new sfValidatorDate(array('required' => false)),
      'confirmation_notes'  => new sfValidatorString(array('required' => false)),
      'rejection_date'      => new sfValidatorDate(array('required' => false)),
      'rejection_notes'     => new sfValidatorString(array('required' => false)),
      'evaluation_min'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'evaluation_max'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'no_activity_confirm' => new sfValidatorBoolean(array('required' => false)),
      'created_at'          => new sfValidatorDateTime(array('required' => false)),
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
