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
class DataBase_mysql extends DataBase {
    
    public function __construct($data) {
        parent::__construct($data);
        
        $this->db = mysql_connect($this->data['db_host'], $this->data['db_login'], $this->data['db_pass']);
        mysql_select_db($this->data['db_name'], $this->db);
        
        return $this->db;
    }
    
    public function set_charset_($charset='cp1251_koi8') {
        $this->execute("SET CHARACTER SET ".$charset);
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

