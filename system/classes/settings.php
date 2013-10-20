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
 * Класс настроек системы
 * 
 */

class Settings {
    
    private static $set;

    private static function ini() {
        self::$set = array(
            'language' => 'ru',
            'template_dir' => 'default',
            'admin_template_dir' => 'default',
            'developer_mode'=>false
        );
        
        //self::$set['language']='ru';
        
        new Config();
        
    }
    
    public static function add($param) {
        //инициализация параметров по умолчанию
        if(empty(self::$set)) {
            self::ini();
        }
        
        if(is_array($param)) {
            self::$set=Functions::arr_union(self::$set, $param);
        }
        else {
            self::$set[]=$param;
        }
        
    }

    public static function get($param) {
        //инициализация параметров по умолчанию
        if(empty(self::$set)) {
            self::ini();
        }
        
        if(!empty(self::$set[$param])) {
            return self::$set[$param];
        }
        return '';
    }
}

