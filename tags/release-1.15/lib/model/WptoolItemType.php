<?php

/**
 * WptoolItemType class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class WptoolItemType extends BaseWptoolItemType
{
	
	public function __toString()
	{
		return $this->getDescription();
	}
  
  public function getDescriptioWithGroup()
  {
    return sprintf('%s - %s', $this->getAppointmentType(), $this->getDescription());
  }
  
  public function getWptoolItems($criteria = null, PropelPDO $con = null)
  {
    $criteria=new Criteria();
    $criteria->addAscendingOrderByColumn(WptoolItemPeer::RANK);
    return parent::getWptoolItems($criteria, $con);
  }
  
  public function importItems($from)
  {
    $Source=WptoolItemTypePeer::retrieveByPK($from);
    if($Source)
    {
      $count=0;
      foreach($Source->getWptoolItems() as $SourceWptoolItem)
      {
        try
        {
          $WptoolItem=new WptoolItem();
          $WptoolItem
          ->setDescription($SourceWptoolItem->getDescription())
          ->setRank($SourceWptoolItem->getRank())
          ->setCode($SourceWptoolItem->getCode())
          ->setWptoolItemTypeId($this->getId())
          ->save()
          ;
          $count++;
        }
        catch (Exception $e)
        {
          // reserved
        }
      }
      return $this;
    }
    
    $criteria=new Criteria();
    $criteria->addAscendingOrderByColumn(WptoolItemPeer::RANK);
    return parent::getWptoolItems($criteria, $con);
  }
  
  
}
