<?php
/**
 * MVCPHP Framework
 * 
 * @copyright Copyright (c) 2013, Alexey Novitskiy
 * @author Alexey Novitskiy
 * @link http://mvcphp.ru/
 * 
 */
namespace mvcphp\system\database;
/**
 * Класс для работы с базой данных
 * 
 */
abstract class DataBase {
    protected $db;
    protected $data;


    public function __construct($data) {
        $this->data = $data;
    }

    abstract public function set_charset_($charset='cp1251_koi8');
    abstract public function fetch_array_all_($query,$param='');
    abstract public function fetch_array_($obj,$param='');
    abstract public function fetch_object_($obj);
    abstract public function execute_($query,$param='');
    abstract public function query_($query);
    abstract public function quote_($string);
}

