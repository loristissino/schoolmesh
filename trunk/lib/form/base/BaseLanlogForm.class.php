<?php

/**
 * Lanlog form base class.
 *
 * @package    mattiussi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseLanlogForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'user_id'        => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'workstation_id' => new sfWidgetFormPropelChoice(array('model' => 'Workstation', 'add_empty' => false)),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'is_online'      => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'Lanlog', 'column' => 'id', 'required' => false)),
      'user_id'        => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'workstation_id' => new sfValidatorPropelChoice(array('model' => 'Workstation', 'column' => 'id')),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
      'is_online'      => new sfValidatorBoolean(),
    ));

    $this->widgetSchema->setNameFormat('lanlog[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lanlog';
  }


}
