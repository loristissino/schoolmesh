<?php

/**
 * ProjResource form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 */
class ProjResourceForm extends BaseProjResourceForm
{
  
  
  public function getCurrentCulture()
  {
    return isset($this->options['culture']) ? $this->options['culture'] : 'en';
  }

  public function configure()
  {
    
    $this->setWidget('scheduled_deadline', new sfWidgetFormI18nDate(array('culture'=>$this->getCurrentCulture())));
    
    unset($this['schoolproject_id']);
    unset($this['is_monetary']);
    unset($this['amount_estimated']);
    
    $this['description']->getWidget()
      ->setAttributes(array('size'=>'80'))
      ;
      
    $this['financing_notes']->getWidget()
      ->setAttributes(array('size'=>'80'))
      ;
    
    $resource=$this->getObject();
    $project=$resource->getSchoolproject();
    $resourceType=$resource->getProjResourceType();
    
    $this->setValidators(array(
				'proj_resource_type_id' => new sfValidatorPropelChoice(array('model'=>'ProjResourceType')),
				'description' => new sfValidatorString(array('required'=>true)),
				'scheduled_deadline' => new sfValidatorDate(),
        'id' => new sfValidatorInteger(),
        'quantity_estimated' => new sfValidatorNumber(array('min'=>0)),
        'quantity_approved' => new sfValidatorNumber(array('min'=>0)),
        'amount_funded_externally'=> new sfValidatorNumber(array('required'=>false, 'max'=>$resource->getAmountEstimated())),
        'financing_notes'=> new sfValidatorString(array('trim'=>true, 'required'=>false)),
        'charged_user_id' => new sfValidatorPropelChoice(array('model'=>'sfGuardUserProfile', 'required'=>false)),
        'quantity_final' => new sfValidatorNumber(array('required'=>false)),
			));
    
    $this['proj_resource_type_id']->getWidget()->setLabel('Resource type');
    
    if(!$resourceType)
    {
      unset(
        $this['quantity_estimated'],
        $this['quantity_approved'],
        $this['quantity_final'],
        $this['charged_user_id']
        );
    }
    else
    {
      $this['quantity_estimated']->getWidget()
        ->setLabel('Qty estimated (' . $resourceType->getMeasurementUnit() . ')')
        ->setAttributes(array('size'=>'5', 'style'=>'text-align: right'))
        ;
      $this['quantity_approved']->getWidget()
        ->setLabel('Qty approved (' . $resourceType->getMeasurementUnit() . ')')
        ->setAttributes(array('size'=>'5', 'style'=>'text-align: right'))
        ;
      $this['quantity_final']->getWidget()
        ->setLabel('Qty final (' . $resourceType->getMeasurementUnit() . ')')
        ->setAttributes(array('size'=>'5', 'style'=>'text-align: right'))
        ;
      $this['amount_funded_externally']->getWidget()
        ->setLabel('Funded ext.lly ('.sfConfig::get('app_config_currency_symbol') . ')')
        ->setAttributes(array('size'=>'5', 'style'=>'text-align: right'))
        ;

      if($resourceType->getRoleId())
      {
        $this->setWidget('charged_user_id', new sfWidgetFormPropelChoice(array('model'=>'sfGuardUserProfile', 'add_empty'=>'Choose a charged person', 'peer_method'=>'doSelect', 'criteria'=>$resource->getCriteriaForUserSelection())));
        $this->setDefault('charged_user_id', $resource->getChargedUserId());
      }
      else
      {
        unset(
        $this['charged_user_id']
        );
      }
      
      if($resourceType->getMeasurementUnit()=='h')
      {
        
        $this->validatorSchema['quantity_estimated'] = new sfValidatorCallback(array(
          'callback'  => array($this, 'hours_validator_callback'),
          'required' => true,
          'arguments' => array('separator' => sfConfig::get('app_config_hoursminutessep', ':')),
          ));
        
        /*
         * $k=Generic::getHoursAsString($resource->getQuantityEstimated(), sfConfig::get('app_config_hoursminutessep', ':'));
        Generic::logMessage('default got', $k);
        
        $this->setDefault('quantity_estimated', $k);
        
        Generic::logMessage('default set', $this->getDefault('quantity_estimated'));
        
        $this->setDefault('quantity_approved', Generic::getHoursAsString($resource->getQuantityApproved(), sfConfig::get('app_config_hoursminutessep', ':')));
        */
      }
      

    }
    
    switch ($project->getState())
    {
      case Workflow::PROJ_DRAFT:
        unset(
          $this['quantity_approved'],
          $this['quantity_final'],
          $this['standard_cost'],
          $this['amount_funded_externally'],
          $this['financing_notes']
          );
        break;
      case Workflow::PROJ_SUBMITTED:
        unset(
          $this['description'],
          $this['proj_resource_type_id'],
          $this['charged_user_id'],
          $this['quantity_estimated'],
          $this['quantity_final'],
          $this['standard_cost'],
          $this['scheduled_deadline']
          );
        break;
      case Workflow::PROJ_APPROVED:
        unset(
          $this['description'],
          $this['proj_resource_type_id'],
          $this['charged_user_id'],
          $this['quantity_estimated'],
          $this['standard_cost'],
          $this['scheduled_deadline']
          );
        break;
      case Workflow::PROJ_FINANCED:
        unset(
          $this['description'],
          $this['proj_resource_type_id'],
          $this['charged_user_id'],
          $this['quantity_estimated'],
          $this['standard_cost'],
          $this['scheduled_deadline']
          );
        break;
      case Workflow::PROJ_CONFIRMED:
        unset(
          $this['description'],
          $this['proj_resource_type_id'],
          $this['charged_user_id'],
          $this['quantity_estimated'],
          $this['quantity_approved'],
          $this['standard_cost'],
          $this['scheduled_deadline']
          );
        break;
        
    }
  
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
