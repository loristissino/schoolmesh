<?php

/**
 * ProjActivity form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 */
class ProjActivityForm extends BaseProjActivityForm
{
  public function configure()
  {
    
    unset(
      $this['id'],
      $this['created_at'],
      $this['acknowledged_at'],
      $this['acknowledger_user_id'],
      $this['added_by_coordinator']
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
      'user_id' => new sfValidatorPropelChoice(array('model'=>'sfGuardUser')),
      'paper_log' => new sfValidatorBoolean(array('required'=>false)),
      ));

  }
  public function addConfiguration(ProjResource $resource)
  {
    $resourceType=$resource->getProjResourceType();
    $this['quantity']->getWidget()
      ->setLabel('Qty used (' . $resourceType->getMeasurementUnit() . ')')
      ->setAttributes(array('size'=>'5', 'style'=>'text-align: right'))
      ;
    $this->setWidget('user_id', new sfWidgetFormPropelChoice(array('model'=>'sfGuardUserProfile', 'add_empty'=>'Choose the performer', 'peer_method'=>'doSelect', 'criteria'=>$resource->getCriteriaForUserSelection()))); 

    $this['user_id']->getWidget()->setLabel('Performer');
    
    if($resourceType->getMeasurementUnit()=='h')
    {      
      $this->validatorSchema['quantity'] = new sfValidatorCallback(array(
      'callback'  => array($this, 'hours_validator_callback'),
      'required' => true,
      'arguments' => array('separator' => sfConfig::get('app_config_hoursminutessep', ':')),
      ));
      
      $this->setDefault('quantity', Generic::getHoursAsString($this->getObject()->getQuantity(), sfConfig::get('app_config_hoursminutessep', ':')));
    }
  }
  
  public function unsetUserId()
  {
    // this is called when a user declares an activity by themselves
    unset(
      $this['user_id']
      );
  }
  
  
  public function hours_validator_callback($validator, $value, $arguments)
  {
    $value=Generic::getHoursAsNumber($value, $arguments['separator']);
    if($value==-1)
    {
      throw new sfValidatorError($validator, 'invalid');
    }
   
    return $value;
  }
  
}
