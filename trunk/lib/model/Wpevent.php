<?php

class Wpevent extends BaseWpevent
{
	
	public function modifyWpevent($userId, $date, $comment)
	{
		$result=Array();
		
		try
		{
			$this
			->setUserId($userId)
			->setCreatedAt($date)
			->setComment($comment)
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
