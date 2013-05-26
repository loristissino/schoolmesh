<?php

/**
 * WpmoduleSyllabusItem class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class WpmoduleSyllabusItem extends BaseWpmoduleSyllabusItem {

  public function __toString()
  {
    return (string)$this->getId();
  }
  
  
  public function getSiblings()
  {
    //return $this->getId();
    $appointment_id = $this->getWpmodule()->getAppointmentId();
    $c=new Criteria();
		$c->addJoin(WpmodulePeer::ID, WpmoduleSyllabusItemPeer::WPMODULE_ID);
		$c->add(WpmoduleSyllabusItemPeer::SYLLABUS_ITEM_ID, $this->getSyllabusItemId());
		$c->add(WpmodulePeer::APPOINTMENT_ID, $appointment_id);
    $t = WpmoduleSyllabusItemPeer::doSelect($c);
		return $t;
    
    /*
     * 
     * SELECT * 
FROM  `wpmodule_syllabus_item` 
JOIN wpmodule ON wpmodule_syllabus_item.wpmodule_id = wpmodule.id
WHERE wpmodule_syllabus_item.syllabus_item_id =268
AND wpmodule.appointment_id =2917
* 
*/
    
  }

} // WpmoduleSyllabusItem
