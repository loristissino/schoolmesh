<?php

/**
 * workstations actions.
 *
 * @package    schoolmesh
 * @subpackage workstations
 * @author     Your name here
 */
class workstationsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->Workstations = WorkstationPeer::retrieveAllWorkstations();
  }

  public function executeToggleinternetaccess(sfWebRequest $request)
  {
    $this->forward404Unless($this->Workstation=WorkstationPeer::retrieveByPk($request->getParameter('id')));
    
    $this->form= new ToggleInternetAccessForm(null, array('timetable'=>sfConfig::get('app_config_timetablefile', '')));
    
    $this->form->setDefault('when', array('1', '2', '4', 'p'));
    
    
  }


}
