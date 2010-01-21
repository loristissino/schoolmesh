<?php

class WorkflowConfirmationMessage extends ProjectBaseMessage
{
  public function __construct(sfGuardUserProfile $user, sfContext $sfContext=null, $base='', $arguments=array())
  {
    parent::__construct();
	
	$filename=$this->getTemplateDirectory() . '/' . $base . '.txt';
	
	if (!is_readable($filename))
	{
		throw new Exception ('File not readable: ' . $filename);
	}
	
	
	$bodylines=file($filename);
	
	$subject=$bodylines[0];
	
	$body=$user->getSalutation($sfContext);
	
	for ($i=1; $i<sizeof($bodylines); $i++)
	{
		$body .= $bodylines[$i];
	}
	
	if (sizeof($arguments)>0)
	{
		foreach($arguments as $key=>$value)
		{
			$body=str_replace($key, $value, $body);
		}
	}
	
    $this
	  ->setSubject($subject)
	  ->setBody($body)  
      ->addStandardTagline()
	  ->setTo(array($user->getEmail() => $user->getFullName()))
    ;
  }
}