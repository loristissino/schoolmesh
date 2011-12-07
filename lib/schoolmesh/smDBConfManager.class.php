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
    
    $this->_init_command='#unknown';
    $this->_backup_command='#unknown';
    $this->_restore_command='#unknown';
    
    $conf=sfYaml::load(sfConfig::get('app_config_base_dir').'/config/databases.yml');
    
    $sqlfiles=array();
    foreach(scandir(sfConfig::get('app_config_base_dir').'/data/sql') as $entry)
    {
      if(preg_match('/sql$/', $entry))
      {
        $sqlfiles[]=sfConfig::get('app_config_base_dir').'/data/sql/' . $entry;
      }
    }
    
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
        $this->_init_command='';
        foreach($sqlfiles as $sqlfile)
        {
          $this->_init_command.=sprintf("cat %s | mysql --host=%s -u %s -p%s %s\n", 
            $sqlfile, $pairs['host'], $username, $password, $pairs['dbname']
            );
        }
        $this->_backup_command=sprintf("
echo 'SET foreign_key_checks = 0;' > '_BACKUPFILE_'
mysqldump --host=%s --no-create-info -u %s -p%s %s >> '_BACKUPFILE_'
echo 'SET foreign_key_checks = 1;' >> '_BACKUPFILE_'
",
          $pairs['host'], $username, $password, $pairs['dbname']
        );
        $this->_restore_command=sprintf("zcat '_BACKUPFILE_' | mysql --host=%s -u %s -p%s %s",
          $pairs['host'], $username, $password, $pairs['dbname']
        );
        break;
    }

  }
  
  public function getInitCommand()
  {
    return $this->_init_command;
  }

  public function getBackupCommand($backupfile)
  {
    return str_replace('_BACKUPFILE_', $backupfile, $this->_backup_command);
  }

  public function getRestoreCommand($backupfile)
  {
    return str_replace('_BACKUPFILE_', $backupfile, $this->_restore_command);
  }
  
}
