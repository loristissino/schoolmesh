<?php

class smTaskManager
{
  private $config;

  public function __construct($configfile)
  {
    $this->config = sfYaml::load($configfile);
    if(!is_array($this->config))
    {
      throw new Exception('Not a valid configuration file for Task Manager: '. $configfile);
    }
  }
  
  public function getConfig()
  {
    return $this->config;
  }

  public function getAvailableTasks($credentials)
  {
    $list=array();
    foreach($this->config['tasks'] as $code=>$values)
    {
      if($this->_checkCredentials($values['credentials'], $credentials))
      {
        $list[$code]=$values;
      }
    }
    return $list;
  }
  
  public function getTask($code, $credentials)
  {
    if(!isset($this->config['tasks'][$code]))
    {
      return false;
    }
    if($this->_checkCredentials($this->config['tasks'][$code]['credentials'], $credentials))
    {
      $task=$this->config['tasks'][$code];
      $task['code']=$code;
      return $task;
    }
    return false;
  }
  
  public function getCommandLine($task, $params)
  {
    $namespace=$task['namespace']?$task['namespace'].':':'';
    
    $command=sprintf('php symfony %s%s ', 
      $namespace, 
      $task['task']
      );
      
    if($task['namespace']=='schoolmesh')
    {
      $command.= sprintf('--application=%s --env=%s ',
        $this->config['config']['application'],
        $this->config['config']['environment']
        );
    }
    
    if(is_array($task['options']))
    {
      foreach($task['options'] as $k=>$v)
      {
        if(isset($params[$k.'_']) and $params[$k.'_'])
        {
          $command.=sprintf('--%s="%s" ', $k, $params[$k.'_']);
        }
      }
    }

    if(is_array($task['arguments']))
    {
      foreach($task['arguments'] as $k=>$v)
      {
        if(isset($params[$k]))
        {
          $command.=sprintf('"%s" ', $params[$k]);
        }
      }
    }
    
    return $command;
  }

  private function _checkCredentials($needed=array(), $available=array())
  {
    foreach($needed as $n)
    {
      if(in_array($n, $available))
      {
        return true;
      }
    }
    return false;
  }

}
