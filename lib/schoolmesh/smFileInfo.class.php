<?php

/**
 * smFileInfo class.
 *
 * @package    schoolmesh
 * @subpackage lib.schoolmesh
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class smFileInfo extends SPLFileInfo
{
  
  // FIXME: This class should be used for folder items also...
  
  private $_deliveryName = '';
  
  private $_stat;
  private $_size;
  private $_perms;
  
  public function getMimeType()
  {
    $info=array();
		$result=array();

    $command=sprintf('file --brief --mime -L "%s"', $this->getPathName());

    exec($command, $result, $return_var);
    
    if(strpos($result[0], ';'))
    {
      // sometimes we get results like 'application/pdf; charset=binary'
      list($main, $spec)=explode(';', $result[0]);
      return $main;
    }
    return $result[0];
  }
  
  public function getMD5Sum()
  {
    return md5_file($this->getPathName());
  }
  
  public function getUsedPathname()
  {
    if ($this->isLink())
    {
      return $this->getRealPath();
    }
    else
    {
      return $this->getPathname();
    }
  }
  
  public function getCorrectedPathname()
  {
    $name =  str_replace(
      array("&#039;", ' ', "&quot;"), 
      array("\\'", '\ ', '\"'), 
      $this->getUsedPathname()
    );
    
    return $name;
  }
  
  public function getPathnameToOpen()
  {
    $name =  str_replace(
      array("&#039;", "&quot;"), 
      array("'", '"'), 
      $this->getUsedPathname()
    );
    
    return $name;
  }
  
  public function getStats()
  {
    if ($this->_stat)
    {
      return; //they are cached
    }
    else
    {
      $result = array();
      $command='stat -c "%s:%a" ' . $this->getCorrectedPathname();

      // the replacements are needed because of filenames having quotes inside...
      
      exec($command, $result, $return_var);
      list($this->_size, $this->_perms) = explode(':', $result[0]);
      

    }
  }
  
  
  public function prepareDelivery(sfWebResponse $response)
  {
		$response->setHttpHeader('Pragma', '');
		$response->setHttpHeader('Cache-Control', '');
		$response->setHttpHeader('Content-Length', $this->getSize());
		$response->setHttpHeader('Content-Type', $this->getMimeType());
		$response->setHttpHeader('Content-Disposition', 'attachment; filename="' . html_entity_decode($this->getDeliveryName(), ENT_QUOTES, 'UTF-8') . '"');


    $filename=$this->getPathnameToOpen();
    
		$tmpfile=fopen($filename, 'r');

		$response->setContent(fread($tmpfile, $this->getSize()));
    fclose($tmpfile);
  
  }
  
  
  public function setDeliveryName($name)
  {
    $this->_deliveryName = $name;
    return $this;
  }
  
  
  public function getDeliveryName()
  {
    
    $name=$this->_deliveryName=='' ? $this->getFilename() : $this->_deliveryName;
    
    return str_replace('&quot;', '', $name);
    
  }
  
  public function getSize()
  {
    /* the implementation in the SPLFileInfo class is buggy, because it does not
    support file names with quotes, on which cannot run stat
    */
    
    $this->getStats();
    return $this->_size;
 }
 
 
  public function isReadable()
  {
    /* the implementation in the SPLFileInfo class is buggy, because it does not
    support file names with quotes, on which cannot run stat
    */
    
		try
    {
      $tmpfile=@fopen($this->getPathnameToOpen(), 'r');
      if($tmpfile)
      {
        return true;
      }
    }
    catch(Exception $e)
    {
      return false;
    }
    
 }
 
 public function isStale()
 /* a file is considered stale if older than 2 minutes... */
 {
   return ((time() - $this->getCTime()) > 120);
  }

  
  
}
