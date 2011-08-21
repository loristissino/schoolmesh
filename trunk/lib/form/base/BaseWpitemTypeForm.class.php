<?php

/**
 * WpitemType form base class.
 *
 * @method WpitemType getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseWpitemTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                         => new sfWidgetFormInputHidden(),
      'title'                      => new sfWidgetFormInputText(),
      'singular'                   => new sfWidgetFormInputText(),
      'description'                => new sfWidgetFormInputText(),
      'style'                      => new sfWidgetFormInputText(),
      'rank'                       => new sfWidgetFormInputText(),
      'state'                      => new sfWidgetFormInputText(),
      'is_required'                => new sfWidgetFormInputCheckbox(),
      'syllabus_id'                => new sfWidgetFormPropelChoice(array('model' => 'Syllabus', 'add_empty' => true)),
      'code'                       => new sfWidgetFormInputText(),
      'evaluation_min'             => new sfWidgetFormInputText(),
      'evaluation_max'             => new sfWidgetFormInputText(),
      'evaluation_min_description' => new sfWidgetFormInputText(),
      'evaluation_max_description' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'title'                      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'singular'                   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'description'                => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'style'                      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'rank'                       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'state'                      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'is_required'                => new sfValidatorBoolean(array('required' => false)),
      'syllabus_id'                => new sfValidatorPropelChoice(array('model' => 'Syllabus', 'column' => 'id', 'required' => false)),
      'code'                       => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'evaluation_min'             => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'evaluation_max'             => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'evaluation_min_description' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'evaluation_max_description' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('wpitem_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WpitemType';
  }


}
