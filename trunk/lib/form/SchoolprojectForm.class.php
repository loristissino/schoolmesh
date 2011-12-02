<?php

/**
 * Schoolproject form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class SchoolprojectForm extends BaseSchoolprojectForm
{
  public function configure()
  {
    
  $this->schoolproject=$this->getObject();
  
  unset($this['user_id'], $this['year_id'], $this['state']);
    
	$this['title']->getWidget()->setAttribute('size', '80');

/*	$this['user_id']->getWidget()->setOption('model', 'sfGuardUserProfile');
	$this['user_id']->getWidget()->setOption('peer_method', 'retrieveAllButStudents');
	$this['user_id']->getWidget()->setOption('add_empty', 'Choose a user');
*/	
	$this->widgetSchema->setLabel('proj_category_id', 'Category');
	$this->widgetSchema->setLabel('proj_financing_id', 'Financing');
  $this['notes']->getWidget()->setAttributes(array('cols'=>'80', 'rows'=>'10'));
  $this['addressees']->getWidget()->setAttributes(array('cols'=>'80', 'rows'=>'10'));
  $this['purposes']->getWidget()->setAttributes(array('cols'=>'80', 'rows'=>'10'));
  $this['goals']->getWidget()->setAttributes(array('cols'=>'80', 'rows'=>'10'));
  $this['description']->getWidget()->setAttributes(array('cols'=>'80', 'rows'=>'10'));
  $this['final_report']->getWidget()->setAttributes(array('cols'=>'80', 'rows'=>'10'));
  $this['proposals']->getWidget()->setAttributes(array('cols'=>'80', 'rows'=>'10'));
  
/*
  $this->widgetSchema->setLabel('user_id', 'Coordinator');
*/	
  }
  
  public function addUserDependentConfiguration($user)
  {
    unset(
      $this['evaluation_min'],
      $this['evaluation_max']
      );
    
    switch($this->schoolproject->getState())
    {
      case Workflow::PROJ_DRAFT:
        unset(
          $this['hours_approved'],
          $this['submission_date'],
          $this['approval_date'], 
          $this['financing_date'],
          $this['confirmation_date'],
          $this['approval_notes'], 
          $this['financing_notes'],
          $this['confirmation_notes'],
          $this['notes'],
          $this['final_report'],
          $this['proposals'],
          $this['reference_number']
          );
        break;
      case Workflow::PROJ_SUBMITTED:
        unset(
          $this['hours_approved'],
          $this['title'],
          $this['description'],
          $this['notes'],
          $this['proj_category_id'],
          $this['submission_date'],
          $this['approval_date'],
          $this['financing_date'],
          $this['confirmation_date'],
          $this['approval_notes'], 
          $this['financing_notes'],
          $this['confirmation_notes'],
          $this['addressees'],
          $this['purposes'],
          $this['goals']
          );
          if(!$user->hasCredential('proj_adm_ok'))
          {
            // in the office they can change ref numbers and financing types
            unset(
              $this['reference_number'],
              $this['proj_financing_id']
            );
          }
          if($user!=$this->schoolproject->getsfGuardUser())
          {
            // the coordinator can change final notes
            unset(
              $this['final_report'],
              $this['proposals']
            );
          }
          
          
        break;
      case Workflow::PROJ_APPROVED:
        unset(
          $this['hours_approved'],
          $this['title'],
          $this['description'],
          $this['notes'],
          $this['proj_category_id'],
          $this['proj_financing_id'],
          $this['submission_date'],
          $this['approval_date'],
          $this['confirmation_date'],
          $this['financing_date'],
          $this['approval_notes'], 
          $this['financing_notes'],
          $this['confirmation_notes'],
          $this['addressees'],
          $this['purposes'],
          $this['goals'],
          $this['reference_number']
          );
        break;
      case Workflow::PROJ_FINANCED:
        unset(
          $this['hours_approved'],
          $this['title'],
          $this['description'],
          $this['notes'],
          $this['proj_category_id'],
          $this['proj_financing_id'],
          $this['submission_date'],
          $this['approval_date'],
          $this['financing_date'],
          $this['confirmation_date'],
          $this['approval_notes'], 
          $this['financing_notes'],
          $this['confirmation_notes'],
          $this['addressees'],
          $this['purposes'],
          $this['goals'],
          $this['reference_number']
          );
        break;
      case Workflow::PROJ_FINISHED:
        unset(
          $this['hours_approved'],
          $this['title'],
          $this['description'],
          $this['notes'],
          $this['proj_category_id'],
          $this['proj_financing_id'],
          $this['submission_date'],
          $this['approval_date'],
          $this['financing_date'],
          $this['confirmation_date'],
          $this['approval_notes'], 
          $this['financing_notes'],
          $this['confirmation_date'],
          $this['reference_number']
          );
        break;
    }
  }

  
}
