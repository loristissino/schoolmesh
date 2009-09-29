<?php

class Wpevent extends BaseWpevent
{
	
	public function modifyWpevent($userId, $date, $comment, $state, $update_state=false)
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
				$this->getAppointment()->setState($state)->save();
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
	
}
