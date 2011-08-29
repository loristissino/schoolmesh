<?php

class projectsComponents extends sfComponents
{
  public function executeDeadlines()
  {
    $this->deadlines=$this->project->getProjDeadlines();
  }
  public function executeResources()
  {
    $this->resources=$this->project->getProjResources();
  }
  public function executeWorkflow()
  {
    $this->wfevents=$this->project->getWorkflowLogs();
  }
}
