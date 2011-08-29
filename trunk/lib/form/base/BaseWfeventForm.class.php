<?php

/**
 * Wfevent form base class.
 *
 * @method Wfevent getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseWfeventForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'base_table' => new sfWidgetFormInputText(),
      'base_id'    => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'user_id'    => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'comment'    => new sfWidgetFormInputText(),
      'state'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'base_table' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'base_id'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'user_id'    => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'comment'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'state'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('wfevent[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Wfevent';
  }


}
