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
  
}