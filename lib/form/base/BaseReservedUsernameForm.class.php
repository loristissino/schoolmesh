<?php

/**
 * ReservedUsername form base class.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseReservedUsernameForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'username'   => new sfWidgetFormInput(),
      'aliases_to' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'ReservedUsername', 'column' => 'id', 'required' => false)),
      'username'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'aliases_to' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'ReservedUsername', 'column' => array('username')))
    );

    $this->widgetSchema->setNameFormat('reserved_username[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ReservedUsername';
  }


}
