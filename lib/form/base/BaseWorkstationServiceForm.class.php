<?php

/**
 * WorkstationService form base class.
 *
 * @method WorkstationService getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseWorkstationServiceForm extends BaseFormPropel
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
