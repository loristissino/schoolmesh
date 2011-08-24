<?php

/**
 * ProjResource form base class.
 *
 * @method ProjResource getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseProjResourceForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'schoolproject_id'      => new sfWidgetFormPropelChoice(array('model' => 'Schoolproject', 'add_empty' => true)),
      'proj_resource_type_id' => new sfWidgetFormPropelChoice(array('model' => 'ProjResourceType', 'add_empty' => true)),
      'description'           => new sfWidgetFormInputText(),
      'quantity_estimated'    => new sfWidgetFormInputText(),
      'quantity_approved'     => new sfWidgetFormInputText(),
      'hours_estimated'       => new sfWidgetFormInputText(),
      'hours_approved'        => new sfWidgetFormInputText(),
      'amount_estimated'      => new sfWidgetFormInputText(),
      'amount_approved'       => new sfWidgetFormInputText(),
      'total_amount_computed' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'schoolproject_id'      => new sfValidatorPropelChoice(array('model' => 'Schoolproject', 'column' => 'id', 'required' => false)),
      'proj_resource_type_id' => new sfValidatorPropelChoice(array('model' => 'ProjResourceType', 'column' => 'id', 'required' => false)),
      'description'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'quantity_estimated'    => new sfValidatorNumber(array('required' => false)),
      'quantity_approved'     => new sfValidatorNumber(array('required' => false)),
      'hours_estimated'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'hours_approved'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'amount_estimated'      => new sfValidatorNumber(array('required' => false)),
      'amount_approved'       => new sfValidatorNumber(array('required' => false)),
      'total_amount_computed' => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('proj_resource[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjResource';
  }


}
