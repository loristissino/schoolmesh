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
		
		$module=WpmoduleItemPeer::retrieveByPk($request->getParameter('id'));

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

	$wpmodule_item->setContent($request->getParameter('itemcontent'));
	$wpmodule_item->save();
//    $this->processForm($request, $this->form);
	$this->wpmodule_item=$wpmodule_item;
		//return $this->renderText($wpmodule_item->getWpmoduleGroup());

    //$this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($wpmodule_item = WpmoduleItemPeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpmodule_item does not exist (%s).', $request->getParameter('id')));
    $wpmodule_item->delete();

    $this->redirect('wpmoduleitem/index');
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
}
