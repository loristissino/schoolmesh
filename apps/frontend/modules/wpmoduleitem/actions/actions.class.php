<?php

/**
 * wpmoduleitem actions.
 *
 * @package    schoolmesh
 * @subpackage wpmoduleitem
 * @author     Loris Tissino
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class wpmoduleitemActions extends sfActions
{

  public function executeGetContent(sfWebRequest $request)
	{		
		$this->forward404Unless($moduleitem=WpmoduleItemPeer::retrieveByPk($request->getParameter('id')));
		$this->forward404Unless($this->isUpdateble($request, $moduleitem));
		return $this->renderText(str_replace('---', '', $moduleitem->getContent()));
	}


		public function executeEditInLine(sfWebRequest $request)
	{		
		$this->forward404Unless($request->getMethod()=="POST");
		$this->forward404Unless($moduleitem=WpmoduleItemPeer::retrieveByPk($request->getParameter('id')));

		$this->forward404Unless($this->isUpdateble($request, $moduleitem));

		$moduleitem->setContent($this->checkedValue($request->getParameter('value')));
		$moduleitem->save();

		return $this->renderText($moduleitem->getContent());
		}


  public function executeEvaluate(sfWebRequest $request)
  {

    $this->wpmoduleitem = WpmoduleItemPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->wpmoduleitem);
	
	// FIXME We should check the owner and the value here...
	
    $type=$this->wpmoduleitem->getWpitemGroup()->getWpitemType();

    $min=$type->getEvaluationMin();
    $max=$type->getEvaluationMax();
    
    $evaluation=$request->getParameter('evaluation');
    $dbvalue=$evaluation==''? NULL: $evaluation;
    $this->wpmoduleitem->setEvaluation($dbvalue);
    $this->wpmoduleitem->save();
    return $this->renderPartial('wpmodule/evaluation', array('id'=>$this->wpmoduleitem->getId(), 'dbvalue'=>$dbvalue, 'textvalue'=>$this->wpmoduleitem->getEvaluationText(), 'min'=>$min, 'max'=>$max));
	}


  public function executeNew(sfWebRequest $request)
  {

    $this->forward404Unless($request->isMethod('put')||$request->isMethod('post'));

	$group= WpitemGroupPeer::retrieveByPk($request->getParameter('id'));
	
    $this->forward404Unless($group);

	$newitem= new WpmoduleItem();
	$newitem->setWpitemGroupId($group->getId());
	$newitem->save();
	$this->getUser()->setFlash('notice'.$group->getId(), $this->getContext()->getI18N()->__('A new item was inserted'));
	$this->redirect('wpmodule/view?id='.$group->getWpmoduleId().'#'.$group->getId());

   }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($wpmodule_item = WpmoduleItemPeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpmodule_item does not exist (%s).', $request->getParameter('id')));
	$this->wpmodule_item=$wpmodule_item;
	$this->wpitemGroup=$this->wpmodule_item->getWpitemGroup();
	$this->wpitemType = $this->wpitemGroup->getWpitemType();
	$this->wpmodule=$this->wpitemGroup->getWpmodule();
	$this->wp=$this->wpmodule->getAppointment();
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($wpmodule_item = WpmoduleItemPeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpmodule_item does not exist (%s).', $request->getParameter('id')));
  //  $this->form = new WpmoduleItemForm($wpmodule_item);
    $this->forward404Unless($this->isUpdateble($request, $wpmodule_item));
	
	$wpmodule_item->setContent($this->checkedValue($request->getParameter('value')));

	$gr=$wpmodule_item->getWpitemGroupId();

	$this->getUser()->setFlash('notice'.$gr, $this->getContext()->getI18N()->__('The item was updated'));

	$wpmodule_item->save();
  
  if(strpos($wpmodule_item->getContent(), "\n")!==false and $wpmodule_item->getWpitemGroup()->getWpmodule()->getAppointment()->getState()==Workflow::WP_DRAFT)
  {
    $this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('You cannot have carriage returns in this text. Consider using the "Quick list edit" action instead.'));
    $this->getUser()->setFlash('quick', true);
    return $this->redirect('wpmoduleitem/edit?id='.$wpmodule_item->getId());
  }
  
//    $this->processForm($request, $this->form);
	//$this->wpmodule_item=$wpmodule_item;
		//return $this->renderText($wpmodule_item->getWpmoduleGroup());
    //$this->setTemplate('edit');
    
   return $this->redirect('wpmodule/view?id='.$wpmodule_item->getWpitemGroup()->getWpmoduleId().'#'.$wpmodule_item->getWpitemGroupId());
//	$this->redirect('wpmodule/view?id='.$item->getWpitemGroup()->getWpmoduleId().'#'.$item->getWpitemGroupId()); 	

}

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('delete'));

    $this->forward404Unless($wpmodule_item = WpmoduleItemPeer::retrieveByPk($request->getParameter('id')), sprintf('Object wpmodule_item does not exist (%s).', $request->getParameter('id')));

	$id=$wpmodule_item->getWpitemGroup()->getWpmoduleId();
	$gr=$wpmodule_item->getWpitemGroupId();
	
	$wpmodule_item->delete();

	$this->getUser()->setFlash('notice'.$gr, $this->getContext()->getI18N()->__('The item was deleted'));

	$this->redirect('wpmodule/view?id='.$id.'#'.$gr);

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
    if (substr($newvalue, 0, 3)=='---') $newvalue=substr($newvalue, 3);
		if ($newvalue=='') $newvalue='---';
		return $newvalue;
	}

	protected function isUpdateble(sfWebRequest $request, $item)
	{
		return true;  // FIXME Should be fixed somehow
	}


	public function executeUp(sfWebRequest $request)
	{
	  $this->forward404Unless($request->getMethod()=="PUT");
	  $item = WpmoduleItemPeer::retrieveByPk($this->getRequestParameter('id'));
	  $this->forward404Unless($item);
	  $previous_item = WpmoduleItemPeer::retrieveByRank($item->getRank() - 1, $item->getWpitemGroupId());
	  $this->forward404Unless($previous_item);
	  $item->swapWith($previous_item);
	  $this->getUser()->setFlash('notice'.$item->getWpitemGroupId(), $this->getContext()->getI18N()->__('The items were switched'));
	 
	  $this->redirect('wpmodule/view?id='.$item->getWpitemGroup()->getWpmoduleId().'#'.$item->getWpitemGroupId()); 	
	  }  

	public function executeDown(sfWebRequest $request)
	{
	  $this->forward404Unless($request->getMethod()=="PUT");
	  $item = WpmoduleItemPeer::retrieveByPk($this->getRequestParameter('id'));
	  $this->forward404Unless($item);
	  $next_item = WpmoduleItemPeer::retrieveByRank($item->getRank() + 1, $item->getWpitemGroupId());
	  $this->forward404Unless($next_item);
	  $item->swapWith($next_item);
	  $this->getUser()->setFlash('notice'.$item->getWpitemGroupId(), $this->getContext()->getI18N()->__('The items were switched'));
	 
	  $this->redirect('wpmodule/view?id='.$item->getWpitemGroup()->getWpmoduleId().'#'.$item->getWpitemGroupId()); 
	}  


}
