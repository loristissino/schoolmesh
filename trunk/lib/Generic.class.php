<?php 
class Generic{
	
	
	public static function int_int_divide($x, $y) 
	
	{
    return ($x - ($x % $y)) / $y;
	}
	
	public static function decode($text)
	
	{
		$text=str_replace('&#039;', "'", $text);
		return html_entity_decode($text);
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
		
		public static function date_difference_from_now($string)
		{
			// return the number of days of difference from the date expressed as Ymd (20091231)
			
			return floor((time() - mktime(0, 0, 0, substr($string,4,2), substr($string,6,2), substr($string,0,4)))/86400);
		}
		
		static public function transliterate($text)
		{
		  $text = iconv("UTF-8", "US-ASCII//TRANSLIT", $text);
		  return $text;
		}

		static public function slugify($text)
		{
		  $text=self::transliterate($text);
		  $text = str_replace(' ', '', $text);
		  $text = strtolower(trim($text, '-'));
		return $text;  
		}


	}