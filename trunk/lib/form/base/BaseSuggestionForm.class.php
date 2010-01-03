<?php

/**
 * Suggestion form base class.
 *
 * @method Suggestion getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseSuggestionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'shortcut' => new sfWidgetFormInputText(),
      'content'  => new sfWidgetFormInputText(),
      'rank'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorPropelChoice(array('model' => 'Suggestion', 'column' => 'id', 'required' => false)),
      'shortcut' => new sfValidatorString(array('max_length' => 20)),
      'content'  => new sfValidatorString(array('max_length' => 255)),
      'rank'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('suggestion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Suggestion';
  }


}
