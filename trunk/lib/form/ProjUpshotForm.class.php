<?php

/**
 * ProjUpshot form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
class ProjUpshotForm extends BaseProjUpshotForm
{
  public function configure()
  {
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
    for($i=$project->getEvaluationMin(); $i<=$project->getEvaluationMax(); $i++)
    {
      $choices[$i]=$i;
    }

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
