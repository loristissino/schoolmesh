<?php

/**
 * sfGuardGroupProfile form base class.
 *
 * @package    form
 * @subpackage sf_guard_group_profile
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BasesfGuardGroupProfileForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'group_id'   => new sfWidgetFormPropelSelect(array('model' => 'sfGuardGroup', 'add_empty' => false)),
      'posix_name' => new sfWidgetFormInputText(),
      'priority'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'sfGuardGroupProfile', 'column' => 'id', 'required' => false)),
      'group_id'   => new sfValidatorPropelChoice(array('model' => 'sfGuardGroup', 'column' => 'id')),
      'posix_name' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'priority'   => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_group_profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardGroupProfile';
  }


}
