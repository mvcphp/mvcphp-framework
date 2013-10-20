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
 * Класс для работы с кэшированием
 * 
 */
class Cache {
    
    private $cchtype = array('file','memcache','memcached');

    public function __construct($type='file',$param=array()) {
        
        if(in_array($type, $this->cchtype)) {
            switch ($type) {
                case 'file':
                    return new Cache_File($param);
                break;
                case 'memcache':
                    return new Cache_Memcache($param);
                break;
                case 'memcached':
                    return new Cache_Memcached($param);
                break;
            }
        }
        else {
            //выводим ошибку, не верный тип
        }
    }
    
}

