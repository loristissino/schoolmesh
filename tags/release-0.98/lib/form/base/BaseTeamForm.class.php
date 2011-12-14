<?php

/**
 * Team form base class.
 *
 * @method Team getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTeamForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'description'        => new sfWidgetFormInputText(),
      'posix_name'         => new sfWidgetFormInputText(),
      'quality_code'       => new sfWidgetFormInputText(),
      'needs_folder'       => new sfWidgetFormInputCheckbox(),
      'needs_mailing_list' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'description'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'posix_name'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'quality_code'       => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'needs_folder'       => new sfValidatorBoolean(array('required' => false)),
      'needs_mailing_list' => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('team[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Team';
  }


}
