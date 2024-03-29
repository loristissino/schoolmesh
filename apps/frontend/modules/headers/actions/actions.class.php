<?php

/**
 * headers actions.
 *
 * @package    schoolmesh
 * @subpackage headers
 * @author     Loris Tissino
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class headersActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
//    $this->forward('default', 'module');
	$this->forward404();
  }
  public function executeWorkplan(sfWebRequest $request)
  {
	$this->setLayout('odt_styles');

	$this->title = 'Piano di lavoro';
	$this->revision = '91.12';
	$this->code = 'My code';
	$this->reference = 'My ref';

	}
  public function executeLetter(sfWebRequest $request)
  {
	$this->setLayout('odt_styles');
	$this->title = 'Lettera di benvenuto';
	$this->revision = '91.13';
	$this->code = '1';
	$this->reference = '2';
   }
}
