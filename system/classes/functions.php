<?php
/**
 * MVCPHP Framework
 * 
 * @copyright Copyright (c) 2013, Alexey Novitskiy
 * @author Alexey Novitskiy
 * @link http://mvcphp.ru/
 * 
 */

/**
 * Класс функций
 * 
 */
class Functions {
	public static function getrealip() {
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else {
			$ip=$_SERVER['REMOTE_ADDR'];
		}
                //нужно обязательно экранировать, можно пронести sql иньекцию
		return $ip;
	}
	
	public static function getip() {
		return $_SERVER['REMOTE_ADDR'];
	}
	
	public static function getref() {
                if(isset($_SERVER['HTTP_REFERER'])) {
                    return $_SERVER['HTTP_REFERER'];
                }
                return '';
	}
	
	public static function getagent() {
                if(isset($_SERVER['HTTP_USER_AGENT'])) {
                    return $_SERVER['HTTP_USER_AGENT'];
                }
                return '';
	}
	
	public static function arr_union(array $def_arr,array $new_arr) {
		foreach($new_arr as $key => $value) {
			if(array_key_exists($key, $def_arr) && is_array($value)) {
				$def_arr[$key]=self::arr_union($def_arr[$key], $new_arr[$key]);
			}
			else {
				$def_arr[$key]=$value;
			}
		}
		return $def_arr;
	}
	
	public static function to_datetime($datetime,$format='d.m.Y H:i:s') {
            $val = explode(" ",$datetime);
            $date = explode("-",$val[0]);
            $time = explode(":",$val[1]);
            return date($format, mktime($time[0],$time[1],$time[2],$date[1],$date[2],$date[0]));
	}
        
        public static function url_arr($str) {
            $r_arr = array();
            $str = ltrim($str, '?');
            $q_arr = explode('&',$str);
            foreach($q_arr as $k => $v) {
                if(strpos($v, '=') !== false) {
                    list($var,$value) = explode('=',$v);
                    $r_arr[] = $var;
                    $r_arr[] = $value;//Вначале всегда идут наши переменные, просто потому что mod_rewrite срабатывает раньше
                }
            }
            return $r_arr;
        }
        
        public static function url_to_arr($str) {
            $r_arr = array();
            $str = ltrim($str, '?');
            $q_arr = explode('&',$str);
            foreach($q_arr as $k => $v){
                if(strpos($v, '=') !== false) {
                    list($var,$value) = explode('=',$v);
                    if(!isset($r_arr[$var])) {
                        $r_arr[$var] = $value;//Вначале всегда идут наши переменные, просто потому что mod_rewrite срабатывает раньше
                    }
                }
            }
            return $r_arr;
        }
        
        public static function find_dirs($dir) {
		$out=array();
		if(is_dir($dir)) {
			if($handle = opendir($dir)) {
				while(($file = readdir($handle)) !== false) {
					if($file != "." && $file != "..") {
						if(is_dir($dir.$file)) {
							$out[]=$file;
						}
					}
				}
				closedir($handle);
			}
		}
		return $out;
	}
	
	public static function find_files($dir) {
		$out=array();
		if(is_dir($dir)) {
			if($handle = opendir($dir)) {
				while(($file = readdir($handle)) !== false) {
					if($file != "." && $file != "..") {
						if(is_file($dir.$file)) {
							$out[]=$file;
						}
					}
				}
				closedir($handle);
			}
		}
		return $out;
	}
	
	public static function getextension($fn) {
		if(stripos($fn,'.')===0) {
			return '';
		}
		else {
			return '.'.end(explode('.', $fn));
		}
	}
	
	public static function randgen($num=15, $rst='1234567890abcdefghijklmnopqrstuvwxyz') {
		srand();
                $rgen='';
                for($i=0;$i<$num;$i++) {
                    $rgen.=$rst[rand(0,strlen($rst)-1)];
                }
		return $rgen;
	}
	
