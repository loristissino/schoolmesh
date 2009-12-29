<?php

/**
 * WorkstationService filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseWorkstationServiceFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('workstation_service_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WorkstationService';
  }

  public function getFields()
  {
    return array(
      'workstation_id' => 'ForeignKey',
      'service_id'     => 'ForeignKey',
    );
  }
}
