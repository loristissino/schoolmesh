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
      
      new sfCommandOption('booklet', null, sfCommandOption::PARAMETER_NONE, 'whether the labels will be grouped vertically'),

            
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
    
    if (!$f)
    {
      $this->logSection('file', 'File ' . $filename . ' not writeable', null, 'ERROR');
      return 2;
    }
    
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
  
  $pdf = new sfTCPDFLabel(4, 8, 50, 35);
  /*
  number of labels (x),
  number of labels (y),
  width of labels (mm),
  height of labels (mm)
  */ 
  $pdf->SetFont("FreeSerif", "", 9);
  $pdf->AliasNbPages();
  
  $pdf->setCellMargins(1, 1, 1, 1);


  if($options['booklet'])
  {
    $t=array();
    $max=0;
    foreach($tokens as $token=>$lastname)
    {
      $t[$lastname][]=$token;
      $max=max($max, sizeof($t[$lastname]));
    }
    //print_r($t);
    
    for($i=sizeof($t);$i<32;$i++)
    {
      $t[$i]=array(); //we fill the missing positions (32 is 8x4 labels)
    }
    
    $nt=array();
    for($i=0;$i<$max;$i++)
    {
      foreach($t as $key=>$value)
      {
        if(array_key_exists($i, $value))
        {
          $nt[]=array('token'=>$value[$i], 'lastname'=>$key);
        }
        else
        {
          $nt[]=array('token'=>'', 'lastname'=>'');
        }
      }
    }

    foreach($nt as $v)
    {
      if($v['token']!='')
      {
        $pdf->AddLabel(
          $v['lastname'] . "\n\n" .
          $options['url'] . "\n" . 
          $this->context->getI18N()->__("token") .": " . $v['token']
          );
      }
      else
      {
        $pdf->AddLabel('');        
      }
    }
    
  }
  
  else
  {
    foreach($tokens as $token=>$lastname)
    {
      $pdf->AddLabel(
        $lastname . "\n\n" .
        $options['url'] . "\n" .
        $this->context->getI18N()->__("token") .": " . $token
        );
    }
  }
 
  // output
  $pathinfo=pathinfo($filename);
  $pdfname=substr($filename, 0, strlen($filename) - strlen($pathinfo['extension'])-1) . '.pdf';
  
  $pdf->Output($pdfname, 'F');

  $this->logSection('file+', $pdfname, null, 'INFO');

  }
  
}