	public static function translit($str) {
		$tr = array(
		'А' => 'A','Б' => 'B','В' => 'V','Г' => 'G','Д' => 'D','Е' => 'E','Ё' => 'YO','Ж' => 'ZH','З' => 'Z','И' => 'I',
		'Й' => 'J','К' => 'K','Л' => 'L','М' => 'M','Н' => 'N','О' => 'O','П' => 'P','Р' => 'R','С' => 'S','Т' => 'T',
		'У' => 'U','Ф' => 'F','Х' => 'H','Ц' => 'C','Ч' => 'CH','Ш' => 'SH','Щ' => 'CSH','Ь' => '','Ы' => 'Y','Ъ' => '',
		'Э' => 'E','Ю' => 'YU','Я' => 'YA','а' => 'a','б' => 'b','в' => 'v','г' => 'g','д' => 'd','е' => 'e','ё' => 'yo',
		'ж' => 'zh','з' => 'z','и' => 'i','й' => 'j','к' => 'k','л' => 'l','м' => 'm','н' => 'n','о' => 'o','п' => 'p',
		'р' => 'r','с' => 's','т' => 't','у' => 'u','ф' => 'f','х' => 'h','ц' => 'c','ч' => 'ch','ш' => 'sh','щ' => 'csh',
		'ь' => '','ы' => 'y','ъ' => '','э' => 'e','ю' => 'yu','я' => 'ya','-' => '',' ' => '+','--' => '-','.' => '',
		',' => '',':' => '',';' => '','*' => '','&' => '','%' => '','=' => '','№' => '','#' => '','$' => '',
		'"' => '','\'' => '','\\' => '','|' => '','/' => '','?' => '','!' => '','`' => '','~' => '','{' => '',
		'}' => '','[' => '',']' => '','(' => '',')' => '','_' => '','^' => '','«' => '','»' => ''
		);
		$out = str_replace(array_keys($tr),array_values($tr),$str);
		//$out = strtr($str,$tr);
		return $out;
	}
        
        public static function htmsc($text) {
		return htmlspecialchars($text);
	}
        
        public static function htmss($text) {
		return stripslashes($text);
	}
        
        public static function html($text) {
		return htmlspecialchars(stripslashes($text));
	}
	
	public static function htmlbr($text) {
		return str_replace("\n","\n<br />",htmlspecialchars(stripslashes($text)));
	}
	
	public static function htmq($text) {
		return htmlspecialchars(stripslashes($text),ENT_QUOTES);
	}
	
	public static function htmqbr($text) {
		return str_replace("\n","\n<br />",htmlspecialchars(stripslashes($text),ENT_QUOTES));
	}
	
	public static function br($text) {
		return str_replace("\n","\n<br />",$text);
	}
	
	public static function cutstr($text, $num=0, $ch=' ') {
		if($num==0) {
			return $text;
		}
		$len = (mb_strlen($text) > $num) ? mb_strrpos(mb_substr($text, 0, $num, 'UTF-8'), $ch, 'UTF-8') : $num;
		$len = ($len > 0) ? $len : $num;
		$str_out = mb_substr($text, 0, $len, 'UTF-8');
		return (mb_strlen($text) > $num) ? $str_out.'...' : $str_out;
	}
        
        public static function cutword($text, $num=10, $ch=' ') {
		if($num==0) {
			return $text;
		}
		$words = split($ch, $text);
		if(count($words) > $num) {
			$text = join($ch, array_slice($words, 0, $num));
			$text = $text.'...';
		}
		return $text;
	}
        
        public static function del_bbcode($str) {
		//$str = preg_replace('/\[(.*?)\]/i', '', $str);
		$str = preg_replace ('/\[[^]]*\]/i', '', $str);
		return $str;
	}
        
        public static function del_rn($str) {
            $str=str_replace("\r","",$str);
            $str=str_replace("\n","",$str);
            return $str;
        }
	
	public static function cut_str($str, $num=250) {
		$str = self::del_bbcode($str);
		$str = self::cutstr($str, $num, ' ');
		return $str;
	}
        
        public static function arr_htmlbr($arr) {
            $r_arr=array();
            for($i=0;$i<count($arr);$i++) {
                if(is_array($arr[$i])) {
                    foreach($arr[$i] as $k=>$v) {
                        $r_arr[$i][$k]=self::htmlbr($v);
                    }
                }
            }
            return $r_arr;
        }
        
        public static function arr_html($arr) {
            $r_arr=array();
            for($i=0;$i<count($arr);$i++) {
                if(is_array($arr[$i])) {
                    foreach($arr[$i] as $k=>$v) {
                        $r_arr[$i][$k]=self::html($v);
                    }
                }
            }
            return $r_arr;
        }
        
