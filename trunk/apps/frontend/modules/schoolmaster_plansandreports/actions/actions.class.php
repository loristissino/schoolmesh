<?php

require_once dirname(__FILE__).'/../lib/schoolmaster_plansandreportsGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/schoolmaster_plansandreportsGeneratorHelper.class.php';

/**
 * schoolmaster_plansandreports actions.
 *
 * @package    schoolmesh
 * @subpackage schoolmaster_plansandreports
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class schoolmaster_plansandreportsActions extends autoSchoolmaster_plansandreportsActions
{
	
	public function executeListView(sfWebRequest $request)
	{
	$id = $this->getRoute()->getObject()->getId();

	$this->redirect('plansandreports/view?id='.$id);
		
	}

	public function executeListApprove(sfWebRequest $request)
	{
	$workplan = $this->getRoute()->getObject();

	$result = $workplan->Approve($this->getUser()->getProfile()->getSfGuardUser()->getId(), $this->getUser()->getAllPermissions());

	$this->getUser()->setFlash($result['result'], $result['message']);

	$this->redirect('@appointment');
		
	}

	public function executeListReject(sfWebRequest $request)
	{
	$workplan = $this->getRoute()->getObject();

	$result = $workplan->Reject($this->getUser()->getProfile()->getSfGuardUser()->getId(), $this->getUser()->getAllPermissions());

	$this->getUser()->setFlash($result['result'], $result['message']);


	$this->redirect('@appointment');
		
	}


  protected function setFilters(array $filters)
  {

$filters['state']['text']=30;
ob_start();
$f=fopen('lorislog.txt', 'w');

print_r($filters);
$my_string = ob_get_contents();
fwrite($f, $my_string);

fclose($f);

ob_end_clean();

    return $this->getUser()->setAttribute('schoolmaster_plansandreports.filters', $filters, 'admin_module');
  }





}
