<?php 

/**
 * Generic class.
 *
 * @package    schoolmesh
 * @subpackage lib.schoolmesh
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


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
	
  public static function getHumanReadableSize($bytes) 
  {
    if ($bytes < 1024)
    {
      return $bytes . ' B';
    }
    
    $bytes=(float)$bytes;
    $suffixes=array('B','KiB','MiB','GiB','TiB');
    $index=0;
    while($bytes>1024)
    {
      $index++;
      $bytes=$bytes/1024;
    }
    return number_format($bytes, 2) . ' '. $suffixes[$index];
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
			
			if (($difference<86400) && ($difference>0))
				{
					$prefix='Today, ';
					if ($context)
						{
							$prefix=$context->getI18N()->__($prefix);
						}
					return $prefix . date('H:i', $date);
				}
				
			if (($difference < 172800) && ($difference>0))
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
		
		public static function date_from_array($array)
		{
			if (@checkdate($array['month'], $array['day'], $array['year']))
				{
					return mktime(0,0,0, $array['month'], $array['day'], $array['year']);
				}
			else
				{
					return null;
				}
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
		
		static public function clever_date($culture, $value)
		{
			switch($culture)
			{
				case 'it':
					$format = '%d/%m/%Y';
					break;
				default:
					throw new Exception('invalid culture');
				}
			
				$info=strptime($value, $format);
				
				$date=($info['tm_year']+1900) . '-' . ($info['tm_mon']+1) . '-' . $info['tm_mday'];
				$date_object=date_create($date);
				return $date_object;
		}
		
		
		static public function strip_tags_and_attributes($str, $allowable_tags)
		{
//			$result=preg_replace('/\/U', '?P=tag', $str);
//			echo $str . ' ---> ' . $result . "\n";
			$str=strip_tags($str, $allowable_tags);
//			$str=preg_replace('/\<<tag>([a-z]*).*\>/U', '<P=tag>', $str); 
			$str=preg_replace('/\<([a-z]+)[^\>]*>/', '<\\1>', $str); 
			
			$str=str_replace(
				array(
					'<br>',
					'<hr>', 
				),
				array(
					'<br />', 
					'<hr />'
				), $str);  //this uniforms stand-alone elements 
			return ltrim(rtrim($str));
		}
		
		static public function executeCommand($command, $sudoUser=false)
		{
			$info=array();
			$result=array();
			$return_var=0;
			
			$command='LANG=it_IT.utf-8; ' . ($sudoUser? 'sudo -u ' . $sudoUser . ' ' :'') . 'schoolmesh_' . $command;
			// FIXME: this is needed, but it should be more general than it_IT.utf8

      Generic::logMessage('execution', $command);
			
			exec($command, $result, $return_var);

			if ($return_var!=0)
			{
				throw new Exception('Could not execute command '. $command . ' (got: '. serialize($result) . ')');
			}

			foreach($result as $line)
			{
				$pos=strpos($line, '=');
				if ($pos)
				{
					$key=substr($line, 0, $pos);
					$value=substr($line, $pos+1);
					$info[$key]=$value;
				}
			}
			
      Generic::logMessage('result', $result);
      Generic::logMessage('info', $info);

			return $info;
		}
		
		
		
	public static function b64_serialize($var)
	{
		return str_replace('/', '_', base64_encode(serialize($var)));
	}
		
	public static function b64_unserialize($var)
	{
		$text=base64_decode(str_replace('_', '/', $var));
		return unserialize(base64_decode(str_replace('_', '/', $var)));
	}
  
  // updates Objects (fields $fields) when in array $params
  public static function updateObjectFromForm($object, $fields, $params)
  {
    $changedfields=array();
    // we need to check which fields are present
    foreach($fields as $field)
    {
      if (array_key_exists($field, $params))
      {
        if($object->getByName($field, BasePeer::TYPE_FIELDNAME)!=$params[$field])
        {
          $object->setByName($field, $params[$field], BasePeer::TYPE_FIELDNAME);
          $changedfields[]=$field;
        }
      }
    }
    return $changedfields;
  }


  public static function addWfevent($object, $userId, $comment='', $i18n_subs=array(), $state=0, $sf_context=null, $con=null)
  {
		$wfevent = new Wfevent();
		$wfevent
    ->setUserId($userId)
    ->setBaseId($object->getId())
    ->setBaseTable(WfeventPeer::getBaseTableId(get_class($object)))
    ;
		if ($sf_context)
    {
      $comment=$sf_context->getI18N()->__($comment, $i18n_subs);
    }
		$wfevent->setComment($comment);
    if($state)
    {
      $wfevent->setState($state); //if it is not specified, we keep the same
    }
    
    $wfevent->save($con);
    
  }

  public static function correctString($s)
  {
    return str_replace(
      array(
        '&#039;',
        '&quot;',
      ),
      array(
        "'",
        '"',
      ),
      $s);
  }
  
  public static function sanitizeString($s)
  {
    return str_replace(
      array(
        '&#039;',
      ),
      array(
        "",
      ),
      $s);
  }

  
  public static function currentDate()
  {
    return mktime(18,0,0, date('n'), date('j')+1, date('Y'));
  }


  public static function getValidatedFile($filepath, $name='')
  {
    $file=new smFileInfo($filepath);
    
    $original_name= $name=='' ? $file->getFileName(): $name;
    
    $mimetype=$file->getMimeType();
    if (strpos($mimetype, ';')>0)
    {
      list($mimetype, $extra)=explode(';', $mimetype);
    }

    $vfile = new sfValidatedFile(
      $original_name,
      $mimetype,
      $file->getPathName(), 
      $file->getSize(), 
      $file->getPathName());

    return $vfile;
  }
  
  
  public static function timefromdate($date)
  {
    $year=substr($date,0,4);
    $month=substr($date,4,2);
      $day=substr($date,6,2);
    
    return mktime(0,0,0,$month, $day, $year);
  }
  
  public static function getBaseUrl()
  {
    // return the URL depending on the fact that the request is coming from inside
    // or outside the LAN
    if (self::netMatch(sfConfig::get('app_config_local_addresses'), $_SERVER['REMOTE_ADDR']))
    {
      return sfConfig::get('app_config_lan_url');
    }
    else
    {
      return sfConfig::get('app_config_wan_url');
    }
  }


  public static function netMatch ($CIDR,$IP)
  {
    list ($net, $mask) = explode ('/', $CIDR);
    $net=ip2long($net);
    $IP=ip2long($IP);
    $masked=$IP >> (32 - $mask) << (32 - $mask);
    /*
    print_r(array(
      'net'=>long2ip($net),
      'ip'=>long2ip($IP),
      'masked'=>long2ip($masked),
      ));
    */
    return ($net==$masked);
  }

  static public function getLuceneIndex($name)
  {
    ProjectConfiguration::registerZend();
   
    if (file_exists($index = self::getLuceneIndexFile($name)))
    {
      return Zend_Search_Lucene::open($index);
    }
   
    return Zend_Search_Lucene::create($index);
  }
  
  static public function getLuceneIndexFile($name)
  {
    return sprintf('%s/%s.%s.index',
      sfConfig::get('app_lucene_directory'),
      $name,
      sfConfig::get('sf_environment')
      );
  }

  static public function logMessage($section, $content, $file='', $line='')
  {

		$debug=sfConfig::get('app_config_debug', false)==true;
    if (!$debug)
    {
      return;
    }

    ob_start();
    echo "\n--------- " . $section;
    if($line || $file)
    {
      echo "\n > " . $file . ' (line '. $line . ')';
    }
    echo "\n > " . date('H:i:s') . "\n";
    if($content)
    {
      print_r($content);
    }
    else
    {
      echo "[no content]";
    }
    
    echo "\n";
    $f=fopen(sfConfig::get('app_config_logfile', '/tmp/logschoolmesh.txt'), 'a');
    fwrite($f, ob_get_contents());
    fclose($f);
    ob_end_clean();
  }


  public static function generateUniqueToken($seed, $length)
  {
    static $generated;
    if (!isset($generated))
    {
      $generated=array();
    }
    
    $done=false;
    while(!$done)
    {
      $token=substr(md5($seed. rand(0, 1000000)), 0, $length);
      $done=!in_array($token, $generated);
    }

    $generated[]=$token;
    
    return $token;
  }

  public static function addtime($timestamp, $mu, $quantity)
  {
    switch($mu)
    {
      case 'h':
      case 'hours':
      case 'hrs':
      case 'H':
        $seconds=$quantity*60*60;
        break;
      case 'm':
      case 'minutes':
      case 'mins':
      case 'M':
        $seconds=$quantity*60;
        break;
      case 's':
      case 'seconds':
      case 'secs':
      case 'S':
        $seconds=$quantity;
        break;
      default:
        $seconds=0;
    }
    return $timestamp+$seconds;
  }

  public static function getNumbersBetweenAsOptionsArray($min, $max)
  {
    foreach(range($min, $max) as $v)
			{
				$values[$v]=$v;
			}
    return $values;
  }

  public static function todayAtMidnight()
  {
    return mktime(0, 0, 0, date('n'), date('j'), date('Y'));
  }
  
  public static function getHoursAsNumber($value, $separator)
  {
    if(!strpos($value, $separator))
    {
      $h=(int)$value;
      if(is_int($h) and $h>0)
      {
        return $h;
      }
      return false;
    }
    
    
    $parts=explode($separator, $value);
    
    if(sizeof($parts)!=2)
    {
      return false;
    }
    
    list($hours, $minutes)=$parts;
    
    if(strlen($minutes)!=2)
    {
      return false;
    }
    
    $hours=(int)$hours;
    $minutes=(int)$minutes;
    if(!is_int($hours) or !is_int($minutes))
    {
      return false;
    }
    
    if(($minutes>59) or ($hours<0) or ($minutes<0))
    {
      return false;
    }
    
    return $hours+$minutes/60;
  }

  public static function getHoursAsString($value, $separator=':')
  {
    $h=floor($value);
    $m=round(($value-$h)*60);
    return sprintf('%d%s%02d', floor($value), $separator, $m);
  }


  public static function cloneDate($date, $baseref_date, $newref_date)
  {
    $years_offset=floor(($newref_date - $baseref_date)/(365*24*60*60));
    $d = getdate($date);
    return mktime(0, 0, 0, $d['mon'], $d['mday'], $d['year']+$years_offset);
  }

  public static function currencyvalue($value, $add_nbsp=true)
  {
    if ($value)
    {
      return 
        sfConfig::get('app_config_currency_symbol', '€') . ($add_nbsp?'&nbsp;':' ') .
        number_format($value, 
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
  
  public static function beginsWith($haystack, $needle)
  {
    return substr($haystack, 0, strlen($needle))==$needle;
  }

}
