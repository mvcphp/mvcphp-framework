<?php
/**
 * MVCPHP Framework
 * 
 * @copyright Copyright (c) 2013, Alexey Novitskiy
 * @author Alexey Novitskiy
 * @link http://mvcphp.ru/
 * 
 */

class Config {
    
    private $conf;
    
    public function __construct() {
        $this->conf=array(
            'db'=>array(
                'db_driver' => 'pdo',
                'db_host'=>'localhost',
                'db_port'=>'',
                'db_name'=>'mvcphp',
                'db_login'=>'root',
                'db_pass'=>'',
                'db_type'=>'mysql',
                'db_charset' => 'utf8'
            )//,
            //'developer_mode'=>true
        );
        Settings::add($this->conf);
    }

}

