<?php

/**
 * SystemMessage form base class.
 *
 * @method SystemMessage getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseSystemMessageForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'  => new sfWidgetFormInputHidden(),
      'key' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'key' => new sfValidatorString(array('max_length' => 30, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'SystemMessage', 'column' => array('key')))
    );

    $this->widgetSchema->setNameFormat('system_message[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SystemMessage';
  }

  public function getI18nModelName()
  {
    return 'SystemMessageI18n';
  }

  public function getI18nFormClass()
  {
    return 'SystemMessageI18nForm';
  }

}
