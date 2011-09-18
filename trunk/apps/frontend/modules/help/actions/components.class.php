<?php

class helpComponents extends sfComponents
{
  public function executeHelp()
  {
    $this->module=$this->sf_user->getFlash('helpmodule', $this->module);
    $this->action=$this->sf_user->getFlash('helpaction', $this->action);
    $this->help=sfYaml::load(sfConfig::get('app_config_help_index', false));
    if(!is_array($this->help))
    {
      return sfView::NONE;
    }
    
    $modules=$this->help['help']['modules'];
    
    if(array_key_exists($this->module, $modules))
    {
      if(array_key_exists($this->action, $modules[$this->module]))
      {
        // we have both module and action
        $this->helplink=$modules[$this->module][$this->action];
      }
      elseif(array_key_exists('default', $modules[$this->module]))
      {
        // we have the module and we use the default action
        $this->helplink=$modules[$this->module]['default'];
      }
      else
      {
        // we have the module, no action, and no default is specified
        $this->helplink=false;
      }
    }
    elseif (array_key_exists('default', $modules))
    {
      // we use the super default 
      $this->helplink=$modules['default'];
    }
    else
    {
      // we don't have any super default
      $this->helplink=false;
    }
    
    if(!$this->helplink)
    {
      return sfView::NONE;
    }
    
    if(substr($this->helplink, 0, 4)!='http')
    {
      $this->helplink=$this->help['help']['basehref'] . $this->helplink;

    }
    
    
  }
}
