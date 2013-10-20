<?php
/**
 * MVCPHP Framework
 * 
 * @copyright Copyright (c) 2013, Alexey Novitskiy
 * @author Alexey Novitskiy
 * @link http://mvcphp.ru/
 * 
 */
namespace mvcphp\system\cache;
/**
 * Класс для работы с кэшированием
 * 
 */
interface Cache {
    
    public function get();
    public function set();
    public function del();
    
}

