<?php
class ToggleInternetAccessForm extends BaseForm
{
  public function configure()
  {

    $timetable=sfYaml::load($this->getOption('timetable'));

    $choices=array();
    foreach($timetable['timeslots'] as $gk=>$gv)
    {
      if(sizeof($gv)>0)
      {
        foreach($gv as $key=>$slot)
        {
          if($slot['end']!='14:10')  // just a test
          {
            $choices[$gk][$key]= $slot['description'];
          }
        }
      }
    }

    $this->setWidgets(array(
      'when' => new sfWidgetFormChoice(array(
      'multiple' => true,
      'expanded' => true,
      'choices' => $choices,
      'renderer_options' => array('template' => '<strong>%group%</strong> %options%'),
       ))
    ));

    $this['when']->getWidget()->getRenderer()->setOption('separator','AAA');

    $this->widgetSchema->setNameFormat('info[%s]');
			
			
  }

}