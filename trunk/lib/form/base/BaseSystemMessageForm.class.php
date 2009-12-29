<?php

/**
 * SystemMessage form base class.
 *
 * @method SystemMessage getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
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
      'id'  => new sfValidatorPropelChoice(array('model' => 'SystemMessage', 'column' => 'id', 'required' => false)),
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
