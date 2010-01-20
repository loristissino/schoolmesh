<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    sfYaml::setSpecVersion('1.1');
    $this->enableAllPluginsExcept(array('sfDoctrinePlugin', 'sfCompat10Plugin'));
	
	$this->getEventDispatcher()->connect('application.log', array('sfGuardUserProfilePeer', 'registerLogin'));
	
  }

	/**
     * taken from http://snippets.symfony-project.org/snippet/377
	*/

  static protected
    $mailer  = null # Symfony mailer system
    ;
 
  /**
   * Returns the project mailer
   */
  static public function getMailer()
  {
    if (null !== self::$mailer)
    {
      return self::$mailer;
    }
 
    // If sfContext has instance, returns the classic mailer resource
    if (sfContext::hasInstance() && sfContext::getInstance()->getMailer())
    {
      self::$mailer = sfContext::getInstance()->getMailer();
    }
    else
    {
      // Else, initialization
      if (!self::hasActive())
      {
        throw new sfException('No sfApplicationConfiguration loaded');
      }
      require_once sfConfig::get('sf_symfony_lib_dir').'/vendor/swiftmailer/classes/Swift.php';
      Swift::registerAutoload();
      sfMailer::initialize();
      $applicationConfiguration = self::getActive();
 
      $config = sfFactoryConfigHandler::getConfiguration($applicationConfiguration->getConfigPaths('config/factories.yml'));
 
      self::$mailer = new $config['mailer']['class']($applicationConfiguration->getEventDispatcher(), $config['mailer']['param']);
    }
 
    return self::$mailer;
  }
}





