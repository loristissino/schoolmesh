<?php

class projectsComponents extends sfComponents
{
  public function executeResources()
  {
    $this->resources=$this->project->getProjResources();
  }
  public function executeUpshots()
  {
    $this->upshots=$this->project->getProjUpshots();
  }
  public function executeDeadlines()
  {
    $this->deadlines=$this->project->getProjDeadlines();
  }
  public function executeWorkflow()
  {
    $this->wfevents=$this->project->getWorkflowLogs();
  }
}
