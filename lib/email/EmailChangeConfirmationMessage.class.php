<?php

class EmailChangeConfirmationMessage extends ProjectBaseMessage
{
  public function __construct(sfGuardUserProfile $user, sfContext $sfContext=null)
  {
    parent::__construct();
	
	$bodylines=file($this->getTemplateDirectory() . '/email_change_confirmation.txt');
	
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