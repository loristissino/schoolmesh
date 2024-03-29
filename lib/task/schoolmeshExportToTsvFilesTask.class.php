<?php

/**
 * schoolmeshExportToTsvFilesTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class schoolmeshExportToTsvFilesTask extends sfBaseTask
{
  
  protected function exportUsers($tsv)
  {
    
    $teacherRole=RolePeer::retrieveByPosixName(sfConfig::get('app_config_teachers_default_posix_group'));
    $studentRole=RolePeer::retrieveByPosixName(sfConfig::get('app_config_students_default_posix_group'));
    
    $tsv->open();
    
    $tsv->writeLine(array(
      'TYPE',
      'USERNAME',
      'FIRST_NAME',
      'MIDDLE_NAME',
      'LAST_NAME',
      'BIRTH_DATE',
      'BIRTH_PLACE',
      'USER_IMPORT_CODE',
      'GENDER',
      'EMAIL',
      'IS_ACTIVE',
      'EXTRASEARCHKEY',
      ));
    
    $c=new Criteria();
    $c->add(sfGuardUserPeer::CREATED_AT, $this->since, Criteria::GREATER_EQUAL);
    
    $profiles=sfGuardUserProfilePeer::retrieveAllSortedByLastName($c);
    foreach($profiles as $profile)
    {
      echo $profile->getUsername() . ' - ' . $profile->getFullName() . "\n";
      
      switch ($profile->getRoleId())
      {
        case $teacherRole->getId():
          $type='T';
          break;
        case $studentRole->getId():
          $type='S';
          break;
        default:
          $type='O';
      } 
      
      $tsv->writeLine(array(
        $type,
        $profile->getUsername(),
        $profile->getFirstName(),
        $profile->getMiddleName(),
        $profile->getLastName(),
        $profile->getBirthDate('Y-m-d'),
        $profile->getBirthPlace(),
        $profile->getImportCode(),
        $profile->getGender(),
        $profile->getValidatedEmail(),
        $profile->getIsActive() ? '1': '0',
        $type=='S'?$profile->getCurrentSchoolclassId():''
      ));
    }
    
    $tsv->close();
  }

  protected function exportPasswords($tsv)
  {
    $tsv->open();
    
    $tsv->writeLine(array(
      'USERNAME',
      'PASSWORD',
      ));
    
    $profiles=sfGuardUserProfilePeer::retrieveUsersWithStoredEncryptedPasswords();
    foreach($profiles as $profile)
    {
      echo $profile->getUsername() . ' - ' . $profile->getFullName() . "\n";
      
      $tsv->writeLine(array(
        $profile->getUsername(),
        base64_encode($profile->getStoredEncryptedPassword())
      ));
      
      // the encoding is not meant to be secure in any way...
      // the synchronization happens through ssh
      // this is just to protect the actual password from human eye
      
    }
    
    $tsv->close();
  }

  
  protected function configure()
  {

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      new sfCommandOption('since', null, sfCommandOption::PARAMETER_OPTIONAL, 'The date/time limit to use', '0'),
    ));
    
    $this->addArgument('type', sfCommandArgument::REQUIRED, 'The information type to export');
    $this->addArgument('file', sfCommandArgument::REQUIRED, 'The tsv file to write information to');

    $this->namespace        = 'schoolmesh';
    $this->name             = 'export-to-tsv-files';
    $this->briefDescription = 'Exports basic information from DB to a tab-separated-values files.';
    $this->detailedDescription = <<<EOF
This task will export information from the database to a TSV files
properly formatted.
The parameter 'since' can be set to a date or to a value parseable to a
date with strtotime function ('yesterday', '-1 month', etc.).
EOF;
  }


  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();
    
    try
    {
      $this->since=strtotime($options['since']);
    }
    catch (Exception $e)
    {
      throw new Exception('Not a valide date: ' . $options['since']);
    }

    $this->context = sfContext::createInstance($this->configuration);

    $this->con = Propel::getConnection(AppointmentPeer::DATABASE_NAME);
		$this->con->beginTransaction();

    $type=$arguments['type'];

    $tsvfile=$arguments['file'];
    
    if(file_exists($tsvfile))
    {
      throw new Exception('File already exists: ' . $tsvfile);
    }
    
    $validtypes=array('users', 'passwords');
    
    $tsv = new smTsvWriter($tsvfile);
    
    switch ($type)
    {
      case 'users':
        $count = $this->exportUsers($tsv);
        $this->logSection('file+', $tsvfile, null, 'NOTICE');
        break;
      case 'passwords':
        $count = $this->exportPasswords($tsv);
        $this->logSection('file+', $tsvfile, null, 'NOTICE');
        break;
      default:
        throw new Exception("Not a valid type specified. Should be one of the following:\n  -" . implode ("\n  -", $validtypes));
    }

  }

}
