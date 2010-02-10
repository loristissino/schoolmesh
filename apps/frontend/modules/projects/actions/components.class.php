<?php

class projectsComponents extends sfComponents
{
  public function executeDeadlines()
  {
	
	$this->deadlines=$this->project->getProjDeadlines();
	
  }
}
