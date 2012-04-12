<?php

/**
 * Syllabus form base class.
 *
 * @method Syllabus getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseSyllabusForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'name'      => new sfWidgetFormInputText(),
      'version'   => new sfWidgetFormInputText(),
      'author'    => new sfWidgetFormInputText(),
      'href'      => new sfWidgetFormInputText(),
      'is_active' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'version'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'author'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'href'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_active' => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('syllabus[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Syllabus';
  }


}
