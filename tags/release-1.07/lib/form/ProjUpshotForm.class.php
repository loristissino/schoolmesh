<?php

/**
 * ProjUpshot form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 */
class ProjUpshotForm extends BaseProjUpshotForm
{
  public function configure()
  {
    if(!$this->options['sf_context'])
    {
      throw new Exception('You must pass the context in the options array to use this form');
    }
    
    unset(
      $this['schoolproject_id']
      );
    
    $upshot=$this->getObject();
    $project=$upshot->getSchoolproject();

    
    $this->widgetSchema['scheduled_date'] = new sfWidgetFormI18nDate(array('culture'=>'it'));  
	  $this['description']->getWidget()->setAttribute('size', '120');
	  $this['indicator']->getWidget()->setAttribute('size', '80');
	  $this['upshot']->getWidget()->setAttribute('size', '80');
	  $this['evaluation']->getWidget()->setAttribute('size', '10');

    $choices=array(0=>'---');
    $choices[1]=$this->options['sf_context']->getI18N()->__('%value% -- negative upshot - the activity failed', array('%value%'=>1));
    for($i=$project->getEvaluationMin()+1; $i<$project->getEvaluationMax(); $i++)
    {
      $choices[$i]=$this->options['sf_context']->getI18N()->__('%value% -- intermediate result upshot with value %value%', array('%value%'=>$i));
    }
    $choices[$project->getEvaluationMax()]=$this->options['sf_context']->getI18N()->__('%value% -- really positive upshot - the activity completely succeeded', array('%value%'=>$project->getEvaluationMax()));
    $choices[-1]=$this->options['sf_context']->getI18N()->__('N/A -- not applicable (the activity has not been performed)');

    $this->widgetSchema['evaluation'] = new sfWidgetFormSelect(array(
      'choices'=>$choices
      ));

    switch ($project->getState())
    {
      case Workflow::PROJ_DRAFT:
        unset(
          $this['upshot'],
          $this['evaluation']
          );
        break;
      case Workflow::PROJ_SUBMITTED:
        unset(
          $this['upshot'],
          $this['evaluation'],
          $this['description'],
          $this['indicator'],
          $this['scheduled_date']
          );
        break;
      case Workflow::PROJ_APPROVED:
        unset(
          $this['description'],
          $this['indicator'],
          $this['scheduled_date']
          );
        break;
      case Workflow::PROJ_FINANCED:
        unset(
          $this['description'],
          $this['indicator'],
          $this['scheduled_date']
          );
        break;
        
    }





  }
}
