<?php

class smFileInfo extends SPLFileInfo
{
  
  // FIXME: This class should be used for folder items also...
  
  private $_deliveryName = '';
  
  public function getMimeType()
  {
    $info=array();
		$result=array();

    $command=sprintf('file --brief --mime -L "%s"', $this->getPathName());

    exec($command, $result, $return_var);

    return $result[0];
  }
  
  
  public function prepareDelivery(sfWebResponse $response)
  {
		$response->setHttpHeader('Pragma', '');
		$response->setHttpHeader('Cache-Control', '');
		$response->setHttpHeader('Content-Length', $this->getSize());
		$response->setHttpHeader('Content-Type', $this->getMimeType());
		$response->setHttpHeader('Content-Disposition', 'attachment; filename="' . html_entity_decode($this->getDeliveryName(), ENT_QUOTES, 'UTF-8') . '"');

		$tmpfile=fopen($this->getPathName(), 'r');

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
    return $this->_deliveryName=='' ? $this->getFilename() : $this->_deliveryName;
    
  }
  
}