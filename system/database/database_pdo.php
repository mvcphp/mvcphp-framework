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
class DataBase_pdo extends DataBase {
    
    public function __construct($data) {
        parent::__construct($data);
        
        $this->data['db_port']=';port='.$this->data['db_port'];
        $this->data['db_charset']=';charset='.$this->data['db_charset'];
        if(!empty($this->data['db_port'])) {
            $this->db = new PDO($this->data['db_type'].':dbname='.$this->data['db_name'].';host='.$this->data['db_host'].$this->data['db_port'].$this->data['db_charset'], $this->data['db_login'], $this->data['db_pass']);
        }
        else {
            $this->db = new PDO($this->data['db_type'].':dbname='.$this->data['db_name'].';host='.$this->data['db_host'].$this->data['db_charset'], $this->data['db_login'], $this->data['db_pass']);
        }
        //print_r($this->fetch_array_all('SELECT * FROM `categories`;'));
        //return $this->db;
    }
    
    public function set_charset_($charset='cp1251_koi8') {
        
    }
    
    public function fetch_array_all_($query,$param='') {
        if($q=$this->query_($query)) {
            if($param!='') {
                return $q->fetchAll($param);
            }
            else {
                return $q->fetchAll();
            }
        }
        else {
            return false;
        }
    }
    
    public function fetch_array_($obj,$param='') {
        if(!is_object($obj)) {
            return false;
        }
            if($param!='') {
                return $obj->fetch($param);
            }
            else {
                return $obj->fetch();
            }
    }
    
    public function fetch_object_($obj) {
        if(!is_object($obj)) {
            return false;
        }
        return $obj->fetchObject();
    }
    
    public function execute_($query,$param='') {
        if($param!='') {
            return $this->prepare($query)->execute($param);
        }
        else {
            return $this->prepare($query)->execute();
        }
    }
    
    public function query_($query) {
        return $this->db->query($query);
    }
    
    public function quote_($string) {
        return $this->db->quote($string);
    }
    
}

