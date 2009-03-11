<?php

/**
 * SubnetService form base class.
 *
 * @package    mattiussi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseSubnetServiceForm extends BaseFormPropel
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
