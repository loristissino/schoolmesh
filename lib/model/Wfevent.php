<?php

/**
 * Wfevent class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
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
