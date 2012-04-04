<?php

/**
 * WptoolItem form.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class WptoolItemForm extends BaseWptoolItemForm
{
  public function configure()
  {
    unset(
      $this['wptool_appointment_list']
      );

    $this['wptool_item_type_id']->getWidget()->setLabel('Group');      
    
    $this['wptool_item_type_id']->getWidget()
    ->setOption('method','getDescriptioWithGroup')
    ->setOption('add_empty', 'Choose a group')
    ;      
      
    $this['description']->getWidget()->setAttributes(array(
      'size'=>100
      ));

    $this['rank']->getWidget()->setAttributes(array(
      'size'=>5,
      'style'=>'text-align: right',
      ));
      
      
    
  }
}
