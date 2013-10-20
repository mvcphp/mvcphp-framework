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
class DataBase_oracledb extends DataBase {
    
    public function __construct($data) {
        parent::__construct($data);
        
        $this->db = oci_connect($this->data['db_login'], $this->data['db_pass'], $this->data['db_host']);
        
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

