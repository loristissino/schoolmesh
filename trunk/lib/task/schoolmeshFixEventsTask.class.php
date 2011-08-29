<?php

class schoolmeshFixEventsTask extends sfBaseTask
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
    ));

    $this->namespace        = 'schoolmesh';
    $this->name             = 'fix-events';
    $this->briefDescription = 'Fix events, moving from wpevent to wfevent table';
    $this->detailedDescription = <<<EOF
This task is to be used for moving from old wpevent to new wfevent table.
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();


    $c=New Criteria();
    $c->addAscendingOrderByColumn(WpeventPeer::ID);
    $wpevents=WpeventPeer::doSelect($c);

    foreach($wpevents as $wpevent)
    {
      $wfevent=new Wfevent();
      $wfevent
      ->setBaseTable(3)
      ->setBaseId($wpevent->getAppointmentId())
      ->setUserId($wpevent->getUserId())
      ->setComment($wpevent->getComment())
      ->setState($wpevent->getState())
      ->setCreatedAt($wpevent->getCreatedAt())
      ->save();
      echo $wfevent->getId() . "\n";
    }

  }

}