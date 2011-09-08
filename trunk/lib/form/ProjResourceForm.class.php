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
    
    $this->setWidget('scheduled_deadline', new sfWidgetFormI18nDate(array('culture'=>'it')));
    
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
        
      if($resourceType->getRoleId())
      {
        $this->setWidget('charged_user_id', new sfWidgetFormPropelChoice(array('model'=>'sfGuardUserProfile', 'add_empty'=>'Choose a user', 'peer_method'=>'doSelect', 'criteria'=>$resource->getCriteriaForUserSelection())));
        $this->setDefault('charged_user_id', $resource->getChargedUserId());
      }
      else
      {
        unset(
        $this['charged_user_id']
        );
      }

    }
    
    switch ($project->getState())
    {
      case Workflow::PROJ_DRAFT:
        unset(
          $this['quantity_approved'],
          $this['quantity_final'],
          $this['standard_cost']
          );
        break;
      case Workflow::PROJ_SUBMITTED:
        unset(
          $this['description'],
          $this['proj_resource_type_id'],
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
          $this['quantity_estimated'],
          $this['standard_cost'],
          $this['scheduled_deadline']
          );
        break;
      case Workflow::PROJ_FINANCED:
        unset(
          $this['description'],
          $this['proj_resource_type_id'],
          $this['quantity_estimated'],
          $this['standard_cost'],
          $this['scheduled_deadline']
          );
        break;
        
    }
  
  }

  
}
