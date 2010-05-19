<?php

class schoolmeshGenerateDocumentsTask extends sfBaseTask
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
	   new sfCommandOption('year', null, sfCommandOption::PARAMETER_REQUIRED, 'School year', ''), 
  
	   new sfCommandOption('state', null, sfCommandOption::PARAMETER_REQUIRED, 'Appointment state', ''), 

    ));

	$this->addArgument('doctype', sfCommandArgument::REQUIRED, 'The information type requested');

    $this->namespace        = 'schoolmesh';
    $this->name             = 'generate-documents';
    $this->briefDescription = 'Generates PDF document from the database (workplans and final reports';
    $this->detailedDescription = <<<EOF
This is a general purpose task to be used to generate PDF files in batch procedures).
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    // add your code here
	
	$year=YearPeer::retrieveByDescription($options['year']);
	if (!$year)
	{
		$this->log($this->formatter->format('Not a valid year specified: ' . $options['year'], 'ERROR'));
		return false;
	}

	switch ($arguments['doctype'])
	{
		
		case 'appointments':
			$c=new Criteria();
			$c->add(AppointmentPeer::YEAR_ID, $year);

			if (is_numeric($options['state']))
			{
				$c->add(AppointmentPeer::STATE, $options['state']);
			}

			$appointments=AppointmentPeer::doSelect($c);
			foreach($appointments as $appointment)
			{
        echo "$appointment\n";
        
				$filename=sprintf('/tmp/%s_%s_%s.odt',
					$appointment->getOwner()->getProfile()->getFullname(),
					$appointment->getSchoolclassId(),
					$appointment->getSubject()->getDescription()
					);

				
				$odf=$appointment->getOdf('odt');
				
				$odf->saveFile();
				
				
				copy($odf->getFileName(), $filename);

				echo "saved $filename: --> " . $odf->getFileName()  . "\n";
				
				unset($odf);
				
				
			}
		
			break;
			
			
		
		default:
			$this->log($this->formatter->format('Not a valid info type requested: ' . $arguments['infotype'], 'ERROR'));
			return false;
		
	}

  }

}
