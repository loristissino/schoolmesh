<?php

/**
 * schoolmeshCheckAttachmentsTask class.
 *
 * @package    schoolmesh
 * @subpackage lib.task
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class schoolmeshCheckAttachmentsTask extends sfBaseTask
{
  protected function configure()
  {

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here

    ));

    $this->namespace        = 'schoolmesh';
    $this->name             = 'check-attachments';
    $this->briefDescription = 'Check existance and md5 of attachments';
    $this->detailedDescription = <<<EOF
This task checks whether the attachments are correctly stored.
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    $AttachmentFiles = AttachmentFilePeer::doSelect(new Criteria());
    
    $ok=0;
    $failed=0;
    
    foreach($AttachmentFiles as $AttachmentFile)
    {
      $md5=md5_file($AttachmentFile->getFilename());
      if($md5==$AttachmentFile->getMd5sum())
      {
        $this->logSection('attachment ' . $AttachmentFile->getId(), $AttachmentFile->getOriginalFileName(), null, 'INFO');
        $ok++;
      }
      else
      {
        $this->logSection('attachment ' . $AttachmentFile->getId(), $AttachmentFile->getOriginalFileName(), null, 'ERROR');
        echo sprintf("Got %s, expected %s\n", $md5, $AttachmentFile->getMd5sum());
        $failed++;
      }
    }
    if($failed)
    {
      $this->logSection('errors', sprintf('%d attachment(s) are invalid.', $failed), null, 'ERROR');
    }

  } // execute function

}  // class
