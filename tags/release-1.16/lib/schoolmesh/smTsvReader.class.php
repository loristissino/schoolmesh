<?php

class smTsvReader extends smFileInfo
{

  private $separator;

  // this class assumes that the TSV file is correct.
  
  protected function explodeLine($line)
  {
    if(strpos($line, $this->separator))
    {
      $result=explode($this->separator, $line);
    }
    else
    {
      $result=array($line);
    }
    for($i=0; $i<sizeof($result); $i++)
    {
      $result[$i]=ltrim(rtrim($result[$i]));
    }
    return $result;
  }
  
  public function open()
  {
    $this->separator=chr(9);
    
    $this->lines=file($this->getRealPath());
    $headers=$this->lines[0];
    
    $this->fieldnames=$this->explodeLine($headers);
    
    $this->cursor=1;
  }
  
  public function fetchAssoc()
  {
    if(!isset($this->lines[$this->cursor]))
    {
      return false;
    }
    
    $line=$this->lines[$this->cursor];
    
    $values=$this->explodeLine($line);
    
    if(sizeof($values)>sizeof($this->fieldnames))
    {
      throw new Exception('Missing field names for line ' . $this->cursor);
    }
    
    $result=array();
    $count=0;
    foreach($this->fieldnames as $fieldname)
    {
      $result[$fieldname]=isset($values[$count])?$values[$count]:null;
      $count++;
    }
    $this->cursor++;
    
    return $result;
  }

}
