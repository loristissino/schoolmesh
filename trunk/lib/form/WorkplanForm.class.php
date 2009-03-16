<?php

/**
 * Workplan form.
 *
 * @package   schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class WorkplanForm extends BaseWorkplanForm
{
  public function configure()
  {
	
	unset(
		$this['sf_guard_user_id'],
		$this['created_at'],
		$this['updated_at'],
		$this['is_locked']
	);
  }
}