        public static function int($int) {
            for($i=0;$i<strlen($int);$i++) {
                if(!is_numeric($int[$i])) {
                    return 0;
                }
            }
                return max(0, intval($int));
        }
        
        public static function mb_ucfirst($str, $enc='utf-8') {
            return mb_strtoupper(mb_substr($str, 0, 1, $enc), $enc).mb_substr($str, 1, mb_strlen($str,$enc)-mb_strlen(mb_substr($str, 0, 1, $enc),$enc), $enc);
        }
        
        public static function bot_detect() {
            $user_agent=self::getagent();
            $engines = array(
            array('Aport', 'Aport robot'),
            array('Google', 'Google'),
            array('msnbot', 'MSN'),
            array('Rambler', 'Rambler'),
            array('Yahoo', 'Yahoo'),
            array('AbachoBOT', 'AbachoBOT'),
            array('accoona', 'Accoona'),
            array('AcoiRobot', 'AcoiRobot'),
            array('ASPSeek', 'ASPSeek'),
            array('CrocCrawler', 'CrocCrawler'),
            array('Dumbot', 'Dumbot'),
            array('FAST-WebCrawler', 'FAST-WebCrawler'),
            array('GeonaBot', 'GeonaBot'),
            array('Gigabot', 'Gigabot'),
            array('Lycos', 'Lycos spider'),
            array('MSRBOT', 'MSRBOT'),
            array('Scooter', 'Altavista robot'),
            array('AltaVista', 'Altavista robot'),
            array('WebAlta', 'WebAlta'),
            array('IDBot', 'ID-Search Bot'),
            array('eStyle', 'eStyle Bot'),
            array('Mail.Ru', 'Mail.Ru Bot'),
            array('Scrubby', 'Scrubby robot'),
            array('Yandex', 'Yandex'),
            array('Mediapartners-Google', 'Mediapartners-Google (Adsense)'),
            array('Slurp', 'Hot Bot search'),
            array('WebCrawler', 'WebCrawler search'),
            array('ZyBorg', 'Wisenut search'),
            array('ia_archiver', 'Alexa search engine'),
            array('FAST', 'AllTheWeb'),
            array('YaDirectBot', 'Yandex Direct')
            );

            foreach($engines as $engine) {
                    if(strstr(strtolower($user_agent), strtolower($engine[0]))) {
                            return $engine[1];
                    }
            }

            return false;
        }
        
        public static function url_detect($text) {
            $filter="/((\) *|\. *|точка *)ru($|\/|\n|\r| )|".
                        "(\) *|\. *|точка *)net($|\/|\n|\r| )|".
                        "(\) *|\. *|точка *)рф($|\/|\n|\r| )|".
                        "(\) *|\. *|точка *)ру($|\/|\n|\r| )|".
                        "(\) *|\. *|точка *)com($|\/|\n|\r| )|".
                        "(\) *|\. *|точка *)tk($|\/|\n|\r| )|".
                        "(\) *|\. *|точка *)su($|\/|\n|\r| )|".
                        "(\) *|\. *|точка *)org($|\/|\n|\r| )|".
                        "(\) *|\. *|точка *)info($|\/|\n|\r| )|".
                        "(\) *|\. *|точка *)name($|\/|\n|\r| )|".
                        "(\) *|\. *|точка *)pro($|\/|\n|\r| )|".
                        "(\) *|\. *|точка *)biz($|\/|\n|\r| )|".
                        "(\) *|\. *|точка *)tv($|\/|\n|\r| )|".
                        "(\) *|\. *|точка *)ua($|\/|\n|\r| )|".
                        "(\) *|\. *|точка *)kz($|\/|\n|\r| )|".
                        "(\) *|\. *|точка *)am($|\/|\n|\r| )|".
                        "(\) *|\. *|точка *)mobi($|\/|\n|\r| )|".
                        "(\) *|\. *|точка *)me($|\/|\n|\r| )|".
                        "(\) *|\. *|точка *)us($|\/|\n|\r| ))/i";
            if (preg_match($filter, $text)) {
                return true;
            }
            return false;
        }
        
}

