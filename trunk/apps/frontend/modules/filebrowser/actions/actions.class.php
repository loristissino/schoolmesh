<?php

/**
 * filebrowser actions.
 *
 * @package    schoolmesh
 * @subpackage filebrowser
 * @author     Loris Tissino
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class filebrowserActions extends sfActions
{
	
  public function preExecute()
	{
		$this->profile=$this->getUser()->getProfile();
		$this->path = $this->getUser()->getAttribute('path', '/');
		$this->folder= new Folder($this->profile->getUsername(), $this->path);
		if (!$this->folder->getPathExists())
		{
			$this->getUser()->setAttribute('path', $this->getUser()->getAttribute('oldpath', '/'));
			$this->forward404();
		}
		$this->getUser()->setAttribute('oldpath', $this->path);

	}
	
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
	
		$this->path=$this->folder->getPath();
		$this->folder_items=$this->folder->getFolderItems();
	
  }
  public function executeOpen(sfWebRequest $request)
  {
		$current=$this->folder->getPath();
		if ($current=='/')
		{
			$current='';
		}
		$this->getUser()->setAttribute('path', $current. '/' . $request->getParameter('name'));
		$this->redirect('filebrowser/index');
  }

  public function executeDownload(sfWebRequest $request)
  {
		$filename=$request->getParameter('name');
		try
		{
			$this->folder->serveFile(urldecode($filename), $this->getContext()->getResponse());
			return sfView::NONE;

		}
		catch (Exception $e)
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('The file "%filename%" cannot be downloaded.', array('%filename%'=>$filename)));
		}
		
		$this->forward('filebrowser', 'index');
  }



	public function executeUp(sfWebRequest $request)
  {
		
		$this->getUser()->setAttribute('path', dirname($this->folder->getPath()));
		$this->redirect('filebrowser/index');
  }
}
