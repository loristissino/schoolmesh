<?php

class TimeslotsContainer
{
  private $_config;
  private $_slots;
  private $_current;
  
  public function __construct($configfile)
  {
    $this->_config=sfYaml::load($configfile);
    $this->_slots=array();
    $nowU=date('U', time());
    $count=0;
    foreach($this->_config['timeslots'] as $period=>$slots)
    {
      foreach($slots as $slot)
      {
        list($h, $m)=explode(':', $slot['begin']);
        $beginU=date('U', mktime($h, $m));
        list($h, $m)=explode(':', $slot['end']);
        $endU=date('U', mktime($h, $m));
        $duration=$endU-$beginU;
        $state=($nowU>$endU) ? 'past' : ($nowU>$beginU ? 'current' : 'future');
        
        $this->_slots[]=array(
          'period'=>$period,
          'begin'=>$slot['begin'],
          'end'=>$slot['end'],
          'description'=>$slot['description'],
          'beginU'=>$beginU,
          'endU'=>$endU,
          'duration'=>$duration,
          'state'=>$state,
          'width'=>round($duration/150),
          );
    
        if($state=='current')
        {
          $this->_current=$count;
        }
        $count++;

      }
    }
  }
  
  public function getFormChoices()
  {
    $c=array();
    $count=0;
    foreach($this->_slots as $slot)
    {
      if($slot['state']=='current' or $slot['state']=='future')
      {
        $c[$slot['period']][$count]=$slot['description'];
      }
      $count++;
    }
    return $c;
  }
  
  public function setPlanningInfo(Workstation $Workstation)
  {
    $jobs=$Workstation->getJobs();
    $future=$Workstation->getIsEnabled()? 'on': 'off';
    $user=$Workstation->getUser();
    for($i=0; $i<sizeof($this->_slots); $i++)
    {
      if(is_array($jobs) and array_key_exists($this->_slots[$i]['begin'], $jobs))
      {
        $future=$jobs[$this->_slots[$i]['begin']]['status'];
        $user=$future=='on' ? $jobs[$this->_slots[$i]['begin']]['user'] : '';
      }
      $this->_slots[$i]['future']=$future;
      $this->_slots[$i]['user']= $i>=$this->_current ? $user : '';
    }
  }
  
  public function getPlannedStatus($slotnumber)
  {
    return $this->_slots[$slotnumber]['future'];
  }
  
  public function getPlannedUser($slotnumber)
  {
    return $this->_slots[$slotnumber]['user'];
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
  
  public function getSlotsNumber()
  {
    return sizeof($this->_slots);
  }
  
  public function getCurrentSlotBegin()
  {
    return $this->_slots[$this->_current]['begin'];
  }
  
  public function getCurrentSlotEnd()
  {
    return $this->_slots[$this->_current]['end'];
  }
  
}