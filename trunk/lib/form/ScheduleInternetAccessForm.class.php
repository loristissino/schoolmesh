<?php
class ScheduleInternetAccessForm extends BaseForm
{
  public function configure()
  {

    $this->tsc=$this->getOption('tsc');

    $choices=$this->tsc->getFormChoices();
    
    $this->setWidgets(array(
      'when' => new sfWidgetFormChoice(array(
      'multiple' => true,
      'expanded' => true,
      'choices' => $choices,
      'renderer_options' => array('template' => '<strong>%group%</strong> %options%'),
       ))
    ));

//    $this['when']->getWidget()->getRenderer()->setOption('separator','AAA');

    $this->widgetSchema->setNameFormat('info[%s]');
    
    $this->setValidators(array(
				'when' => new sfValidatorPass(), 
			));

  }
  
  public function setDefaultsFromCurrentSettings($Workstations)
  {
    $v=array_fill(0, $this->tsc->getSlotsNumber(), true);
    foreach($Workstations as $Workstation)
    {
      $this->tsc->setPlanningInfo($Workstation);
      
      for($i=0; $i<$this->tsc->getSlotsNumber(); $i++)
      {
        $v[$i]=$v[$i] && $this->tsc->getPlannedStatus($i)=='on';
      }
    }
    $n=array();
    foreach($v as $key=>$value)
    {
      if($value)
      {
        $n[]=$key;
      }
    }
    $this->setDefault('when', $n);
    
  }

}