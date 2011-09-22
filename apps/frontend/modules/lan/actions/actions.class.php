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
    $this->timeslots=sfYaml::load(sfConfig::get('app_config_timeslotsfile'));
    if(!is_array($this->timeslots))
    {
      throw new Exception('Could not read timeslots configuration file');
    }
  }
  public function executeIndex(sfWebRequest $request)
  {
    $this->Subnets = SubnetPeer::doSelect(new Criteria());
    $this->mysubnet=SubnetPeer::findSubnetFromIP($this->Subnets, '192.168.1.3');//$_SERVER['REMOTE_ADDR']);

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

  public function executeEnableinternetaccess(sfWebRequest $request)
  {
    $this->forward404Unless($this->Workstation=WorkstationPeer::retrieveByPk($request->getParameter('id')));
    $this->form= new ToggleInternetAccessForm(null, array('timetable'=>sfConfig::get('app_config_timetablefile', '')));
    $this->form->setDefault('when', array('1', '2', '4', 'p'));
  }

  public function executeDisableinternetaccess(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('POST'));
    $this->forward404Unless($this->Workstation=WorkstationPeer::retrieveByPk($request->getParameter('id')));
    $result=$this->Workstation->disableInternetAccess();
    $this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
    return $this->redirect('lan/index');
  }

}
