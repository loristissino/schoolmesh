<?php

require_once dirname(__FILE__).'/../lib/workstationGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/workstationGeneratorHelper.class.php';

/**
 * workstation actions.
 *
 * @package   schoolmesh
 * @subpackage workstation
 * @author     Loris Tissino
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class workstationActions extends autoWorkstationActions
{


    public function executeBatchEnable_Internet_access(sfWebRequest $request)
    {
    $ids = $request->getParameter('ids');
    $workstations = WorkstationPeer::retrieveByPks($ids);
    foreach ($workstations as $workstation)
    {
      $workstation->InternetEnable(true);
    }
    $this->getUser()->setFlash('notice', 'The selected workstations have been
enabled successfully.');
    $this->redirect('@workstation');

    }


    public function executeBatchDisable_Internet_access(sfWebRequest $request)
    {
    $ids = $request->getParameter('ids');
    $workstations = WorkstationPeer::retrieveByPks($ids);
    foreach ($workstations as $workstation)
    {
      $workstation->InternetEnable(false);
    }
    $this->getUser()->setFlash('notice', 'The selected workstations have been
disabled successfully.');
    $this->redirect('@workstation');

    }


  public function executeListToggleInternetAccess(sfWebRequest $request)
  {
    $workstation = $this->getRoute()->getObject();
    $workstation->InternetEnable(!$workstation->getIsEnabled());
    if ($workstation->getIsEnabled())
        $message=sprintf("The selected workstation has been Internet-enabled successfully");
    else
        $message=sprintf("The selected workstation has been Internet-disabled successfully");
    $this->getUser()->setFlash('notice', $message);
    $this->redirect('@workstation');
  }

    

    protected function setFilters(array $filters)
  {
      
//questo funziona!!!  $filters['name']['text']='biegacz';

ob_start();
$f=fopen('lorislog.txt', 'w');

print_r($filters);
$my_string = ob_get_contents();
fwrite($f, $my_string);

fclose($f);

ob_end_clean();


    return $this->getUser()->setAttribute('workstation.filters', $filters, 'admin_module');
  }

}
