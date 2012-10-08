<?php

/**
 * schoolmeshFixProjectsTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshFixProjectsTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
      new sfCommandOption('dry-run', null, sfCommandOption::PARAMETER_NONE, 'Whether the command will be executed leaving the db intact'),
    ));


    $this->namespace        = 'schoolmesh';
    $this->name             = 'fix-projects';
    $this->briefDescription = 'Fixes projects, removing expired items and creating new needed teams.';
    $this->detailedDescription = <<<EOF
This task will fix projects, taking care of the refactoring of details.
EOF;
  }


  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    $this->context = sfContext::createInstance($this->configuration);

    $con = Propel::getConnection(AppointmentPeer::DATABASE_NAME);
		$con->beginTransaction();

    $projects=SchoolprojectPeer::doSelect(new Criteria());
    foreach($projects as $project)
    {
      $this->logSection('project', sprintf('== %s ==', $project), null, 'COMMENT');
      
      foreach(array(
        'description'=>'getDescription',
        'notes' => 'getNotes',
        'addressees' => 'getAddressees',
        'purposes' => 'getPurposes',
        'goals' => 'getGoals',
        'final_report' => 'getFinalReport',
        'proposals' => 'getProposals',
        ) as $field=>$getter)
      {
        echo $project->$getter() . "\n";
        $type=ProjDetailTypePeer::retrieveByCode($field);
        echo $type->getDescription() . "\n";
        
        $detail=$project->getDetail($type->getId());
        if(!$detail)
        {
          $detail = new ProjDetail();
        }
        
        $detail
        ->setContent($project->$getter())
        ->setSchoolprojectId($project->getId())
        ->setProjDetailTypeId($type->getId())
        ->save($con)
        ;
      }
      
    }
    
    if ($options['dry-run'])
    {
      echo "Rolled back!\n";
      $con->rollback();
    }
    else
    {
      echo "Executed!\n";
      $con->commit();
    }

  }

}
