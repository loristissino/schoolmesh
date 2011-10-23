<?php

class WorkflowConfirmationMessage extends ProjectBaseMessage
{
  public function __construct(sfGuardUserProfile $user, sfContext $sfContext=null, $base='', $replacements=array(), $cc=null)
  {
    parent::__construct();
    
    $this
    ->parseTemplate($base.'.yml', $user, $sfContext)
    ->addStandardTagline()
    ->makeReplacements($replacements)
	  ->setTo(array($user->getEmail() => $user->getFullName()))
    ;
    
    $this->setCc($cc);
   
  }
}