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

   $this->projects=SchoolprojectPeer::retrieveAllForYear(sfConfig::get('app_config_current_year'));
   $this->steps=Array();
	}
	
	
	
  public function executeEdit(sfWebRequest $request)
  {
	$this->forward404Unless($this->project=SchoolprojectPeer::retrieveByPk($request->getParameter('id')));
	
//	$deadlinesNumber=$this->project->countProjDeadlines();
//	$this->form = new ProjectForm(array('deadlines_count'=>$deadlinesNumber));

	$this->form = new ProjectForm(); 



	
	if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('info'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				
				$this->project
				->setTitle($params['title'])
				->save();

				$this->getUser()->setFlash('notice',
					$this->getContext()->getI18N()->__('Project information updated.')
					);
					
				$this->redirect('projects/edit?id='. $this->project->getId());

			}
			
		}

	$this->form->setDefaults(
		array(
			'id' => $this->project->getId(),
			'title' => $this->project->getTitle(),
			'coordinator'=> $this->project->getsfGuardUser()->getId(),
		)
	);
	$deadlines=$this->project->getProjDeadlines();
	foreach($deadlines as $deadline)
	{
		$this->form->embedForm('deadline' . $deadline->getId(), new DeadlineForm());
		
		$this->form->getEmbeddedForm('deadline'. $deadline->getId())->setDefaults(
			array(
			'id'=>$deadline->getId(),
			'project_id'=>$this->project->getId(),
			'description'=> 'ciao'
			)
			
			);
		
	}

	
   }  
	
}
