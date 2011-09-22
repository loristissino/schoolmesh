<?php

class TimeslotsContainer
{
  private $_config;
  private $_slots;
  
  public function __construct($configfile)
  {
    $this->_config=sfYaml::load($configfile);
    $this->_slots=array();
    foreach($this->_config['timeslots'] as $period=>$slots)
    {
      foreach($slots as $slot)
      {
        $this->_slots[]=array(
          'begin'=>$slot['begin'],
          'end'=>$slot['end'],
          'description'=>$slot['description'],
          'period'=>$period,
          );
      }
    }
  }
  
  public function getConfig()
  {
    return $this->_config;
  }
  
  public function getEleventhHour()
  {
    return $this->_slots[sizeof($this->_slots)-1]['end'];
  }
  
  public function getBeginning()
  {
    return $this->_slots[0]['begin'];
  }
  
  public function getSlots()
  {
    return $this->_slots;
  }
}