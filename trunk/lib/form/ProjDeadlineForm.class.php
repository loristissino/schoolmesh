<?php

/**
 * ProjDeadline form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class ProjDeadlineForm extends BaseProjDeadlineForm
{
  public function configure()
  {
	unset($this['schoolproject_id'], $this['created_at'], $this['updated_at']);

	$this->widgetSchema['original_deadline_date'] = new sfWidgetFormI18nDate(array('culture'=>'it'));  
	$this->widgetSchema['current_deadline_date'] = new sfWidgetFormI18nDate(array('culture'=>'it'));  
	
	$this->validatorSchema['original_deadline_date'] = new sfValidatorDate(array('required'=>true));
	
	$this['description']->getWidget()->setAttribute('size', '80');

	$this['user_id']->getWidget()->setOption('model', 'sfGuardUserProfile');
	$this['user_id']->getWidget()->setOption('peer_method', 'retrieveAllButStudents');
	$this['user_id']->getWidget()->setOption('add_empty', 'Choose a user');
	
	$this->widgetSchema->setLabel('user_id', 'Task assignee');

	
  }
}
