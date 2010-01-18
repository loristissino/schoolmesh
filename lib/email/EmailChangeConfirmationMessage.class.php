<?php

class EmailChangeConfirmationMessage extends ProjectBaseMessage
{
  public function __construct(sfGuardUserProfile $user, sfContext $sfContext=null)
  {
    parent::__construct();
	
	$filename=$this->getTemplateDirectory() . '/email_change_confirmation.txt';
	
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
	
	foreach(array(
		'%verification_code%'=>$user->getEmailVerificationCode(),
		'%username%'=>$user->getUsername(),
		) as $key=>$value)
	{
		$body=str_replace($key, $value, $body);
	}
	
    $this
	  ->setSubject($subject)
	  ->setBody($body)  
      ->addStandardTagline()
	  ->setTo(array($user->getEmail() => $user->getFullName()))
    ;
  }
}