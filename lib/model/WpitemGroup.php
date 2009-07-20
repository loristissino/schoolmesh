<?php

class WpitemGroup extends BaseWpitemGroup
{
	public function __toString()
	{
	return $this->getId();	
	}
	
	public function getContent()
	{
		$items= $this->getWpmoduleItems();
		
		$text = '';
		foreach($items as $item)
			{
				$text .= $item->getContent() . '<br />';
			}

		return $text;
		
	}

	protected function deleteItems(PropelPDO $con = null)
	{  
	  $con = Propel::getConnection(WpitemGroupPeer::DATABASE_NAME);
	  try
	  {
		$con->beginTransaction();
	 
		$sql = 'DELETE FROM '.WpmoduleItemPeer::TABLE_NAME.' WHERE '.WpmoduleItemPeer::WPITEM_GROUP_ID.' = '.$this->getId();

		$con->query($sql);
	 
		$con->commit();
	  }
	  catch (Exception $e)
	  {
		$con->rollback();
		throw $e;
	  }
	
	}

	public function replaceItems($text)
	{
		$this->deleteItems();
		$text=chop(html_entity_decode(strip_tags(str_replace('</p>', '<br />',$text), '<br><em>')));

		$items=explode('<br />', $text);
		
		
		foreach($items as $item)
			{
				$item=ltrim(rtrim($item));
				if (!(($item=='')||($item==' ')||($item==chr(194).chr(160))))  // don't know why, but these chars are added up...
					{
						$wpmoduleItem = new WpmoduleItem();
						$wpmoduleItem->setWpitemGroupId($this->getId());
						$wpmoduleItem->setEvaluation(null);
						$wpmoduleItem->setContent($item);
						$wpmoduleItem->setIsEditable(true);
						$wpmoduleItem->save();
					}
				}
		$result['message']='The items have been replaced.';
		$result['result']='notice';





		return $result;
	}


	public function getWpmoduleItems($criteria = null, PropelPDO $con = null)
	{

	if (is_null($criteria))
		{
				$criteria=new Criteria();
		}
	else
		{
				$criteria = clone $criteria;
		}

		$criteria->addAscendingOrderByColumn(WpmoduleItemPeer::RANK);
		
		return parent::getWpmoduleItems($criteria, $con);
	}

		public function getUnevaluated()
	{
     $con = Propel::getConnection(WpmodulePeer::DATABASE_NAME);
	 
$sql = 'SELECT count( * ) AS number
FROM wpitem_group
JOIN wpmodule_item ON wpitem_group.id = wpmodule_item.wpitem_group_id
JOIN wpitem_type ON wpitem_group.wpitem_type_id = wpitem_type.id
WHERE wpitem_group.id = %d
AND wpmodule_item.evaluation IS NULL
AND wpitem_type.evaluation_max >0';

$sql = sprintf($sql, $this->getId());

$statement = $con->prepare($sql);
$statement->execute();

$resultset= $statement->fetch(PDO::FETCH_OBJ);

$number=$resultset->number;

	return $number;
	}

	
}
