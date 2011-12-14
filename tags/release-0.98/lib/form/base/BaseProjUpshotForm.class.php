<?php

/**
 * ProjUpshot form base class.
 *
 * @method ProjUpshot getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseProjUpshotForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'schoolproject_id' => new sfWidgetFormPropelChoice(array('model' => 'Schoolproject', 'add_empty' => true)),
      'description'      => new sfWidgetFormInputText(),
      'indicator'        => new sfWidgetFormInputText(),
      'upshot'           => new sfWidgetFormInputText(),
      'evaluation'       => new sfWidgetFormInputText(),
      'scheduled_date'   => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'schoolproject_id' => new sfValidatorPropelChoice(array('model' => 'Schoolproject', 'column' => 'id', 'required' => false)),
      'description'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'indicator'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'upshot'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'evaluation'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'scheduled_date'   => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('proj_upshot[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjUpshot';
  }


}
