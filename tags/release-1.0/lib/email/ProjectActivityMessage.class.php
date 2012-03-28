<?php

class ProjectActivityMessage extends ProjectBaseMessage
{
  public function __construct(sfGuardUserProfile $addressee, sfGuardUserProfile $sender, ProjActivity $activity, sfContext $sfContext=null)
  {
    parent::__construct();
	
    $replacements=array(
		'%activity_notes%'=>$activity->getNotes(),
		'%activity_date%'=>$activity->getBeginning('d/m/Y'),
    '%sender_fullname%'=>$sender->getFullname(),
    '%sender_email%'=>$sender->getValidatedEmail()
		);
  
	  $this
    ->parseTemplate('project_activity.yml', $addressee, $sfContext)
    ->addStandardTagline()
    ->makeReplacements($replacements)
    ->setTo(array($addressee->getEmail() => $addressee->getFullName()))
    ;
  }
}