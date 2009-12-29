<?php

/**
 * SubnetService form base class.
 *
 * @method SubnetService getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseSubnetServiceForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'subnet_id'  => new sfWidgetFormInputHidden(),
      'service_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'subnet_id'  => new sfValidatorPropelChoice(array('model' => 'Subnet', 'column' => 'id', 'required' => false)),
      'service_id' => new sfValidatorPropelChoice(array('model' => 'Service', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('subnet_service[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SubnetService';
  }


}
