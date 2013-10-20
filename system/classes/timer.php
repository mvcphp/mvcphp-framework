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
 * Класс таймера
 * 
 */
class Timer {

    private $time_start;
    private $time_end;

    public function __construct() {
        $this->time_start = microtime(true);
    }

    public function settime() {
        $this->time_start = microtime(true);
    }

    public function gettime() {
        $this->time_end = microtime(true);
        return $this->time_end - $this->time_start;
    }

}

