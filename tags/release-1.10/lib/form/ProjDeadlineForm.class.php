<?php

/**
 * ProjDeadline form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class ProjDeadlineForm extends BaseProjDeadlineForm
{
  public function configure()
  {
      
    $this->deadline=$this->getObject();
          
	unset($this['user_id'], $this['schoolproject_id'], $this['created_at'], $this['updated_at']);

	$this->widgetSchema['original_deadline_date'] = new sfWidgetFormI18nDate(array('culture'=>'it'));  
	$this->widgetSchema['current_deadline_date'] = new sfWidgetFormI18nDate(array('culture'=>'it'));  
	
	$this->validatorSchema['original_deadline_date'] = new sfValidatorDate(array('required'=>true));
	
	$this['description']->getWidget()->setAttribute('size', '120');
	$this['notes']->getWidget()->setAttributes(array('cols'=>'80', 'rows'=>'10'));
/*
	$this['user_id']->getWidget()->setOption('model', 'sfGuardUserProfile');
	$this['user_id']->getWidget()->setOption('peer_method', 'retrieveAllButStudents');
	$this['user_id']->getWidget()->setOption('add_empty', 'Choose a user');
	
	$this->widgetSchema->setLabel('user_id', 'Task assignee');
*/
  }
  
  public function addStateDependentConfiguration($state, $options=Array())
  {
    switch($state)
    {
      case Workflow::PROJ_DRAFT:
        unset($this['current_deadline_date'], $this['completed']);
        $this['original_deadline_date']->getWidget()->setLabel('Deadline');
        break;
      case Workflow::PROJ_SUBMITTED:
        unset($this['original_deadline_date'], $this['description'], $this['notes'], $this['current_deadline_date'], $this['completed'], $this['needs_attachment']);
        break;
      case Workflow::PROJ_APPROVED:
        unset($this['original_deadline_date'], $this['description'], $this['needs_attachment']);
        break;
      case Workflow::PROJ_FINANCED:
        unset($this['original_deadline_date'], $this['description'], $this['needs_attachment']);
        break;
      case Workflow::PROJ_CONFIRMED:
        unset($this['original_deadline_date'], $this['description'], $this['needs_attachment']);
        break;
      case Workflow::PROJ_FINISHED:
        unset($this['original_deadline_date'], $this['description'], $this['notes'], $this['current_deadline_date'], $this['completed']);
        break;
      default:
        throw new Exception('The state ' . $state . ' is not defined');
    }

    if ($state>Workflow::PROJ_DRAFT)
    {
      if($options['needs_attachment']==true)
      {
        $this->widgetSchema['attachment'] = new sfWidgetFormInputFile();
        $this->validatorSchema['attachment'] = new sfValidatorFile(array('required'=>false));
        $this->validatorSchema->setPostValidator(new sfValidatorOr(array(
          new sfValidatorSchemaFilter('completed',
            new sfValidatorRegex(
              array('pattern' => '/1/', 'must_match'=>false),
              array('invalid' => 'For this deadline, the completion of the task needs a file documenting the results.'))
            ),
          new sfValidatorCallback(array('callback' => array($this,
'containsValidatedFile'))),
        )));
      }
    }

  }
  
  
  public function containsValidatedFile($validator, $values)
  {
    if($this->deadline->hasAttachmentFiles())
    {
        return $values;
    }
      
    // thanks to alex gilbert for the idea:
    // http://www.mail-archive.com/symfony-users@googlegroups.com/msg20341.html
    if (!$values['attachment'] instanceof sfValidatedFile)
    {
      $error = new sfValidatorError($validator, 'For this deadline, the completion of the task needs a file documenting the results.');
      throw new sfValidatorErrorSchema($validator, array('attachment' => $error));
    }

    return $values;
  }
    
}



