<?php

/**
 * ProjDeadline form base class.
 *
 * @method ProjDeadline getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseProjDeadlineForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'schoolproject_id'       => new sfWidgetFormPropelChoice(array('model' => 'Schoolproject', 'add_empty' => true)),
      'user_id'                => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'original_deadline_date' => new sfWidgetFormDate(),
      'current_deadline_date'  => new sfWidgetFormDate(),
      'description'            => new sfWidgetFormInputText(),
      'notes'                  => new sfWidgetFormTextarea(),
      'completed'              => new sfWidgetFormInputCheckbox(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorPropelChoice(array('model' => 'ProjDeadline', 'column' => 'id', 'required' => false)),
      'schoolproject_id'       => new sfValidatorPropelChoice(array('model' => 'Schoolproject', 'column' => 'id', 'required' => false)),
      'user_id'                => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'original_deadline_date' => new sfValidatorDate(array('required' => false)),
      'current_deadline_date'  => new sfValidatorDate(array('required' => false)),
      'description'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'notes'                  => new sfValidatorString(array('required' => false)),
      'completed'              => new sfValidatorBoolean(array('required' => false)),
      'created_at'             => new sfValidatorDateTime(array('required' => false)),
      'updated_at'             => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('proj_deadline[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjDeadline';
  }


}
