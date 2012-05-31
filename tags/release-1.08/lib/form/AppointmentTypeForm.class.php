<?php

/**
 * AppointmentType form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
class AppointmentTypeForm extends BaseAppointmentTypeForm
{
  public function configure()
  {
    
    $this['has_info']->getWidget()->setLabel('Info?');
    $this['has_modules']->getWidget()->setLabel('Modules?');
    $this['has_tools']->getWidget()->setLabel('Tools?');
    $this['has_attachments']->getWidget()->setLabel('Attachments?');
    
  }
}
