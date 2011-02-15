<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  
  static protected $zendLoaded = false;
  
  static public function registerZend()
  {
    
    // see http://www.symfony-project.org/jobeet/1_4/Doctrine/en/17
    if (self::$zendLoaded)
    {
      return;
    }
 
    set_include_path(sfConfig::get('sf_lib_dir').'/vendor'.PATH_SEPARATOR.get_include_path());
    require_once sfConfig::get('sf_lib_dir').'/vendor/Zend/Loader/Autoloader.php';
    Zend_Loader_Autoloader::getInstance();
    
    Zend_Search_Lucene_Analysis_Analyzer::setDefault(
      new Zend_Search_Lucene_Analysis_Analyzer_Common_TextNum_CaseInsensitive());
    // http://stackoverflow.com/questions/902190/no-hits-found-using-zend-lucene-search   
    
    self::$zendLoaded = true;
  }
  
  public function setup()
  {
    sfYaml::setSpecVersion('1.1');
    $this->enableAllPluginsExcept(array('sfDoctrinePlugin', 'sfCompat10Plugin'));
	
	$this->getEventDispatcher()->connect('application.log', array('sfGuardUserProfilePeer', 'registerLogin'));
	
  }

}





