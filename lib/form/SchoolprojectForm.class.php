<?php

/**
 * Schoolproject form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class SchoolprojectForm extends BaseSchoolprojectForm
{
  public function configure()
  {
  
  unset($this['user_id'], $this['year_id'], $this['state']);
    
	$this['title']->getWidget()->setAttribute('size', '80');
	$this['description']->getWidget()->setAttribute('size', '100');

/*	$this['user_id']->getWidget()->setOption('model', 'sfGuardUserProfile');
	$this['user_id']->getWidget()->setOption('peer_method', 'retrieveAllButStudents');
	$this['user_id']->getWidget()->setOption('add_empty', 'Choose a user');
*/	
	$this->widgetSchema->setLabel('proj_category_id', 'Category');
/*
  $this->widgetSchema->setLabel('user_id', 'Coordinator');
*/	
  }
  
  public function addStateDependentConfiguration($state)
  {
    switch($state)
    {
      case Workflow::PROJ_DRAFT:
        break;
      case Workflow::PROJ_SUBMITTED:
        unset($this['title'], $this['description'], $this['notes']);
        break;
      case Workflow::PROJ_APPROVED:
        unset($this['title'], $this['description'], $this['proj_category_id'], $this['hours_approved']);
        break;
      case Workflow::PROJ_FINISHED:
        unset($this['title'], $this['description'], $this['notes']);
        break;
    }
  }

  
}
