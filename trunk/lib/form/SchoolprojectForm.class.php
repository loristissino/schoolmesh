<?php

/**
 * Schoolproject form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class SchoolprojectForm extends BaseSchoolprojectForm
{
  public function configure()
  {
	$this['title']->getWidget()->setAttribute('size', '80');
	$this['description']->getWidget()->setAttribute('size', '100');

	$this['user_id']->getWidget()->setOption('model', 'sfGuardUserProfile');
	$this['user_id']->getWidget()->setOption('peer_method', 'retrieveAllButStudents');
	$this['user_id']->getWidget()->setOption('add_empty', 'Choose a user');
	
	$this->widgetSchema->setLabel('proj_category_id', 'Category');
	$this->widgetSchema->setLabel('user_id', 'Coordinator');
	
  }
}
