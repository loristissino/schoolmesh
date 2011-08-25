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
  public function configure()
  {
    unset($this['schoolproject_id']);
    
    $this['description']->getWidget()
      ->setAttributes(array('size'=>'80'))
      ;
    
    $resource=$this->getObject();
    $project=$resource->getSchoolproject();
    $resourceType=$resource->getProjResourceType();
    
    $this['proj_resource_type_id']->getWidget()->setLabel('Resource type');
    
    if(!$resourceType)
    {
      unset($this['quantity_estimated'], $this['quantity_approved'], $this['quantity_final']);
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
    }
    
    switch ($project->getState())
    {
      case Workflow::PROJ_DRAFT:
        unset($this['quantity_approved']);
        unset($this['quantity_final']);
        break;
      case Workflow::PROJ_SUBMITTED:
        unset($this['description']);
        unset($this['proj_resource_type_id']);
        unset($this['quantity_estimated']);
        unset($this['quantity_final']);
        break;
      case Workflow::PROJ_APPROVED:
        unset($this['description']);
        unset($this['proj_resource_type_id']);
        unset($this['quantity_estimated']);
        break;
      case Workflow::PROJ_FINANCED:
        unset($this['description']);
        unset($this['proj_resource_type_id']);
        unset($this['quantity_estimated']);
        break;
        
    }
  
  }

  
}
