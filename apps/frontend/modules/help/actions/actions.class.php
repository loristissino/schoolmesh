<?php

/**
 * help actions.
 *
 * @package    schoolmesh
 * @subpackage help
 * @author     Loris Tissino
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class helpActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

	$this->steps = Workflow::getWpfrSteps();
	$this->states = Workflow::getWpfrStates();

	}
}
