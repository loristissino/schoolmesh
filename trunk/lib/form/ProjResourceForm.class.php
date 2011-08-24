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
    $resource=$this->getObject();
    $project=$resource->getSchoolproject();
    $resourceType=$resource->getProjResourceType();
    
    $this['proj_resource_type_id']->getWidget()->setLabel('Resource type');
    
    if(!$resourceType)
    {
      unset($this['quantity_estimated'], $this['quantity_approved']);
    }
    else
    {
      $this['quantity_estimated']->getWidget()->setLabel('Qty estimated (' . $resourceType->getMeasurementUnit() . ')');
      $this['quantity_approved']->getWidget()->setLabel('Qty approved (' . $resourceType->getMeasurementUnit() . ')');
    }
    
    switch ($project->getState())
    {
      case Workflow::PROJ_DRAFT:
        unset($this['quantity_approved']);
        break;
      case Workflow::PROJ_SUBMITTED:
        unset($this['quantity_estimated']);
        break;
    }

    
    
  }
}
