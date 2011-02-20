<?php

class InformativeMessage extends ProjectBaseMessage
{
  public function __construct($addressees, sfGuardUserProfile $sender, sfContext $sfContext=null)
  {
    parent::__construct();
	
    $replacements=array(
    '%sender_fullname%'=>$sender->getFullname(),
    '%sender_email%'=>$sender->getValidatedEmail()
		);
  
    $to=array();
    foreach($addressees as $addressee)
    {
      if($addressee->getProfile()->getHasValidatedEmail())
      {
        $to[$addressee->getProfile()->getValidatedEmail()]=$addressee->getProfile()->getValidatedEmail();
      }
    }
  
	  $this
    ->parseTemplate('informative_message.yml', $addressees, $sfContext)
    ->addStandardTagline()
    ->makeReplacements($replacements)
    ->setTo($to)
    ;
  }
}