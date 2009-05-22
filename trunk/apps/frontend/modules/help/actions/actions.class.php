<?php

/**
 * help actions.
 *
 * @package    schoolmesh
 * @subpackage help
 * @author     Your name here
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
	$this->states = Array(
	Workflow::WP_DRAFT,
	Workflow::WP_WADMC,
	Workflow::WP_WSMC,
	Workflow::IR_DRAFT,
	Workflow::IR_WSMC,
	Workflow::FR_WADMC,
	Workflow::FR_WSMC,
	Workflow::FR_ARCHIVED,
	);


	}
}
