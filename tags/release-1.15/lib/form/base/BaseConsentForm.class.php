<?php

/**
 * Consent form base class.
 *
 * @method Consent getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseConsentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'user_id'               => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'informativecontent_id' => new sfWidgetFormPropelChoice(array('model' => 'Informativecontent', 'add_empty' => true)),
      'given_at'              => new sfWidgetFormDateTime(),
      'method'                => new sfWidgetFormInputText(),
      'notes'                 => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'user_id'               => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'informativecontent_id' => new sfValidatorPropelChoice(array('model' => 'Informativecontent', 'column' => 'id', 'required' => false)),
      'given_at'              => new sfValidatorDateTime(array('required' => false)),
      'method'                => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'notes'                 => new sfValidatorString(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Consent', 'column' => array('user_id', 'informativecontent_id')))
    );

    $this->widgetSchema->setNameFormat('consent[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Consent';
  }


}
