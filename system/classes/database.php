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
 * Класс для работы с базой данных
 * 
 */
class DataBase {
    private static $db;
    private $dbtype = array('pdo','mysqli','mysql','sqlite','postgresql','mssql','oracledb');
    private $data;

    private function __construct() {
        $this->data = Settings::get('db');
        
        if(in_array($this->data['db_driver'], $this->dbtype)) {
            switch ($this->data['db_driver']) {
                case 'pdo':
                    self::$db = new DataBase_pdo($this->data);
                break;
                case 'mysqli':
                    self::$db = new DataBase_mysqli($this->data);
                break;
                case 'mysql':
                    self::$db = new DataBase_mysql($this->data);
                break;
                case 'sqlite':
                    self::$db = new DataBase_sqlite($this->data);
                break;
                case 'postgresql':
                    self::$db = new DataBase_postgresql($this->data);
                break;
                case 'mssql':
                    self::$db = new DataBase_mssql($this->data);
                break;
                case 'oracledb':
                    self::$db = new DataBase_oracledb($this->data);
                break;
            }
        }
        else {
            //выводим ошибку, не верный тип базы
        }
    }
    
    public static function ini() {
        if (empty(self::$db)) {
            new DataBase();
        }
        return self::$db;
    }
    
    private function __clone() {}
    private function __wakeup() {}
}

