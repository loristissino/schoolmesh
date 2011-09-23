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

  }
  public function executeIndex(sfWebRequest $request)
  {
    $this->Workstations = WorkstationPeer::retrieveAllWorkstations($this->currentsubnet);
  }



  public function executeSelectsubnet(sfWebRequest $request)
  {
    $this->getUser()->setAttribute('subnet', $request->getParameter('id'));
    $this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('Switched subnet.'));
    return $this->redirect('lan/index');
  }

  public function executeBatch(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');
    $this->getUser()->setAttribute('ids', $ids);
    
    $action=$request->getParameter('batch_action');

    if ($action==='0')
      {
        $this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must specify an action.'));
        $this->redirect('lan/index');
      }
    $this->forward('lan', $action);
    // if an action is not valid, we get an error anyway, because there is no
    // template BatchSuccess.php
  }  

  protected function _getIds(sfWebRequest $request)
  {
    $this->ids=null;
    if($request->hasParameter('id'))
    {
      $this->ids=array($request->getParameter('id'));
    }
    elseif ($request->hasParameter('ids'))
    {
      if(!is_array($request->getParameter('ids')))
      {
        $this->ids = explode(',', $request->getParameter('ids'));
      }
      else
      {
        $this->ids = $request->getParameter('ids');
      }
    }
    if (!$this->ids)
		{
				$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must select at least one workstation.'));
				$this->redirect('lan/index');
		}
    
    return $this->ids; // we could avoid returning it, since it's avaailable anyway
    
  }

  public function executeScheduleinternetaccess(sfWebRequest $request)
  {
    $this->form= new ToggleInternetAccessForm(null, array('tsc'=>$this->timeslotsContainer));

		if ($request->isMethod('post'))
    {
			$this->form->bind($request->getParameter('info'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
//				$result=SchoolprojectPeer::setApprovalDate($this->getUser(), $params, $this->getContext());
        
				$this->getUser()->setFlash($result['result'],
					$this->getContext()->getI18N()->__($result['message'])
					);
        
        return $this->redirect('lan/index');
			}
		}

    if($this->getUser()->hasAttribute('ids'))
    {
      $this->ids=$this->getUser()->getAttribute('ids');
    }
    else
    {
      $this->ids=$this->_getIds($request);
    }
    $this->Workstations=WorkstationPeer::retrieveByPks($this->ids);
    $this->form->setDefaultsFromCurrentSettings($this->Workstations);

  }



  public function executeAdminenableinternetaccess(sfWebRequest $request)
  {
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
