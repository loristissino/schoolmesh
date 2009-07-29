<?php 
class Generic{
	
	
	public static function int_int_divide($x, $y) 
	
	{
    return ($x - ($x % $y)) / $y;
	}
	
	public static function datetime($date, $context=null)
		{
			
			$datebegin= self::int_int_divide($date, 86400)*86400;
			
			$difference = time() - $datebegin; 
//			return time() . ' - ' . $datebegin;
			
			if ($difference<86400)
				{
					$prefix='Today, ';
					if ($context)
						{
							$prefix=$context->getI18N()->__($prefix);
						}
					return $prefix . date('H:i', $date);
				}
				
			if ($difference < 172800)
				{
					$prefix='Yesterday, ';
					if ($context)
						{
							$prefix=$context->getI18N()->__($prefix);
						}
					return $prefix . date('H:i', $date);
				}

			return date('d/m/Y', $date);
		
		}
}