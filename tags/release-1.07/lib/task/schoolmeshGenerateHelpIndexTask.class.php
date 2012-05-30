<?php

/**
 * schoolmeshGenerateHelpIndexTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshGenerateHelpIndexTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addArguments(array(
       new sfCommandArgument('templatefile', sfCommandArgument::REQUIRED, 'Index template file'),
       new sfCommandArgument('directoryname', sfCommandArgument::REQUIRED, 'Directory to search for help files'),
       new sfCommandArgument('outputfile', sfCommandArgument::REQUIRED, 'Output file'),
     ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
      
      new sfCommandOption('basehref', null, sfCommandOption::PARAMETER_OPTIONAL, 'The base href for documents', 'http://www.schoolmeshdemo.tuxfamily.org/help/'),
            
    ));

    $this->namespace        = 'schoolmesh';
    $this->name             = 'generate-help-index';
    $this->briefDescription = 'Generates help index file from a template and a directory with properly commented html pages';
    $this->detailedDescription = "";
  }

  protected function execute($arguments = array(), $options = array())
  {
	
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    $this->context = sfContext::createInstance($this->configuration);

    // add your code here
    
    $template=sfYaml::load($arguments['templatefile']);
    
    if(!is_array($template))
    {
      throw new Exception('Could not read template: ' . $arguments['templatefile']);
    }
    
    $found=array();
    $fragments=array();
    
    foreach($template['help']['modules'] as $modulename=>$modulechildren)
    {
      if($modulename!='default')
      {
        foreach($modulechildren as $childname=>$childvalue)
        {
          $key=sprintf("%s_%s", $modulename, $childname);
          
          $command=sprintf('grep -l "%s" "%s/"*html', $key, $arguments['directoryname']);
          
          $result=array();
          $return_var=0;

          exec($command, $result, $return_var);
          
          if ($return_var==0)
          {
            $file=substr($result[0], strlen($arguments['directoryname'])+1);
            if(in_array($file, $found))
            {
              $content=implode("\n", file($arguments['directoryname'].'/'.$file));
              $pattern=sprintf('/%s#[^<]*/', $key);
              $matches=array();
              preg_match($pattern, $content, $matches);
              if(sizeof($matches)>0)
              {
                $match=$matches[0];
                $file=str_replace($key, $file, $match);
                list($left, $fragment)=explode('#', $match);
                if(in_array($fragment, $fragments))
                {
                  $this->logSection('fragment!', 'Found duplicate fragment: ' . $fragment, null, 'ERROR');
                }
                else
                {
                  $fragments[]=$fragment;
                }
              }
              else
              {
                $this->logSection('item!', 'Found duplicate: ' . $key, null, 'ERROR');
              }
            }
            else
            {
              $found[]=$file;
            }
            $this->logSection('item', $key . ' => ' . $file, null, 'COMMENT');
            $template['help']['modules'][$modulename][$childname]=$file;
          }
          else
          {
            $this->logSection('item?', 'Missing: ' . $key , null, 'ERROR');
          }
        }
        
      }
      
    }

    $template['help']['basehref']=$options['basehref'];
    
    $fp=fopen($arguments['outputfile'], 'w');
    fwrite($fp, sfYaml::dump($template, 4));
    fclose($fp);
    $this->logSection('file+', $arguments['outputfile'], null, 'NOTICE');

  }
  
}
