<?php

/**
 * SystemMessageI18n form base class.
 *
 * @method SystemMessageI18n getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseSystemMessageI18nForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'content' => new sfWidgetFormInputText(),
      'id'      => new sfWidgetFormInputHidden(),
      'culture' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'content' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id'      => new sfValidatorPropelChoice(array('model' => 'SystemMessage', 'column' => 'id', 'required' => false)),
      'culture' => new sfValidatorChoice(array('choices' => array($this->getObject()->getCulture()), 'empty_value' => $this->getObject()->getCulture(), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('system_message_i18n[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SystemMessageI18n';
  }


}
