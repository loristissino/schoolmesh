<?php

/**
 * content actions.
 *
 * @package    schoolmesh
 * @subpackage content
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 * 
 */

class contentActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
/*  public function executeIndex($request)
  {
    $this->forward('show', 'content');
  }
*/
  public function executeIndex(sfWebRequest $request)
  {
	
  //return $this->renderText(sfConfig::get('app_config_accept_gpl_license', false));
  
    if(sfConfig::get('app_config_accept_gpl_license', false)!=true)
    {
      return sfView::ERROR;
    }
  
//	$this->availableaccounts=sfConfig::get('app_config_accounts');

  }

	public function executeDocuments(sfWebRequest $request)
	{
		$this->index=$request->getParameter('index', 'main');
		$indexFile=sprintf('%s/%s.yml', sfConfig::get('app_documents_main_directory'), $this->index);
		$this->forward404Unless($this->content=sfYaml::load($indexFile));
	}
  

	public function executeServe(sfWebRequest $request)
	{
    
		$this->index=$request->getParameter('index', 'main');
		$indexFile=sprintf('%s/%s.yml', sfConfig::get('app_documents_main_directory'), $this->index);

		$this->forward404Unless($this->content=sfYaml::load($indexFile));
    
		$basedir=$this->content['basedir'];
		$this->forward404Unless($filepath=$basedir. Generic::b64_unserialize($request->getParameter('file')));
    
    return $this->_doServe($filepath);
	}
  
  
  public function executeScript(sfWebRequest $request)
  {
    $this->_validateScript($request);
    return $this->_doServe($this->filepath, 'command' . date('Ymd-his').'.sh');
  }
  
  
  public function executeExecute(sfWebRequest $request)
  {
    
    $this->forward404Unless($request->isMethod('POST'));
    $this->_validateScript($request);
    
    $this->report=array();

    $result=array();
    $return_var=0;
    
    $lines=file($this->filepath);
    foreach($lines as $line)
    {
      if(strlen(chop($line))>0 and substr($line, 0, 1)!="#")
      {
        $execution['command']='LANG=it_IT.utf-8; sudo ' . chop($line);
        exec($execution['command'], $result, $return_var);
        $execution['result']=$result;
        $execution['return_var']=$return_var;
      }
      else
      {
        $execution['command']=$line;
        $execution['result']=array();
        $execution['return_var']=0;
      }
      $this->report[]=$execution;
      unset($execution);
      unset($result);
    }
			

  }


  protected function _validateScript(sfWebRequest $request)
  {
    $this->filepath=sys_get_temp_dir() . '/' . $request->getParameter('file');
    $script= new smFileInfo($this->filepath);
		if ($script->isStale())
		{
			return $this->renderText('This script is not usable anymore'); 
		}
    
  }

  protected function _doServe($filepath, $deliveryname='')
  {
		$file = new smFileInfo($filepath);

		if (!$file->isReadable())
		{
			return $this->renderText($file->getFilename() . ' not readable'); 
		}

    
    if($deliveryname)
    {
      $file->setDeliveryName($deliveryname);
    }
    
    $file->prepareDelivery($this->getContext()->getResponse());
    
		return sfView::NONE;
  }
  
  public function executeAttachment(sfWebRequest $request)
  {
    $this->forward404Unless($attachment=AttachmentFilePeer::retrieveByPK($request->getParameter('id')));
    
    $this->forward404Unless($attachment->isViewableBy($this->getUser()));
    
		$filepath = sfConfig::get('app_documents_attachments'). '/'. $attachment->getUniqId();
    
    return $this->_doServe($filepath, $attachment->getOriginalFileName());

  }
  
  


	public function executeUnoconv(sfWebRequest $request)
	{
		$this->getResponse()->setContentType('text/plain; Charset: utf-8');
		
		$result=OdfDocPeer::startUnoconv();
		return $this->renderText('scheduled!'. "\n" . $result);
	}

	public function executeCheckemail(sfWebRequest $request)
	{
		$this->forward404Unless($this->user=sfGuardUserProfilePeer::retrieveByUsername($request->getParameter('user')));	
		
		$validation=$this->user->getProfile()->validateEmail($request->getParameter('code'));
		
		switch ($validation)
		{
			case 2:
				$this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('Your email address %emailaddress% was already successfully validated.', array('%emailaddress%'=>$this->user->getProfile()->getEmail())));
				$this->getUser()->setFlash('title', 'Email address already validated');
				break;
			case 1:
				$this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('Your email address %emailaddress% has been successfully validated.', array('%emailaddress%'=>$this->user->getProfile()->getEmail())));
				$this->getUser()->setFlash('title', 'Email address validated');
				break;
			case 0:
				$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('Sorry, the email address could not be validated.'));
				$this->getUser()->setFlash('title', 'Problem with email address validation');
				break;
		}
		return $this->redirect('content/emailvalidation');
		
	}

	public function executeEmailvalidation(sfWebRequest $request)
	{
		
	}


    public function executeWebserver($request)
	
	{
		$cmd=$request->getParameter('cmd');
		sfConfig::set('sf_web_debug', false);
		$this->getResponse()->setContentType('text/plain; Charset: utf-8');

		switch($cmd)
		{
			case 'cal':
				$command='cal';
				break;
			case 'whoami':
				$command='whoami';
				break;
			case 'sudolist':
				$command='sudo -l';
				break;
			case 'uptime':
				$command='uptime';
				break;
			case 'short_open_tag':
				return $this->renderText(ini_get('short_open_tag'));
			case 'memory_limit':
				return $this->renderText(ini_get('memory_limit'));
				
			default:
				$this->forward404();
		}

		$result=array();
		$return_var=0;
		exec($command, $result, $return_var);
		
		$response=implode("\n", $result) . "\n";
		

		return $this->renderText($response);
		
	}
  
  public function executeSetyear(sfWebRequest $request)
  {
    $this->forward404Unless($year=YearPeer::retrieveByPK($request->getParameter('id')));
    
    $this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('Year set to %year%.', array('%year%'=>$year->__toString())));
    $this->getUser()->setAttribute('year', $year->getId());
    
    $this->redirect(Generic::b64_unserialize($request->getParameter('back')));
  }

	public function executeError404(sfWebRequest $request)
	{
		
	}

  public function executeFirewall(sfWebRequest $request)
  {
  }
  
  public function executeChecksetup(sfWebRequest $request)
  {
    if(sfConfig::get('app_config_enable_checks', false))
    {
      $setupChecker = new SetupChecker();
      $this->checkList= $setupChecker->getChecks();
    }
    else
    {
      return sfView::ERROR;
    }
  }

  public function executeStatic(sfWebRequest $request)
  {
    $availabledocs=sfConfig::get('app_content_static', array());
    $filecode=$request->getParameter('filecode');
    $this->forward404Unless(isset($availabledocs[$filecode]));
    $this->forward404Unless(is_array($this->doc = $availabledocs[$filecode]));
    
//    $this->file=file('legal/gpl.txt');
  }
  
  public function executeCommonqueries(sfWebRequest $request)
  {
    $this->referer= $request->getReferer();
    $file=sfConfig::get('app_lucene_commonqueries_'.$request->getParameter('type'));

    $this->forward404Unless(is_readable($file), 'Common queries file not specified in app.yml');
    $this->info=sfYaml::load($file);
    $this->forward404Unless(is_array($this->info), 'Not a valid YAML file');
    
  }
  
  public function executeListattachments(sfWebRequest $request)
  {
    $this->id=$request->getParameter('id');
    $this->basetable=$request->getParameter('object');
    $this->object=AttachmentFilePeer::retrieveObject($this->basetable, $this->id);
    $this->attachments=$this->object->getAttachmentFiles(true);
  }
  
  
  public function executeTestplurals(sfWebRequest $request)
  {
    
  }
  
  public function executeSSOUserinfo(sfWebRequest $request)
  {
    
    $sso=new SSO();
    $this->forward404Unless($sso->getAuthKey($request->getParameter('app'))==$request->getParameter('authkey'));
    
    $this->forward404Unless($profile=sfGuardUserProfilePeer::retrieveByPK($request->getParameter('userid')));
    return $this->renderText(sprintf('%d:%s:%s',
      $profile->getUserId(),
      $profile->getUsername(),
      $profile->getFullName()
      ));
  }
  
  public function executeDisabled(sfWebRequest $request)
  {
    $this->siblings=sfConfig::get('app_config_siblings', array());
  }


}
