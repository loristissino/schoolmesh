<?php

/**
 * SyllabusItem form base class.
 *
 * @method SyllabusItem getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseSyllabusItemForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'syllabus_id'   => new sfWidgetFormPropelChoice(array('model' => 'Syllabus', 'add_empty' => true)),
      'id'            => new sfWidgetFormInputHidden(),
      'level'         => new sfWidgetFormInputText(),
      'parent_id'     => new sfWidgetFormPropelChoice(array('model' => 'SyllabusItem', 'add_empty' => true)),
      'content'       => new sfWidgetFormInputText(),
      'is_selectable' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'syllabus_id'   => new sfValidatorPropelChoice(array('model' => 'Syllabus', 'column' => 'id', 'required' => false)),
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'level'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'parent_id'     => new sfValidatorPropelChoice(array('model' => 'SyllabusItem', 'column' => 'id', 'required' => false)),
      'content'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_selectable' => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('syllabus_item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SyllabusItem';
  }


}
