<?php

require 'lib/model/om/BaseWfevent.php';


/**
 * Skeleton subclass for representing a row from the 'wfevent' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Wfevent extends BaseWfevent {
  
  public function getBaseObject()
  {
    $class=WfeventPeer::getBaseClass($this->getBaseTable());
    $peer=$class. 'Peer';
    return $peer::retrieveByPK($this->getBaseId());
  }
  
  public function modifyWfevent($userId, $date, $comment, $state, $update_state=false)
	{
		$result=Array();
		
		try
		{
			$this
			->setUserId($userId)
			->setCreatedAt($date)
			->setComment($comment)
			->setState($state)
			->save();
			
			if ($update_state)
			{
        $this->getBaseObject()->updateStateRecursively($state);
			}
			
			$result['result']='notice';
			$result['message']='The event was successfully saved.';
			
		}
		catch (Exception $exception)
		{
			$result['result']='error';
			$result['message']='The event could not be saved.';
		}
		
		return $result;
		
	}

} // Wfevent
