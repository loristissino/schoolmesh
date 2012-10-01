<?php

class smTsvWriter extends smFileInfo
{

  private $separator;
  private $fp;
  private $filename;

  // this class assumes that the TSV file is correct.

  public function __construct($filename)
  {
    $this->filename = $filename;
  }
  
  public function writeLine($fields = array())
  {
    fwrite($this->fp, implode($this->separator, $fields) . "\n");
  }
  
  public function open()
  {
    $this->separator=chr(9);
    $this->fp = fopen($this->filename, 'w');
  }
  
  public function close()
  {
    fclose($this->fp);
  }

}
