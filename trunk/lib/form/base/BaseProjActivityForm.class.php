<?php

/**
 * ProjActivity form base class.
 *
 * @method ProjActivity getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseProjActivityForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'schoolproject_id' => new sfWidgetFormPropelChoice(array('model' => 'Schoolproject', 'add_empty' => true)),
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'beginning'        => new sfWidgetFormDateTime(),
      'ending'           => new sfWidgetFormDateTime(),
      'amount'           => new sfWidgetFormInputText(),
      'notes'            => new sfWidgetFormTextarea(),
      'created_at'       => new sfWidgetFormDateTime(),
      'approved_at'      => new sfWidgetFormDateTime(),
      'approver_user_id' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'schoolproject_id' => new sfValidatorPropelChoice(array('model' => 'Schoolproject', 'column' => 'id', 'required' => false)),
      'user_id'          => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'beginning'        => new sfValidatorDateTime(array('required' => false)),
      'ending'           => new sfValidatorDateTime(array('required' => false)),
      'amount'           => new sfValidatorNumber(array('required' => false)),
      'notes'            => new sfValidatorString(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
      'approved_at'      => new sfValidatorDateTime(array('required' => false)),
      'approver_user_id' => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('proj_activity[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjActivity';
  }


}
