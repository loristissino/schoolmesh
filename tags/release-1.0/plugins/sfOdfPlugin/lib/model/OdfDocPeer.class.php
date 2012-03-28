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
  
  static public function convertDocument($type, $source, $target)
  {
		$command=sprintf('unoconv  --port %d --stdout -f %s "%s" > "%s"', 
      OdfDocPeer::UNOCONV_PORT,
      $type, $source, $target);
		self::executeCommand($command);
  }
	
	static public function getIsUnoconvActive()
	{
		$command = 'pgrep -f "soffice.bin.*accept=socket"';

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
		$command='/tmp/trial';
		$result=implode("\n", self::executeCommand($command));
		return $result;
	}
	
  public static function quantityvalue($value, $mu='')
  // this is close to the one present in the helper
  {
    if($mu)
    {
      $mu=$mu . ' ';
    }
    
    if ($value)
    {
    return 
      $mu . number_format($value, 
        sfConfig::get('app_config_currency_decimals', 2), 
        sfConfig::get('app_config_currency_decpoint', ','),
        sfConfig::get('app_config_currency_thousandssep', '.')
        );
    }
    else
    {
      return '';
    }
  }
    
  
	
}
