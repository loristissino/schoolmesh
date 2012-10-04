<?php

/**
 * tasks actions.
 *
 * @package    schoolmesh
 * @subpackage tasks
 * @author     Loris Tissino <loris.tissino@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tasksActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $smTaskManager=new smTaskManager(sfConfig::get('app_tasks_config_file'));
    
    $this->available_tasks = $smTaskManager->getAvailableTasks($this->getUser()->getCredentials());
    $this->config=$smTaskManager->getConfig();
    
//    $this->availableTasks=smTaskManager
    
    $tasks=$this->getUser()->getAttribute('tasks', array());
    foreach($tasks as $pid=>$task)
    {
      if(!posix_getsid($pid))
      {
        $tasks[$pid]['running']=false;
        
        foreach(array('output', 'error') as $filetype)
        {
          $file=new smFileInfo($task[$filetype. '_file']);
          if($file->getSize()>0)
          {
            $tasks[$pid][$filetype]=true;
          }
        }
      }
    }
    $this->getUser()->setAttribute('tasks', $tasks);
  }

  public function executeExecute(sfWebRequest $request)
  {
    $smTaskManager=new smTaskManager(sfConfig::get('app_tasks_config_file'));
    $this->forward404Unless($this->task = $smTaskManager->getTask($request->getParameter('code'), $this->getUser()->getCredentials()));
    $this->form=new TaskForm(null, array('task'=>$this->task));
    
    if($request->isMethod('POST'))
    {
      $this->form->bind($request->getParameter('task'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
        $basecommand=$smTaskManager->getCommandLine($this->task, $params);

        $stdout=tempnam(sfConfig::get('app_config_tempdir', '/tmp'), 'task');
        $stderr=tempnam(sfConfig::get('app_config_tempdir', '/tmp'), 'task');
        
        $command = sprintf('cd %s; %s > %s 2> %s & PID=$!; echo $PID',
          sfConfig::get('app_config_base_dir'), 
          $basecommand,
          $stdout,
          $stderr
          );
        
        exec($command, $result, $return_var);
        
        $pid=$result[0];
        
        $tasks=$this->getUser()->getAttribute('tasks', array());
        
        $tasks[$pid]=array(
          'command'=>$basecommand,
          'output_file'=>$stdout,
          'error_file'=>$stderr,
          'output'=>false,
          'error'=>false,
          'running'=>true,
          'start'=>time(),
          );
        
        $this->getUser()->setAttribute('tasks', $tasks);

        $tasks=$this->getUser()->getAttribute('tasks', array());
      
        $this->redirect('tasks/index');
      }
    }
    
  }
  
  public function executeClear(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('POST'));
    $this->getUser()->getAttributeHolder()->remove('tasks');
    $this->redirect('tasks/index');
  }

  public function executeShowfile(sfWebRequest $request)
  {
    $tasks=$this->getUser()->getAttribute('tasks', array());
    $this->file=$tasks[$request->getParameter('pid')][$request->getParameter('type'). '_file'];
    $this->forward404Unless(is_readable($this->file));
  }

}
