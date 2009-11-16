<?php

class OdfDocCommandFailureException extends Exception
{}

class OdfDocTemplateException extends Exception
{}

class OdfDocFiletypeException extends Exception
{}

class OdfDocConversionException extends Exception
{}

class OdfDocConverterNotActiveException extends Exception
{}

class OdfDocPeer
{
	
	const UNOCONV_PORT=2002;
	const UNOCONV_USER='loris';
	const UNOCONV_DISPLAY=':0.0';
	
	static public function executeCommand($command)
	{
		$result=array();
		
		exec($command, $result, $return_var);

		if ($return_var!=0)
		{
			throw new OdfDocCommandFailureException('Could not execute command '. $command . ' (got: '. serialize($result) . ')');
		}
		
		return $result;
	}
	
	
	static public function getIsUnoconvActive()
	{
		$command = 'pgrep -f "^soffice.bin.*accept=socket"';

		try
		{
			$result=self::executeCommand($command);
		}
		catch (Exception $e)
		{
			return false;
		}
		
		return true;
		
	}
	
	static public function startUnoconv()
	{
		$command='/tmp/provacazzuta';
		$result=implode("\n", self::executeCommand($command));
		return $result;
	}
	
	
}