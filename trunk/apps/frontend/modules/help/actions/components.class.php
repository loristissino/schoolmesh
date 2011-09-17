<?php

class helpComponents extends sfComponents
{
  public function executeHelp()
  {
    $this->module=$this->sf_user->getFlash('helpmodule', $this->module);
    $this->action=$this->sf_user->getFlash('helpaction', $this->action);
    $this->config=sfYaml::load(sfConfig::get('app_config_help_index', false));
    if(array_key_exists($this->module, $this->config))
    {
      if(array_key_exists($this->action, $this->config[$this->module]))
      {
        $this->helplink=$this->config[$this->module][$this->action];
      }
      elseif(array_key_exists('default', $this->config[$this->module]))
      {
        $this->helplink=$this->config[$this->module]['default'];
      }
      else
      {
        return sfView::NONE;
      }
    }
    else
    {
      return sfView::NONE;
    }
  }
}
