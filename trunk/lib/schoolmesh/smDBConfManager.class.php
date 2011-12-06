<?php

/**
 * smDBConfManager class.
 *
 * @package    schoolmesh
 * @subpackage lib.schoolmesh
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class smDBConfManager
{

  private $_dump_command;
  
  public function __construct($env)
  {
    
    $this->_dump_command='unknown';
    
    $conf=sfYaml::load(sfConfig::get('app_config_base_dir').'/config/databases.yml');
    
    if(!is_array($conf))
    {
      throw new Exception('Could not read database configuration file');
    }
    
    $dsn=false;

    if(array_key_exists($env, $conf))
    {
      $dsn=$conf[$env]['propel']['param']['dsn'];
    }
    else
    {
      $dsn=$conf['all']['propel']['param']['dsn'];
    }

    if(!$dsn)
    {
      throw new Exception('Could not read dsn');
    }
    
    list($schema, $stuff)=explode(':', $dsn);
    
    switch($schema)
    {
      case 'mysql':
        if(array_key_exists('username', $conf[$env]['propel']['param']))
        {
          $username=$conf[$env]['propel']['param']['username'];
        }
        else
        {
          $username=$conf['all']['propel']['param']['username'];
        }
        if(array_key_exists('password', $conf[$env]['propel']['param']))
        {
          $password=$conf[$env]['propel']['param']['password'];
        }
        else
        {
          $password=$conf['all']['propel']['param']['password'];
        }
        $items=explode(';',$stuff);
        $pairs=array();
        foreach($items as $item)
        {
          list($key, $value)=explode('=', $item);
          $pairs[$key]=$value;
        }
        $this->_dump_command=sprintf("
echo 'SET foreign_key_checks = 0;' > '_BACKUPFILE_'
mysqldump --host=%s --no-create-info -u %s -p%s %s >> '_BACKUPFILE_'
echo 'SET foreign_key_checks = 1;' >> '_BACKUPFILE_'
",
          $pairs['host'], $username, $password, $pairs['dbname']
        );
        break;
    }

  }
  
  public function getDumpCommand($backupfile)
  {
    return str_replace('_BACKUPFILE_', $backupfile, $this->_dump_command);
  }
  
}
