<?php

class WpmoduleItem extends BaseWpmoduleItem
{
	
	public function __toString()
	{
			return $this->getContent();
		
	}
	
	public function getEvaluationText()
	{
			if($this->getEvaluation())
				return $this->getEvaluation();
			else
				return sfContext::getInstance()->getI18N()->__('not set');
		
	}
	
	public function getContent()
	{
			return chop(Generic::strip_tags_and_attributes(parent::getContent(), '<br><em><sup><sub>'));
	}
	
	public function getRawContent()
	{
			return parent::getContent();
	}
	
/*	public function getHTMLContent()
	{
			return html_entity_decode($this->getContent());
	}
	*/
	public function swapWith($item)
	{
	  $con = Propel::getConnection(WpmoduleItemPeer::DATABASE_NAME);
	  try
	  {
		$con->beginTransaction();
	 
		$rank = $this->getRank();  
		$this->setRank($item->getRank());
		$this->save();
		$item->setRank($rank);
		$item->save();
	 
		$con->commit();
	  }
	  catch (Exception $e)
	  {
		$con->rollback();
		throw $e;
	  }
	} 

	protected function updateWpmodule()
	
	{
		 $this->getWpitemGroup()->getWpmodule()->setUpdatedAt(time());
		 $this->getWpitemGroup()->getWpmodule()->save();

	}

	public function save(PropelPDO $con = null)
	{
	  // New records need to be initialized with rank = maxRank +1
	  
	  if(!$this->getId())
	  {
		$con = Propel::getConnection(WpmoduleItemPeer::DATABASE_NAME);
		try
		{
		  $con->beginTransaction();
	 
		  $this->setRank($this->getWpitemGroup()->countWpmoduleItems()+1);
		  if (($this->getContent()===NULL) || ($this->getContent()==''))
			{
				$this->setContent('---');
				$this->setIsEditable(true);
			}
		  parent::save();
		  $this->updateWpmodule();
	 
		  $con->commit();
		}
		catch (Exception $e)
		{
		  $con->rollback();
		  throw $e;
		}
	  }
	  else
	  {
		parent::save(); 
  	  $this->updateWpmodule();
	  }
	}  


	public function delete(PropelPDO $con = null)
	{  
	  $con = Propel::getConnection(WpmoduleItemPeer::DATABASE_NAME);
	  try
	  {

		$con->beginTransaction();

	   $this->updateWpmodule();
	   
		// decrease all the ranks of the page records of the same category with higher rank 
		$sql = 'UPDATE '.WpmoduleItemPeer::TABLE_NAME.' SET '.WpmoduleItemPeer::RANK.' = '.WpmoduleItemPeer::RANK.' - 1 WHERE '.WpmoduleItemPeer::RANK.' > '.$this->getRank() . ' AND ' . WpmoduleItemPeer::WPITEM_GROUP_ID .'='. $this->getWpitemGroupId();

		$con->query($sql);
		// delete the item
		parent::delete();
	 
		$con->commit();
		
		
	  }
	  catch (Exception $e)
	  {
		$con->rollback();
		throw $e;
	  }
	
	}
	
	
		public function getStudentsSituations($ids, $term_id)
	{
		
		$c = new Criteria();
		$c->add(StudentSituationPeer::WPMODULE_ITEM_ID, $this->getId());
		$c->add(StudentSituationPeer::TERM_ID, $term_id);

		$c->add(StudentSituationPeer::USER_ID, $ids, Criteria::IN);
		$c->addAscendingOrderByColumn(StudentSituationPeer::USER_ID);

		return StudentSituationPeer::doSelect($c);
		
	}

	public function getStudentsSituationsAsArray($ids, $term_id)
	{
		
		$sits=self::getStudentsSituations($ids, $term_id);

		$found=array();
		
		foreach($sits as $sit)
		{
			$found[]=$sit->getUserId();
		}

		return $found;
				
	}
	
	public function toggleStudent($student_id, $term_id)
	{
		
		//FIXME: Add check about the teacher doing the action...
				
		$c = new Criteria();
		$c->add(StudentSituationPeer::WPMODULE_ITEM_ID, $this->getId());
		$c->add(StudentSituationPeer::TERM_ID, $term_id);
		$c->add(StudentSituationPeer::USER_ID, $student_id);

		$studentSituation = StudentSituationPeer::doSelectOne($c);
		
		$error=false;
		
		if ($studentSituation)
		{
			try
			{
				$studentSituation->delete();
			}
			catch (Exception $e)
			{
				$error=true;
			}
		}
		else
		{
			try
			{
				$studentSituation = new StudentSituation();
				$studentSituation
				->setTermId($term_id)
				->setUserId($student_id)
				->setWpmoduleItemId($this->getId())
				->setEvaluation(1)
				->save();
			}
			catch (Exception $e)
			{
				$error=true;
			}
			
		}
		
	}
	
}
