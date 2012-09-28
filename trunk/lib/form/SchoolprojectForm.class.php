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
    
    unset(
      $this['user_id'],
      $this['year_id'],
      $this['state']
      );
    
    if($this->schoolproject->getId())
    {
      $this->projDetailTypes = $this->schoolproject->getProjDetailTypes();
      
      foreach($this->projDetailTypes as $projDetailType)
      {
        $fieldname=$projDetailType->getFieldName();
        $this->widgetSchema[$fieldname] = new sfWidgetFormTextarea();
        $this[$fieldname]->getWidget()->setAttributes(array('cols'=>$projDetailType->getCols(), 'rows'=>$projDetailType->getRows()));
        $this[$fieldname]->getWidget()->setLabel($projDetailType->getLabel());
        
        $required = sfConfig::get('app_config_projects_relaxed_filling', false) ? false: $projDetailType->getIsRequired();
        
        $this->validatorSchema[$fieldname] = new sfValidatorString(array('required' => $required));
        
        $projDetail=$this->schoolproject->getDetail($projDetailType->getId());
        if($projDetail)
        {
          $this[$fieldname]->getWidget()->setDefault($projDetail->getContent());
        }
        
      }
    }
      
    $this['title']->getWidget()->setAttribute('size', '80');

    /*	$this['user_id']->getWidget()->setOption('model', 'sfGuardUserProfile');
      $this['user_id']->getWidget()->setOption('peer_method', 'retrieveAllButStudents');
      $this['user_id']->getWidget()->setOption('add_empty', 'Choose a user');
    */	
    $this->widgetSchema->setLabel('proj_category_id', 'Category');
    $this['team_id']->getWidget()
      ->addOption('add_empty', 'Choose a team of co-coordinators')
      ->addOption('peer_method', 'retrieveAll')
      ->addOption('criteria', $this->schoolproject->getCriteriaForTeamSelection());
    
    /*
      $this->widgetSchema->setLabel('user_id', 'Coordinator');
    */	
    
      
    $this['no_activity_confirm']->getWidget()->setLabel('No activity<br />confirmation');

    if($this->schoolproject->getState()==Workflow::PROJ_CONFIRMED)
    {
      $be=$this->schoolproject->getBudgetAndExpensesForDeclarableActivities();
      $this->budget=$be['budget'];
      $this->expenses=$be['expenses'];
    }
    
  }
  
  public function addUserDependentConfiguration($user)
  {
    unset(
      $this['evaluation_min'],
      $this['evaluation_max'],
      $this['created_at']
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
          $this['reference_number'],
          $this['no_activity_confirm'],
          $this['team_id']
          );
        break;
      case Workflow::PROJ_SUBMITTED:
        unset(
          $this['hours_approved'],
          $this['title'],
          $this['proj_category_id'],
          $this['submission_date'],
          $this['approval_date'],
          $this['financing_date'],
          $this['confirmation_date'],
          $this['approval_notes'], 
          $this['financing_notes'],
          $this['confirmation_notes'],
          $this['no_activity_confirm']
          );
          if(!$user->hasCredential('proj_adm_ok'))
          {
            // users that do not have the credential proj_adm_ok cannot change reference number and code
            unset(
              $this['reference_number'],
              $this['code']
            );
          }
          if($user->getProfile()->getUserId()!=$this->schoolproject->getsfGuardUser()->getId())
          {
            // users other than the project coordinator cannot write details and cannot change the team
            unset(
              $this['team_id']
            );
            $this->_removeDetailFields();
          }
          
          
        break;
      case Workflow::PROJ_APPROVED:
        unset(
          $this['hours_approved'],
          $this['title'],
          $this['proj_category_id'],
          $this['submission_date'],
          $this['approval_date'],
          $this['confirmation_date'],
          $this['financing_date'],
          $this['approval_notes'], 
          $this['financing_notes'],
          $this['confirmation_notes'],
          $this['reference_number'],
          $this['no_activity_confirm'],
          $this['code']
          );
          if($user->getProfile()->getUserId()!=$this->schoolproject->getsfGuardUser()->getId())
          {
            // users other than the project coordinator cannot write details and cannot change the team
            unset(
              $this['team_id']
            );
            $this->_removeDetailFields();
          }
        break;
      case Workflow::PROJ_FINANCED:
        unset(
          $this['hours_approved'],
          $this['title'],
          $this['proj_category_id'],
          $this['submission_date'],
          $this['approval_date'],
          $this['financing_date'],
          $this['confirmation_date'],
          $this['approval_notes'], 
          $this['financing_notes'],
          $this['confirmation_notes'],
          $this['reference_number'],
          $this['no_activity_confirm'],
          $this['code']
          );
          if($user->getProfile()->getUserId()!=$this->schoolproject->getsfGuardUser()->getId())
          {
            // users other than the project coordinator cannot write details and cannot change the team
            unset(
              $this['team_id']
            );
            $this->_removeDetailFields();
          }
        break;
      case Workflow::PROJ_CONFIRMED:
        unset(
          $this['hours_approved'],
          $this['title'],
          $this['proj_category_id'],
          $this['submission_date'],
          $this['approval_date'],
          $this['financing_date'],
          $this['confirmation_date'],
          $this['approval_notes'], 
          $this['financing_notes'],
          $this['confirmation_notes'],
          $this['reference_number'],
          $this['code']
          );
          if($user->getProfile()->getUserId()!=$this->schoolproject->getsfGuardUser()->getId())
          {
            // users other than the project coordinator cannot write details and cannot change the team
            unset(
              $this['team_id']
            );
            $this->_removeDetailFields();
          }
          
          if(
            $this->schoolproject->getProjCategory()->getResources()!=0
            // this kind of project may or must have resources
              and
            $this->budget > 0
            // there are some resources required
              and
            $this->expenses > 0
            // some activity has been declared and confirmed
            )
          {
            unset($this['no_activity_confirm']);
          }
          
          if($this->schoolproject->getProjCategory()->getResources()==0)
          {
            unset($this['no_activity_confirm']);
          }
          
        break;
      case Workflow::PROJ_FINISHED:
        unset(
          $this['hours_approved'],
          $this['title'],
          $this['proj_category_id'],
          $this['submission_date'],
          $this['approval_date'],
          $this['financing_date'],
          $this['confirmation_date'],
          $this['approval_notes'], 
          $this['financing_notes'],
          $this['confirmation_date'],
          $this['confirmation_notes'],
          $this['reference_number'],
          $this['team_id'],
          $this['code'],
          $this['no_activity_confirm']
          );
        break;
    }
  }

  private function _removeDetailFields()
  {
    foreach($this->projDetailTypes as $projDetailType)
    {
      unset($this[$projDetailType->getFieldName()]);
    }
  }

}
