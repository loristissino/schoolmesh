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
      'id'                   => new sfWidgetFormInputHidden(),
      'proj_resource_id'     => new sfWidgetFormPropelChoice(array('model' => 'ProjResource', 'add_empty' => true)),
      'user_id'              => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'beginning'            => new sfWidgetFormDateTime(),
      'quantity'             => new sfWidgetFormInputText(),
      'notes'                => new sfWidgetFormTextarea(),
      'created_at'           => new sfWidgetFormDateTime(),
      'acknowledged_at'      => new sfWidgetFormDateTime(),
      'acknowledger_user_id' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'added_by_coordinator' => new sfWidgetFormInputCheckbox(),
      'paper_log'            => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'proj_resource_id'     => new sfValidatorPropelChoice(array('model' => 'ProjResource', 'column' => 'id', 'required' => false)),
      'user_id'              => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'beginning'            => new sfValidatorDateTime(array('required' => false)),
      'quantity'             => new sfValidatorNumber(array('required' => false)),
      'notes'                => new sfValidatorString(array('required' => false)),
      'created_at'           => new sfValidatorDateTime(array('required' => false)),
      'acknowledged_at'      => new sfValidatorDateTime(array('required' => false)),
      'acknowledger_user_id' => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'added_by_coordinator' => new sfValidatorBoolean(array('required' => false)),
      'paper_log'            => new sfValidatorBoolean(array('required' => false)),
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
