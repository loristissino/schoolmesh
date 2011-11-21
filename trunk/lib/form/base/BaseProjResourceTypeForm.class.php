<?php

/**
 * ProjResourceType form base class.
 *
 * @method ProjResourceType getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseProjResourceTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'description'      => new sfWidgetFormInputText(),
      'role_id'          => new sfWidgetFormPropelChoice(array('model' => 'Role', 'add_empty' => true)),
      'standard_cost'    => new sfWidgetFormInputText(),
      'measurement_unit' => new sfWidgetFormInputText(),
      'is_monetary'      => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'description'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'role_id'          => new sfValidatorPropelChoice(array('model' => 'Role', 'column' => 'id', 'required' => false)),
      'standard_cost'    => new sfValidatorNumber(array('required' => false)),
      'measurement_unit' => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'is_monetary'      => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('proj_resource_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjResourceType';
  }


}
