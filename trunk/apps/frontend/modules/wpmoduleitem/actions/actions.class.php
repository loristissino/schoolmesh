<?php

/**
 * wpmoduleitem actions.
 *
 * @package    schoolmesh
 * @subpackage wpmoduleitem
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class wpmoduleitemActions extends sfActions
{
	
		public function executeEditInLine(sfWebRequest $request)
	{		
		$this->forward404Unless($request->getMethod()=="POST");
		$this->forward404Unless($moduleitem=WpmoduleItemPeer::retrieveByPk($request->getParameter('id')));

		$this->forward404Unless($this->isUpdateble($request, $moduleitem));

		$moduleitem->setContent($this->checkedValue($request->getParameter('value')));
		$moduleitem->save();

		return $this->renderText($moduleitem->getContent());
		}

/*  public function executeIndex(sfWebRequest $request)
  {
    $this->wpmodule_item_list = WpmoduleItemPeer::doSelect(new Criteria());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->wpmodule_item = WpmoduleItemPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->wpmodule_item);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new WpmoduleItemForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new WpmoduleItemForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }
*/
  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($wpmodule_item = WpmoduleItemPeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpmodule_item does not exist (%s).', $request->getParameter('id')));
    //$this->form = new WpmoduleItemForm($wpmodule_item);
	$this->wpmodule_item=$wpmodule_item;
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($wpmodule_item = WpmoduleItemPeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpmodule_item does not exist (%s).', $request->getParameter('id')));
  //  $this->form = new WpmoduleItemForm($wpmodule_item);
    $this->forward404Unless($this->isUpdateble($request, $wpmodule_item));
	
	$wpmodule_item->setContent($this->checkedValue($request->getParameter('value')));
	$wpmodule_item->save();
//    $this->processForm($request, $this->form);
	//$this->wpmodule_item=$wpmodule_item;
		//return $this->renderText($wpmodule_item->getWpmoduleGroup());
    //$this->setTemplate('edit');
    
	
   $this->redirect('wpmodule/view?id='.$wpmodule_item->getWpitemGroup()->getWpmoduleId());

}

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('delete'));

    $this->forward404Unless($wpmodule_item = WpmoduleItemPeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpmodule_item does not exist (%s).', $request->getParameter('id')));

	$id=$wpmodule_item->getWpitemGroup()->getWpmoduleId();
	
	$wpmodule_item->delete();

	$this->redirect('wpmodule/view?id='.$id);

  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $wpmodule_item = $form->save();
//      $this->redirect('wpmodule/view?id='.$wpmodule_item->getWpitemGroup()->getWpmoduleId());
    }
  }

  protected function checkedValue($givenValue='')
	{
		$newvalue=chop(html_entity_decode(strip_tags($givenValue, '<br><em><sup><sub>')));
		if ($newvalue=='') $newvalue='---';
		return $newvalue;
	}

	protected function isUpdateble(sfWebRequest $request, $item)
	{
		return true;  // va sistemato
	}


	public function executeUp(sfWebRequest $request)
	{
	  $this->forward404Unless($request->getMethod()=="PUT");
	  $item = WpmoduleItemPeer::retrieveByPk($this->getRequestParameter('id'));
	  $this->forward404Unless($item);
	  $previous_item = WpmoduleItemPeer::retrieveByRank($item->getRank() - 1, $item->getWpitemGroupId());
	  $this->forward404Unless($previous_item);
	  $item->swapWith($previous_item);
	 
	  $this->redirect('wpmodule/view?id='.$item->getWpitemGroup()->getWpmoduleId()); 	
	  }  

	public function executeDown(sfWebRequest $request)
	{
	  $this->forward404Unless($request->getMethod()=="PUT");
	  $item = WpmoduleItemPeer::retrieveByPk($this->getRequestParameter('id'));
	  $this->forward404Unless($item);
	  $next_item = WpmoduleItemPeer::retrieveByRank($item->getRank() + 1, $item->getWpitemGroupId());
	  $this->forward404Unless($next_item);
	  $item->swapWith($next_item);
	 
	  $this->redirect('wpmodule/view?id='.$item->getWpitemGroup()->getWpmoduleId()); 
	}  


}
