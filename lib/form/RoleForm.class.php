<?php

/**
 * Role form.
 *
 * @package    form
 * @subpackage role
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class RoleForm extends BaseRoleForm
{
  public function configure()
  {

      $this['male_description']->getWidget()->setAttributes(array('size'=>100)); 
      $this['female_description']->getWidget()->setAttributes(array('size'=>100)); 
    
  }
}
