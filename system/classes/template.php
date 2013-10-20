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
 * Класс для работы с шаблонами
 * 
 */
class Template {
    
    private $vars = array();
    
    public function __set($name, $value) {
        $this->vars[$name] = $value;
    }
    
    public function __get($name) {
        if(isset($this->vars[$name])) {
            return $this->vars[$name];
        }
        return array();
    }
    
    public function __isset($name) {
        if(isset($this->vars[$name]) && !empty($this->vars[$name])) {
            return true;
        }
        return false;
    }
    
    public function assign($name, $value) {
        if(isset($this->vars[$name]) && is_array($this->vars[$name])) {
            $this->vars[$name] = array_merge($this->vars[$name], (array)$value);
        }
        else {
            $this->vars[$name] = $value;
        }
    }

    public function execute($path) {
        ob_start();
        include $path;
        $code = ob_get_contents();
        ob_end_clean();
        return $code;
    }
    
}

