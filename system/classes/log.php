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
 * Класс для работы с исключениями
 * 
 */
class Log {
    	private $log_dump;
        private static $instance;
	
	private function __construct() {
		$this->log_dump=array();
	}
        
        public static function ini() {
            if (empty( self::$instance )) {
                self::$instance = new Log();
            }
            return self::$instance;
        }
	
	public function union(array $new_err) {
		$this->log_dump=Functions::arr_union($this->log_dump,$new_err);
	}
	
	public function add($new_err,$key='global') {
		if(!array_key_exists($key,$this->log_dump)) {
			$this->union(array($key=>array()));
		}
		array_push($this->log_dump[$key],$new_err);
	}
	
	public function get($key='global') {
		if(array_key_exists($key,$this->log_dump)) {
			return $this->log_dump[$key];
		}
		else {
			return array();
		}
	}
	
	public function get_all() {
		return $this->log_dump;
	}
        
        public function delete($key='global') {
		if(array_key_exists($key,$this->log_dump)) {
			unset($this->log_dump[$key]);
		}
	}
	
	public function reload($last_key,$key='global') {
                if($last_key!=$key) {
                    $err_arr=$this->get($last_key);
                    for($i=0;$i<count($err_arr);$i++) {
                            $this->add($err_arr[$i],$key);
                    }
                    $this->delete($last_key);
                }
	}
        
        public function count($key='global') {
                return count($this->get($key));
        }
        
        public function no_entries($key='global') {
                if($this->count($key)>0) {
                    return false;
                }
                else {
                    return true;
                }
        }
        
        private function __clone() {}
        private function __wakeup() {}
}

