<?php

require_once dirname(__FILE__).'/../lib/roleGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/roleGeneratorHelper.class.php';

/**
 * role actions.
 *
 * @package   schoolmesh
 * @subpackage role
 * @author     Loris Tissino
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class roleActions extends autoRoleActions
{
   public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

   try {

    $this->getRoute()->getObject()->delete();

    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');

    $this->redirect('@role');
    }
    
    catch (Exception $e)
    
    {
        
    $this->getUser()->setFlash('error', 'The item was not deleted because of integrity violations.');

    $this->redirect('@role');
        
        
    }
  }
   
    
}
