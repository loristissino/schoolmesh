<?php

/**
 * Workstation form base class.
 *
 * @method Workstation getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseWorkstationForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'ip_cidr'     => new sfWidgetFormInputText(),
      'mac_address' => new sfWidgetFormInputText(),
      'is_enabled'  => new sfWidgetFormInputCheckbox(),
      'is_active'   => new sfWidgetFormInputCheckbox(),
      'location_x'  => new sfWidgetFormInputText(),
      'location_y'  => new sfWidgetFormInputText(),
      'subnet_id'   => new sfWidgetFormPropelChoice(array('model' => 'Subnet', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'ip_cidr'     => new sfValidatorString(array('max_length' => 20)),
      'mac_address' => new sfValidatorString(array('max_length' => 17, 'required' => false)),
      'is_enabled'  => new sfValidatorBoolean(array('required' => false)),
      'is_active'   => new sfValidatorBoolean(array('required' => false)),
      'location_x'  => new sfValidatorNumber(array('required' => false)),
      'location_y'  => new sfValidatorNumber(array('required' => false)),
      'subnet_id'   => new sfValidatorPropelChoice(array('model' => 'Subnet', 'column' => 'id', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'Workstation', 'column' => array('name'))),
        new sfValidatorPropelUnique(array('model' => 'Workstation', 'column' => array('ip_cidr'))),
        new sfValidatorPropelUnique(array('model' => 'Workstation', 'column' => array('mac_address'))),
      ))
    );

    $this->widgetSchema->setNameFormat('workstation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Workstation';
  }


}
