<?php

class GeneratedDocMessage extends ProjectBaseMessage
{
  public function __construct(sfGuardUserProfile $addressee, sfContext $sfContext=null)
  {
    parent::__construct();
	
	  $this
    ->parseTemplate('generated_doc.yml', $addressee, $sfContext)
    ->setTo(array($addressee->getEmail() => $addressee->getFullName()))
    ;
  }
}
