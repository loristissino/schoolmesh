<?php

/**
 * projects actions.
 *
 * @package    schoolmesh
 * @subpackage projects
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class projectsActions extends sfActions
{
  
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

//   $this->projects=SchoolprojectPeer::retrieveAllForYearAndUser(sfConfig::get('app_config_current_year'), $this->getUser()->getProfile()->getSfGuardUser()->getId());
   $this->projects=SchoolprojectPeer::retrieveAllForUser($this->getUser()->getProfile()->getSfGuardUser()->getId());
   $this->steps=Array();

   $this->setTemplate('index');   

	}
  
  public function executeView(sfWebRequest $request)
  {
    
   $this->year=$this->getUser()->getAttribute('year', sfConfig::get('app_config_current_year'));
   $this->years = YearPeer::retrieveAll();
    $this->forward404Unless($this->project=SchoolprojectPeer::retrieveByPK($request->getParameter('id')));
    
    $this->projects=Array($this->project);
    
   $this->setTemplate('report');   
    
    
  }
  
  
  public function executeEmail(sfWebRequest $request)
  {
    $this->forward404Unless($this->project=SchoolprojectPeer::retrieveByPK($request->getParameter('id')));
    
    $this->message=$this->project->getProjectAlertMessage($this->getUser()->getProfile(), $this->getContext());
    
    $this->form = new EmailForm();

	if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('email'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				
				$this->project = SchoolprojectPeer::retrieveByPK($request->getParameter('id'));
				
				$result=$this->project->sendEmail($params, $this->getUser()->getProfile(), $this->getContext());
				
				$this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
        return $this->redirect('projects/index');
      }
			
			
		}

    $this->form
    ->setDefault('email_subject', $this->message->getSubject())
    ->setDefault('body', $this->message->getBody())
    ;



  }
  
  
  public function executeMonitor(sfWebRequest $request)
  {
   $this->year=$this->getUser()->getAttribute('year', sfConfig::get('app_config_current_year'));
   $this->years = YearPeer::retrieveAll();

   $this->projects=SchoolprojectPeer::retrieveAllForYear($this->year);
   $this->steps=Array();

   $template=$request->getParameter('template', 'index');
   $this->setTemplate($template);
   $this->action='monitor';

	}
	
  public function executeLetters(sfWebRequest $request)
	{
		$this->text='';
		$this->projects=SchoolprojectPeer::retrieveAllForYear(sfConfig::get('app_config_current_year'));
		
		$number=0;
		foreach($this->projects as $project)
		{
			$filename = sprintf('/tmp/projects/%s_%d.odt',
				$project->getsfGuardUser()->getUsername(),
				$project->getId()
				);
			$odf=$project->getOdf('odt', $this->getContext(), 'project_resume.odt', false);
			$odf->saveFile();
			@copy($odf->getFileName(), $filename);
			$number++;
			$this->text.=$odf->getFileName() . ' >> ' . $filename . "\n";
			unset($odf);
			
			
		}
		$this->number=$number;
		
	}
  
  
  public function executeAdddeadline(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));
    $this->forward404Unless($this->project=SchoolprojectPeer::retrieveByPk($request->getParameter('id')));
    
    $result=$this->project->addDeadline($this->getUser()->getProfile());
    
    $this->getUser()->setFlash($result['result'],
					$this->getContext()->getI18N()->__($result['message'])
					);
					
    return $this->redirect('projects/edit?id='. $this->project->getId());
   } 
   
  public function executeAddresource(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));
    $this->forward404Unless($this->project=SchoolprojectPeer::retrieveByPk($request->getParameter('id')));
    
    $result=$this->project->addresource($this->getUser()->getProfile());
    
    $this->getUser()->setFlash($result['result'],
					$this->getContext()->getI18N()->__($result['message'])
					);
					
    return $this->redirect('projects/edit?id='. $this->project->getId());
   } 



  public function executeDeletedeadline(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));
    $this->forward404Unless($this->deadline=ProjDeadlinePeer::retrieveByPk($request->getParameter('id')));
    
    $result=$this->deadline->getSchoolproject()->deleteDeadline($this->getUser()->getProfile(), $this->deadline);
    
    $this->getUser()->setFlash($result['result'],
					$this->getContext()->getI18N()->__($result['message'])
					);
					
    return $this->redirect('projects/edit?id='. $this->deadline->getSchoolproject()->getId());

    
  }

  public function executeDeleteresource(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));
    $this->forward404Unless($this->resource=ProjResourcePeer::retrieveByPk($request->getParameter('id')));
    
    $result=$this->resource->getSchoolproject()->deleteResource($this->getUser()->getProfile(), $this->resource);
    
    $this->getUser()->setFlash($result['result'],
					$this->getContext()->getI18N()->__($result['message'])
					);
					
    return $this->redirect('projects/edit?id='. $this->resource->getSchoolproject()->getId());

    
  }



  public function executeEditdeadline(sfWebRequest $request)
  {
    $this->forward404Unless($this->deadline=ProjDeadlinePeer::retrieveByPk($request->getParameter('id')));
    $this->forward404Unless($this->deadline->isEditableBy($this->getUser())); // the deadline can be edited only by the owner or admins...
    
    $this->attachments=$this->deadline->getAttachmentFiles();
    
    $this->form = new ProjDeadlineForm($this->deadline);
    $this->form->addStateDependentConfiguration(
      $this->deadline->getSchoolProject()->getState(),
      array(
        'needs_attachment'=>$this->deadline->getNeedsAttachment()===true
        )
      );

	if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('proj_deadline'), $request->getFiles('proj_deadline'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				
				$this->deadline = ProjDeadlinePeer::retrieveByPK($params['id']);
				
				$result=$this->deadline->updateFromForm($params, $this->form->getValue('attachment'));
				
				$this->getUser()->setFlash($result['result'],
					$this->getContext()->getI18N()->__($result['message'])
					);
				
        if($result['result']=='notice')
        {
          return $this->redirect('projects/edit?id='. $this->deadline->getSchoolproject()->getId());
        }
        else
        {
          return $this->redirect('projects/editdeadline?id='. $this->deadline->getId());
        }
			}
			
		}




  }
 

  public function executeEditresource(sfWebRequest $request)
  {
    $this->forward404Unless($this->resource=ProjResourcePeer::retrieveByPk($request->getParameter('id')));
    $this->forward404Unless($this->resource->isEditableBy($this->getUser())); // the resource can be edited only by the owner or admins...
    
    $this->form = new ProjResourceForm($this->resource);
/*    $this->form->addStateDependentConfiguration(
      $this->deadline->getSchoolProject()->getState(),
      array(
        'needs_attachment'=>$this->deadline->getNeedsAttachment()===true
        )
      );
*/
	if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('proj_resource'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				
				$this->resource = ProjResourcePeer::retrieveByPK($params['id']);
				
				$result=$this->resource->updateFromForm($params);
				
				$this->getUser()->setFlash($result['result'],
					$this->getContext()->getI18N()->__($result['message'])
					);
				
        return $this->redirect('projects/editresource?id='. $this->resource->getId());
			}
			
		}




  }


  public function executeEdit(sfWebRequest $request)
  {
    
	$this->forward404Unless($this->project=SchoolprojectPeer::retrieveByPk($request->getParameter('id')));
  
  $this->forward404Unless($this->project->isEditableBy($this->getUser())); // the project can be edited only by the owner  or by admins...
	
	$this->form = new SchoolprojectForm($this->project);
  $this->form->addStateDependentConfiguration($this->project->getState());

	if ($request->isMethod('post'))
		{
//			$this->form->getValidatorSchema()->setOption('allow_extra_fields', true);
//			$this->form->getValidatorSchema()->setOption('filter_extra_fields', false);
			
			
			$this->form->bind($request->getParameter('schoolproject'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				
				$this->project = SchoolprojectPeer::retrieveByPK($params['id']);
				
				$this->project
        ->updateFromForm($params)
        ->save();
				
				$this->getUser()->setFlash('notice',
					$this->getContext()->getI18N()->__('Project information updated.')
					);
					
			return $this->redirect('projects/edit?id='. $this->project->getId());
			}
			
		}
	/* this would be useful if we wanted to embed deadline forms,
  but there are some problems with validation, so we don't use it 	
	if($this->project)
	{
		foreach($this->project->getProjDeadlines() as $index=>$deadline)
		{
			$deadlineForm=new ProjDeadlineForm($deadline);
			$fieldname='deadline[' . $index . ']';
			$this->form->embedForm($fieldname, $deadlineForm);
			$this->form->getWidgetSchema()->setLabel($fieldname, 
				$this->getContext()->getI18N()->__('Deadline #%number%', array('%number%'=>$index+1))
				);

		}

	}
  */
  
  if ($this->project)
  {
    $this->deadlines=$this->project->getProjDeadlines();
    $this->resources=$this->project->getProjResources();
  }
  
  
   }  
	

  public function executeSubmit(sfWebRequest $request)
  {
    
    $this->forward404Unless($this->project=SchoolprojectPeer::retrieveByPk($request->getParameter('id')));
  
    $this->forward404Unless($this->project->isEditableBy($this->getUser())); // the project can be edited only by the owner  or by admins...

    $this->forward404Unless($request->isMethod('post'));

    $result=$this->project->submit();
    
    $this->getUser()->setFlash($result['result'],
      $this->getContext()->getI18N()->__($result['message'])
      );

    return $this->redirect('projects/index');

   }  


  public function executeNew(sfWebRequest $request)
  {
    
	$this->form = new SchoolprojectForm(new Schoolproject());
  $this->form->addStateDependentConfiguration(Workflow::PROJ_DRAFT);

  $this->deadlines=array();

	if ($request->isMethod('post'))
		{
			
			$this->form->bind($request->getParameter('schoolproject'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				
				$this->project = new Schoolproject();
				
				$this->project
        ->updateFromForm($params)
        ->setYearId(sfConfig::get('app_config_current_year'))
        ->setUserId($this->getUser()->getProfile()->getUserId())
        ->setState(Workflow::PROJ_DRAFT)
        ->save();
				
        
				$this->getUser()->setFlash('notice',
					$this->getContext()->getI18N()->__('Project information saved.')
					);
					
			return $this->redirect('projects/edit?id='. $this->project->getId());
			}
			
		}
  
  
   }  
	
  

}