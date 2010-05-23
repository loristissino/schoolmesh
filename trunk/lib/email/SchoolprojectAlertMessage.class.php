<?php

class SchoolprojectAlertMessage extends ProjectBaseMessage
{
  public function __construct(sfGuardUserProfile $addressee, sfGuardUserProfile $sender, Schoolproject $project, sfContext $sfContext=null)
  {
    parent::__construct();
	
    $replacements=array(
		'%project_title%'=>$project->getTitle(),
		'%id%'=>$project->getId(),
    '%deadlines_list%'=>$project->getOverdueDeadlines(array('astext'=>true)),
    '%sender_fullname%'=>$sender->getFullname(),
    '%sender_email%'=>$sender->getValidatedEmail()
		);
  
	  $this
    ->parseTemplate('project_alert.yml', $addressee, $sfContext)
    ->addStandardTagline()
    ->makeReplacements($replacements)
    ->setTo(array($addressee->getEmail() => $addressee->getFullName()))
    ;
  }
}