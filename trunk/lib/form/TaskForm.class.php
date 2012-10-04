<?php

/**
 * Task form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 */
class TaskForm extends BaseForm
{
  public function configure()
  {
    $task= $this->options['task'];
    
    $widgets=array();
    $validators=array();
    
    if(is_array($task['options']))
    {
      foreach($task['options'] as $key=>$value)
      {
        $widgets[$key.'_']=new sfWidgetFormInputText(array('default'=>$value, 'label'=>'--'.$key.'='), array('size'=>10));
        $validators[$key.'_']=new sfValidatorRegex(array('required'=>false, 'trim'=>true, 'pattern'=>'/[";\']/', 'must_match'=>false));
      }
    }
    if(is_array($task['arguments']))
    {
      foreach($task['arguments'] as $key=>$value)
      {
        $widgets[$key]=new sfWidgetFormInputText(array('default'=>$value), array('size'=>30));
        $validators[$key]=new sfValidatorRegex(array('required'=>true, 'trim'=>true, 'pattern'=>'/[";\']/', 'must_match'=>false));
      }
    }
    $this->setWidgets($widgets);
    $this->setValidators($validators);
    
    $this->widgetSchema->setNameFormat('task[%s]');
  }
}
