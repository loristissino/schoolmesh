<?php

/**
 * wpmodule actions.
 *
 * @package    schoolmesh
 * @subpackage wpmodule
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class wpmoduleActions extends sfActions
{


	public function executeEditInLine(sfWebRequest $request)
	{

		$this->forward404Unless($request->getMethod()=="POST");
		
		$module=WpmodulePeer::retrieveByPk($request->getParameter('id'));

// qui va aggiunto il controllo sulla fattibilità o meno della richiesta...

		$property=$request->getParameter('property');
		$set_func= 'set'.$property;
		$get_func= 'get'.$property;

		$newvalue=$request->getParameter('value');
		if ($newvalue=='') $newvalue='---';
		$module->$set_func($newvalue);
		$module->save();
		return $this->renderText($module->$get_func());
		
	}

	public function executeUp(sfWebRequest $request)
	{
	  $this->forward404Unless($request->getMethod()=="PUT");
	  $item = WpmodulePeer::retrieveByPk($this->getRequestParameter('id'));
	  $this->forward404Unless($item);
	  $previous_item = WpmodulePeer::retrieveByRank($item->getRank() - 1, $item->getAppointmentId());
	  $this->forward404Unless($previous_item);
	  $item->swapWith($previous_item);
	  $this->getUser()->setFlash('notice', sprintf('The items were switched'));
	 
	  $this->redirect('plansandreports/fill?id='.$item->getAppointmentId()); 	}  

	public function executeDown(sfWebRequest $request)
	{
	  $this->forward404Unless($request->getMethod()=="PUT");
	  $item = WpmodulePeer::retrieveByPk($this->getRequestParameter('id'));
	  $this->forward404Unless($item);
	  $next_item = WpmodulePeer::retrieveByRank($item->getRank() + 1, $item->getAppointmentId());
	  $this->forward404Unless($next_item);
	  $item->swapWith($next_item);
	  $this->getUser()->setFlash('notice', sprintf('The items were switched'));
	 
	  $this->redirect('plansandreports/fill?id='.$item->getAppointmentId()); 
	}  
/*
  public function executeIndex(sfWebRequest $request)
  {
    $this->wpmodule_list = WpmodulePeer::doSelect(new Criteria());
  }
*/

  public function executeShow(sfWebRequest $request)
  {
	$this->redirect('wpmodule/view?id='.$request->getParameter('id'));
	}

  public function executeView(sfWebRequest $request)
  {
    $this->wpmodule = WpmodulePeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->wpmodule);
	
	$this->workplan = $this->wpmodule->getAppointment();
	$this->wpstate = $this->workplan->getState();
	$this->ownerId=$this->wpmodule->getUserId();
	$this->owner=$this->wpmodule->getOwner();
	$this->item_groups=$this->wpmodule->getWpitemGroups();
		
	}



  public function executeNew(sfWebRequest $request)
  {

	$workplan= AppointmentPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($workplan);

	$newwpmodule= new Wpmodule();
	$newwpmodule->setAppointmentId($workplan->getId());
	$newwpmodule->setUserId($workplan->getSfGuardUser()->getId());
	
	$newwpmodule->save();
	$newwpmodule->createWpitemGroups();
	
	$this->getUser()->setFlash('notice', sprintf('A new item was inserted'));
	return $this->redirect('plansandreports/fill?id='.$workplan->getId());

  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new WpmoduleForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

/*
  public function executeEdit(sfWebRequest $request)
  {
//    $this->forward404Unless($wpmodule = WpmodulePeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpmodule does not exist (%s).', $request->getParameter('id')));
//    $this->form = new WpmoduleForm($wpmodule);

//	return $this->executeShow($request);

    $this->wpmodule = WpmodulePeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->wpmodule);
	$this->workplan = $this->wpmodule->getAppointmentId();
/*	if($this->workplan->getSfGuardUser()!=12)
		{
		$response->setStatusCode(403);
		return $this->renderText('Non abilitato');
		}

  }
*/


  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($wpmodule = WpmodulePeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpmodule does not exist (%s).', $request->getParameter('id')));
    $this->form = new WpmoduleForm($wpmodule);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($wpmodule = WpmodulePeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpmodule does not exist (%s).', $request->getParameter('id')));
    
	$appointmentId=$wpmodule->getAppointmentId();
	if ($wpmodule->delete())
		{
		$this->getUser()->setFlash('notice', sprintf('The item was deleted'));
		}
	else
		{
		$this->getUser()->setFlash('error', sprintf('The item could not be deleted'));
		}
		

    $this->redirect('plansandreports/fill?id='. $appointmentId);
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $wpmodule = $form->save();

      $this->redirect('wpmodule/edit?id='.$wpmodule->getId());
    }
  }
}
