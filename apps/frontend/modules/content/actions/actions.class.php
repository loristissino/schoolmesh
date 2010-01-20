<?php

/**
 * content actions.
 *
 * @package   schoolmesh
 * @subpackage content
 * @author     Loris Tissino
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
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
    public function executeIndex($request)
  {
	
//	$this->availableaccounts=sfConfig::get('app_config_accounts');

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
		
		if ($this->user->getProfile()->getEmailVerificationCode()==($request->getParameter('code')))
		{
			$this->user->getProfile()->validateEmail();
			$this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('Your email address %emailaddress% has been successfully validated.', array('%emailaddress%'=>$this->user->getProfile()->getEmail())));
			$this->getUser()->setFlash('title', 'Email address validated');
		}
		else
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('Sorry, the email address could not be validated.'));
			$this->getUser()->setFlash('title', 'Problem with email address validation');

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

	public function executeError404(sfWebRequest $request)
	{
		
	}

}
