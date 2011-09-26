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

  private function _retrieveWorkstations(sfWebRequest $request)
  {
    if($this->getUser()->hasAttribute('ids'))
    {
      $this->ids=$this->getUser()->getAttribute('ids');
    }
    else
    {
      $this->ids=$this->_getIds($request);
    }
    $this->Workstations=WorkstationPeer::retrieveByPks($this->ids);
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    if(!$this->currentsubnet)
    {
      return sfView::ERROR;
    }
    
    $this->Workstations = WorkstationPeer::retrieveAllWorkstations($this->currentsubnet);
    
    $this->actions=array(
      '0' => $this->getContext()->getI18N()->__('Choose an action')
      );
    if($this->getUser()->hasCredential('internet'))
    {
      $this->actions=array_merge($this->actions, array(
        'scheduleinternetaccess' => $this->getContext()->getI18N()->__('Schedule Internet access'),
        'enable_ia_currenttimeslot' => $this->getContext()->getI18N()->__('Enable Internet access for the current time slot'),
        'disable_ia_currenttimeslot' => $this->getContext()->getI18N()->__('Disable Internet access for the current time slot'), 
      ));
    }

    if($this->getUser()->hasCredential('admin'))
    {
      $this->actions=array_merge($this->actions, array(
        'enable_ia_until11thhour' => $this->getContext()->getI18N()->__('Enable Internet access until the eleventh hour'),
        'viewevents' => $this->getContext()->getI18N()->__('View events'),
        ));
    }
    
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
    
    $this->form= new ScheduleInternetAccessForm(null, array('tsc'=>$this->timeslotsContainer));

		if ($request->isMethod('post'))
    {
			$this->form->bind($request->getParameter('info'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				$result=WorkstationPeer::scheduleInternetAccess($this->getUser(), $params, $this->timeslotsContainer, $this->getContext());
        
				$this->getUser()->setFlash($result['result'],
					$this->getContext()->getI18N()->__($result['message'])
					);
        
        return $this->redirect('lan/index');
			}
		}
    $this->_retrieveWorkstations($request);
    $this->form->setDefaultsFromCurrentSettings($this->Workstations);
  }


  public function executeEnable_ia_currenttimeslot(sfWebRequest $request)
  {
    $this->_retrieveWorkstations($request);
    if($request->isMethod('POST'))
    {
      $result=WorkstationPeer::enableInternetAccess($this->getUser(), $this->Workstations, $this->timeslotsContainer, 'current', $this->getContext());
      $this->getUser()->setFlash($result['result'],
        $this->getContext()->getI18N()->__($result['message'])
        );
      return $this->redirect('lan/index');
    }

    $this->form = new ConfirmForm();
    $this->action='enable_ia_currenttimeslot';
    $this->setTemplate('confirm');
  }

  public function executeDisable_ia_currenttimeslot(sfWebRequest $request)
  {
    $this->_retrieveWorkstations($request);
    if($request->isMethod('POST'))
    {
      $result=WorkstationPeer::disableInternetAccess($this->getUser(), $this->Workstations, $this->timeslotsContainer, 'current', $this->getContext());
      $this->getUser()->setFlash($result['result'],
        $this->getContext()->getI18N()->__($result['message'])
        );
      return $this->redirect('lan/index');
    }
    $this->form = new ConfirmForm();
    $this->action='disable_ia_currenttimeslot';
    $this->setTemplate('confirm');
  }


  public function executeEnable_ia_until11thhour(sfWebRequest $request)
  {
    $this->_retrieveWorkstations($request);
    if($request->isMethod('POST'))
    {
      $result=WorkstationPeer::enableInternetAccess($this->getUser(), $this->Workstations, $this->timeslotsContainer, 'allday', $this->getContext());
      $this->getUser()->setFlash($result['result'],
        $this->getContext()->getI18N()->__($result['message'])
        );
      return $this->redirect('lan/index');
    }
    $this->form = new ConfirmForm();
    $this->action='enable_ia_until11thhour';
    $this->setTemplate('confirm');
  }
  
  public function executeViewevents(sfWebRequest $request)
  {
    $this->_retrieveWorkstations($request);
  }

  public function executeAdminenableinternetaccess(sfWebRequest $request)
  {
    $this->endtime=$this->timeslotsContainer->getEleventhHour();
    $this->_doEnableinternetaccess($request);
  }

  public function executeUserenableinternetaccess(sfWebRequest $request)
  {
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
