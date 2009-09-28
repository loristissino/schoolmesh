<?php

class Wpevent extends BaseWpevent
{
	
	public function modifyWpevent($userId, $date, $comment, $state)
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
