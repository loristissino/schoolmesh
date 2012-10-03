<?php

/**
 * Suggestion form base class.
 *
 * @method Suggestion getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseSuggestionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'shortcut'      => new sfWidgetFormInputText(),
      'content'       => new sfWidgetFormInputText(),
      'is_selectable' => new sfWidgetFormInputCheckbox(),
      'rank'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'shortcut'      => new sfValidatorString(array('max_length' => 20)),
      'content'       => new sfValidatorString(array('max_length' => 255)),
      'is_selectable' => new sfValidatorBoolean(array('required' => false)),
      'rank'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Suggestion', 'column' => array('shortcut')))
    );

    $this->widgetSchema->setNameFormat('suggestion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Suggestion';
  }


}
