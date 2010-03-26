<?php

class smFileInfo extends SPLFileInfo
{
  
  // FIXME: This class should be used for folder items also...
  
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
		$response->setHttpHeader('Content-Disposition', 'attachment; filename="' . html_entity_decode($this->getFilename(), ENT_QUOTES, 'UTF-8') . '"');

		$tmpfile=fopen($this->getPathName(), 'r');

		$response->setContent(fread($tmpfile, $this->getSize()));
    fclose($tmpfile);
  
  }
  
}