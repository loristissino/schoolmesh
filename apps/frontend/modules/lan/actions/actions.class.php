<?php

/**
 * workstations actions.
 *
 * @package    schoolmesh
 * @subpackage workstations
 * @author     Your name here
 */
class lanActions extends sfActions
{
  
  public function preExecute()
  {
    $this->timeslotsContainer=new TimeslotsContainer(sfConfig::get('app_config_timeslotsfile'));
    if(!$this->timeslotsContainer)
    {
      throw new Exception('Could not read initialize timeslots manager');
    }
  }
  public function executeIndex(sfWebRequest $request)
  {
    $this->Subnets = SubnetPeer::doSelect(new Criteria());
    $this->mysubnet=SubnetPeer::findSubnetFromIP($this->Subnets, $_SERVER['REMOTE_ADDR']);

    if($this->getUser()->hasAttribute('subnet'))
    {
      $this->currentsubnet=SubnetPeer::retrieveByPK($this->getUser()->getAttribute('subnet'));
    }
    else
    {
      $this->currentsubnet=$this->mysubnet;
    }
    
    $this->Workstations = WorkstationPeer::retrieveAllWorkstations($this->currentsubnet);
    
  }
  
  public function executeSelectsubnet(sfWebRequest $request)
  {
    $this->getUser()->setAttribute('subnet', $request->getParameter('id'));
    $this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('Switched subnet.'));
    return $this->redirect('lan/index');
  }

  public function executeAdminenableinternetaccess(sfWebRequest $request)
  {
    /*
    $this->forward404Unless($this->Workstation=WorkstationPeer::retrieveByPk($request->getParameter('id')));
    $this->form= new ToggleInternetAccessForm(null, array('timetable'=>sfConfig::get('app_config_timetablefile', '')));
    $this->form->setDefault('when', array('1', '2', '4', 'p'));
    */
    $this->endtime=$this->timeslotsContainer->getEleventhHour();
    $this->_doEnableinternetaccess($request);
  }

  public function executeUserenableinternetaccess(sfWebRequest $request)
  {
    /*
    $this->forward404Unless($this->Workstation=WorkstationPeer::retrieveByPk($request->getParameter('id')));
    $this->form= new ToggleInternetAccessForm(null, array('timetable'=>sfConfig::get('app_config_timetablefile', '')));
    $this->form->setDefault('when', array('1', '2', '4', 'p'));
    */
    $this->endtime=$this->timeslotsContainer->getCurrentSlotEnd();
    $this->_doEnableinternetaccess($request);
  }

  private function _doEnableinternetaccess(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('POST'));
    $this->forward404Unless($this->Workstation=WorkstationPeer::retrieveByPk($request->getParameter('id')));
    $result=$this->Workstation->enableInternetAccess(
      $this->getUser()->getProfile()->getUserId(), 
      $this->timeslotsContainer->getCurrentSlotBegin(), 
      $this->endtime, 
      $this->getUser()->getProfile()->getUsername(),
      $this->getContext()
    );
    $this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
    return $this->redirect('lan/index');
  }
  

  public function executeDisableinternetaccess(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('POST'));
    $this->forward404Unless($this->Workstation=WorkstationPeer::retrieveByPk($request->getParameter('id')));
    $result=$this->Workstation->disableInternetAccess($this->getUser()->getProfile()->getUserId(), $request->getParameter('code'), $this->getContext());
    $this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
    return $this->redirect('lan/index');
  }

}
