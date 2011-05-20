<?php

class schoolmeshGenerateLimesurveyTokensTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addArguments(array(
       new sfCommandArgument('role', sfCommandArgument::REQUIRED, 'Role'),
       new sfCommandArgument('filename', sfCommandArgument::REQUIRED, 'File name'),
     ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
      
      new sfCommandOption('valid-from', null, sfCommandOption::PARAMETER_OPTIONAL, 'Start validity date'),
      new sfCommandOption('valid-until', null, sfCommandOption::PARAMETER_OPTIONAL, 'End validity date'),
      new sfCommandOption('url', null, sfCommandOption::PARAMETER_REQUIRED, 'URL for the survey'),
            
    ));

    $this->namespace        = 'schoolmesh';
    $this->name             = 'generate-limesurvey-tokens';
    $this->briefDescription = 'Generate Limesurvey tokens for all active users';
    $this->detailedDescription = "";
  }

  protected function execute($arguments = array(), $options = array())
  {
	
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    $this->context = sfContext::createInstance($this->configuration);

    // add your code here
    
    $filename=$arguments['filename'];
    
    if (file_exists($filename))
    {
      $this->logSection('file', 'File ' . $filename . ' already exists', null, 'ERROR');
      return 1;
    }
    
    $validfrom=$options['valid-from'];
    $validuntil=$options['valid-until'];
    
    
    $role=$arguments['role'];
    
    $students = $role==sfConfig::get('app_config_students_default_posix_group');
    
    $tokens=array();
    
    $profiles=sfGuardUserProfilePeer::retrieveAllActiveByRole($role);
    
    echo sizeof($profiles) . "\n";
    
    $f = fopen($filename, 'w');
    fwrite($f, implode(',', array(
      'firstname',
      'lastname',
      'email',
      'token',
      'validfrom',
      'validuntil',
      )) . "\n");
      
      
    foreach($profiles as $profile)
    {
      $token=Generic::generateUniqueToken($profile->getUsername(), 4); 
    
      $lastname=$students ? $profile->getCurrentSchoolClassId() :  $role;
      
      // we don't use lastnames really, so we use the field to store information
      // useful for conditioned questions...
      // LimeSurvey could use attribute_1 and attribute_2 fields, but they should
      // be added each time explicitly...
    
      fwrite($f, implode(',', array(
        $token,
        $lastname,
        $token . '@example.com',
        $token,
        $validfrom,
        $validuntil,
        )) . "\n");
       
      $tokens[$token]=$lastname; 
       
    }
    fclose($f);
    
    $this->logSection('file+', $filename, null, 'INFO');
    
    asort($tokens);
    
  $config = sfTCPDFPluginConfigHandler::loadConfig('pdf_configs');
  
  $pdf = new sfTCPDFLabel();
  $pdf->AliasNbPages();
  $pdf->AddPage();
  
  $pdf->setCellMargins(1, 1, 1, 1);
  
  foreach($tokens as $token=>$lastname)
  {
    $pdf->AddLabel(
      $lastname . "\n\n" .
      "token: " . $token . "\n" .
      $options['url']
      );
  }
 
  // output
  $pathinfo=pathinfo($filename);
  $pdfname=substr($filename, 0, strlen($filename) - strlen($pathinfo['extension'])-1) . '.pdf';
  
  $pdf->Output($pdfname, 'F');

  $this->logSection('file+', $pdfname, null, 'INFO');

  }
  
}
