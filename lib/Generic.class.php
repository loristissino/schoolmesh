<?php 
class Generic{
	
	
	public static function return_bytes($val)
	{
		$val = trim($val);
		$last = strtolower($val[strlen($val)-1]);
		switch($last) {
			// The 'G' modifier is available since PHP 5.1.0
			case 'g':
				$val *= 1024;
			case 'm':
				$val *= 1024;
			case 'k':
				$val *= 1024;
    }

    return $val;
	}
	
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
			
			if ($date===null)
			{
				return null;
			}
			
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
		  foreach(array(
			'Đ'=>'Dj',
			'ø'=>'o',
			'Ø'=>'O',
			'ü'=>'ue',
			'å'=>'aa',
			) as $key=>$value)
		  {
			$text=str_replace($key, $value, $text);
		  }

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
		
		
	static public function strtolower_utf8($string)
	{
		  $convert_to = array(
			"a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
			"v", "w", "x", "y", "z", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï",
			"ð", "ñ", "ò", "ó", "ô", "õ", "ö", "ø", "ù", "ú", "û", "ü", "ý", "а", "б", "в", "г", "д", "е", "ё", "ж",
			"з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы",
			"ь", "э", "ю", "я"
		  );
		  $convert_from = array(
			"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
			"V", "W", "X", "Y", "Z", "À", "Á", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ï",
			"Ð", "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "Ý", "А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж",
			"З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ъ",
			"Ь", "Э", "Ю", "Я"
		  );

		  return str_replace($convert_from, $convert_to, $string); 
		
		}
		
		static public function transform_bad_diacritics($culture, $text)
		{
			switch($culture)
			{
				case 'it':
					$text=str_replace(array('’', '`'), "'", $text);
				    foreach(array(
						"a'"=>'à',
						"e'"=>'é',
						"i'"=>'ì',
						"o'"=>'ò',
						"u'"=>'ù',
						"A'"=>'À',
						"E'"=>'É',
						"I'"=>'Ì',
						"O'"=>'Ò',
						"U'"=>'Ù',
						) as $key=>$value)
					{
						$text=str_replace($key, $value, $text);
					}
				
					break;
				
				default:
					throw new Exception('invalid culture');
				
			}
			
			return $text;
		}

		static public function clever_ucwords($culture, $text)
		{
			$text = ucwords(Generic::strtolower_utf8(Generic::transform_bad_diacritics($culture, $text)));
			$text=preg_replace_callback("/'[aeiou]/", create_function('$matches', 'return strtoupper($matches[0]);'), $text);
			return $text;
		}
		
		static public function executeCommand($command, $withSudo=true)
		{
			$info=array();
			$result=array();
			$return_var=0;
			
			$command=($withSudo? 'sudo ':'') . 'schoolmesh_' . $command;
			
			exec($command, $result, $return_var);
			
			foreach($result as $line)
			{
				if (strpos($line, '='))
				{
					list($key, $value)=explode('=', $line);
					$info[$key]=$value;
				}
			}
			return $info;
		}
		
	
	}