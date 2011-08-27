<?php

/**
 * ProjActivity form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
class ProjActivityForm extends BaseProjActivityForm
{
  public function configure()
  {
    
    unset(
      $this['id'],
      $this['user_id'],
      $this['created_at'],
      $this['acknowledged_at'],
      $this['acknowledger_user_id']
      );
      
    $this->setWidget('beginning', new sfWidgetFormI18nDateTime(array('culture'=>'it')));
    $this->setWidget('proj_resource_id', new sfWidgetFormInputText(array('type'=>'hidden', 'is_hidden'=>true)));


    $this['notes']->getWidget()
      ->setAttributes(array('cols'=>'60', 'rows'=>'5'))
      ;

    $this->widgetSchema->setNameFormat('info[%s]');

    $this->setValidators(array(
      'beginning' => new sfValidatorDatetime(array('required'=>true, 'max'=>time())),
      'notes' => new sfValidatorString(array('trim' => true, 'min_length'=>4, 'required'=>true)),
      'quantity' => new sfValidatorNumber(array('min'=>0.5, 'required'=>true)),
      'proj_resource_id' => new sfValidatorPropelChoice(array('model'=>'ProjResource')), 
      ));

  }
  public function addConfiguration(ProjResource $resource)
  {
    $resourceType=$resource->getProjResourceType();
    $this['quantity']->getWidget()
      ->setLabel('Qty used (' . $resourceType->getMeasurementUnit() . ')')
      ->setAttributes(array('size'=>'5', 'style'=>'text-align: right'))
      ;
  }
}
