<?php

/**
 * Schoolclass form base class.
 *
 * @method Schoolclass getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseSchoolclassForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'grade'       => new sfWidgetFormInputText(),
      'section'     => new sfWidgetFormInputText(),
      'track_id'    => new sfWidgetFormPropelChoice(array('model' => 'Track', 'add_empty' => true)),
      'description' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'grade'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'section'     => new sfValidatorString(array('max_length' => 3)),
      'track_id'    => new sfValidatorPropelChoice(array('model' => 'Track', 'column' => 'id', 'required' => false)),
      'description' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('schoolclass[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Schoolclass';
  }


}
