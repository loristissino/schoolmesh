<?php

require_once '/usr/share/php/symfony/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enableAllPluginsExcept(array('sfDoctrinePlugin', 'sfCompat10Plugin'));
	
	$this->getEventDispatcher()->connect('application.log', array('sfGuardUserProfilePeer', 'registerLogin'));
	
  }
}


