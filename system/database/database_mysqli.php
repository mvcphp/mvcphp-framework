<?php
/**
 * MVCPHP Framework
 * 
 * @copyright Copyright (c) 2013, Alexey Novitskiy
 * @author Alexey Novitskiy
 * @link http://mvcphp.ru/
 * 
 */
use mvcphp\system\database\DataBase;
/**
 * Класс для работы с базой данных
 * 
 */
class DataBase_mysqli extends DataBase {
    
    public function __construct($data) {
        parent::__construct($data);
        
        if(!empty($this->data['db_port'])) {
            $this->db = new mysqli($this->data['db_host'], $this->data['db_login'], $this->data['db_pass'], $this->data['db_name'], $this->data['db_port']);
        }
        else {
            $this->db = new mysqli($this->data['db_host'], $this->data['db_login'], $this->data['db_pass'], $this->data['db_name']);
        }
        
        return $this->db;
    }
    
    public function set_charset_($charset='cp1251_koi8') {
        
    }
    
    public function fetch_array_all_($query,$param='') {
        
    }
    
    public function fetch_array_($obj,$param='') {
        
    }
    
    public function fetch_object_($obj) {
        
    }
    
    public function execute_($query,$param='') {
        
    }
    
    public function query_($query) {
        
    }
    
    public function quote_($string) {
        
    }
    
}

