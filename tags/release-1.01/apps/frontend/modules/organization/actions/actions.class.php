<?php

/**
 * organization actions.
 *
 * @package    schoolmesh
 * @subpackage organization
 * @author     Loris Tissino <loris.tissino@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class organizationActions extends sfActions     // $userteam=RolePeer::retrieveUsersPlayingRole($keyrole);

{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->list=array();
    $this->keyroles=RolePeer::retrieveKeyRoles();
    
    foreach($this->keyroles as $keyrole)
    {
      $this->list[$keyrole->getId()]=array('keyrole'=>$keyrole, 'userteam'=>$keyrole->getUsersPlayingRole());
    }
    
    $this->functionalroles=RolePeer::retrieveFunctionalRoles();
    
  }

  public function executeRole(sfWebRequest $request)
  {
    $this->forward404Unless($this->role=RolePeer::retrieveByPK($request->getParameter('id')));
    $this->userteam=$this->role->getUsersPlayingRole();
  }

  public function executeChart(sfWebRequest $request)
  {
    try 
    {
      $odfdoc=RolePeer::getOrganizationalChartOdf($this->getUser()->getProfile()->getPreferredFormat(), $this->getContext(), $request->getParameter('template', ''));
    }
    catch (Exception $e)
    {
      $this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('Operation failed.'). ' ' . $this->getContext()->getI18N()->__('Please ask the administrator to check the template.') . ' '. $e->getMessage());
      $this->forward('organization', 'index');
    }
    
    try
    {
      $odfdoc
      ->saveFile()
      ->setResponse($this->getContext()->getResponse());
      return sfView::NONE;
    }
    catch (Exception $e)
    {
      $this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('Conversion failed.'). ' ' . $this->getContext()->getI18N()->__('Please ask the administrator to check the contents.'));
      $this->forward('organization', 'index');
    }

  }
  
  
}
