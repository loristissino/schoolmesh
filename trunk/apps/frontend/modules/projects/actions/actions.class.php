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

   $this->projects=SchoolprojectPeer::retrieveAllForYearAndUser(sfConfig::get('app_config_current_year'), $this->getUser()->getProfile()->getSfGuardUser()->getId());
   $this->steps=Array();

   $this->setTemplate('index');   

	}
  
  public function executeView(sfWebRequest $request)
  {
    $this->forward404Unless($this->project=SchoolprojectPeer::retrieveByPK($request->getParameter('id')));
    
    $this->projects=Array($this->project);
    
   $this->setTemplate('report');   
    
    
  }
  
  
  
  public function executeMonitor(sfWebRequest $request)
  {

   $this->projects=SchoolprojectPeer::retrieveAllForYear(sfConfig::get('app_config_current_year'));
   $this->steps=Array();

   $template=$request->getParameter('template', 'index');
   $this->setTemplate($template);   

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
 
  public function executeEditdeadline(sfWebRequest $request)
  {
    $this->forward404Unless($this->deadline=ProjDeadlinePeer::retrieveByPk($request->getParameter('id')));
    $this->forward404Unless($this->getUser()->getProfile()->getUserId()==$this->deadline->getUserId()); // the deadline can be edited only by the owner
    
    $this->form = new ProjDeadlineForm($this->deadline);
    $this->form->addStateDependentConfiguration($this->deadline->getSchoolProject()->getState());

	if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('proj_deadline'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				
				$this->deadline = ProjDeadlinePeer::retrieveByPK($params['id']);
				
				$this->deadline->updateFromForm($params);
				
				$this->getUser()->setFlash('notice',
					$this->getContext()->getI18N()->__('Deadline updated.')
					);
					
			return $this->redirect('projects/edit?id='. $this->deadline->getSchoolproject()->getId());
			}
			
		}




  }
 
	
  public function executeEdit(sfWebRequest $request)
  {
    
	$this->forward404Unless($this->project=SchoolprojectPeer::retrieveByPk($request->getParameter('id')));
  
  $this->forward404Unless($this->getUser()->getProfile()->getUserId()==$this->project->getUserId()); // the project can be edited only by the owner
	
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
				
				$this->project->updateFromForm($params);
				
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
  }
  
  
   }  
	

}
