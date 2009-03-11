<?php

/**
 * WorkstationService form base class.
 *
 * @package    mattiussi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseWorkstationServiceForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'workstation_id' => new sfWidgetFormInputHidden(),
      'service_id'     => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'workstation_id' => new sfValidatorPropelChoice(array('model' => 'Workstation', 'column' => 'id', 'required' => false)),
      'service_id'     => new sfValidatorPropelChoice(array('model' => 'Service', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('workstation_service[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WorkstationService';
  }


}
