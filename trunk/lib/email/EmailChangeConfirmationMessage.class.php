<?php

class EmailChangeConfirmationMessage extends ProjectBaseMessage
{
  public function __construct(sfGuardUserProfile $user)
  {
    parent::__construct();
	
	$bodylines=file($this->getTemplateDirectory() . '/email_change_confirmation.txt');
	
	$subject=$bodylines[0];
	
	$body='';
	
	for ($i=1; $i<sizeof($bodylines); $i++)
	{
		$body .= $bodylines[$i] . "\n";
	}
	
	foreach(array(
		'%fullname%'=>$user->getFullName(),
		'%verification_code%'=>$user->getEmailVerificationCode(),
		) as $key=>$value)
	{
		$body=str_replace($key, $value, $body);
	}
	

	
/*	$body = $context->getI18N()->__("Hi, %fullname%,\n\n", array('%fullname%'=>$user->getFullName()));
	$body .= $context->getI18N()->__("You must confirm your email address\n");
	$body .= $context->getI18N()->__("Please follow this link using your browser:\n");
	$body .=sfConfig::get('app_config_base_url') . 'index.php/profile/confirm?email=' . $user->getEmailVerificationCode();
	*/
 
    $this
	  ->setSubject($subject)
	  ->setBody($body)  
      ->addStandardTagline()
	  ->setTo(array($user->getEmail() => $user->getFullName()))
    ;
  }
}