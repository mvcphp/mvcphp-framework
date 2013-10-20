<?php
/**
 * MVCPHP Framework
 * 
 * @copyright Copyright (c) 2013, Alexey Novitskiy
 * @author Alexey Novitskiy
 * @link http://mvcphp.ru/
 * 
 */

class Model {
    
    protected $db;
    public $tpl;
    
    public function __construct($tpl) {
        $this->tpl=$tpl;
        //$this->db=DataBase::ini();
    }
	
    //метод выборки данных по умолчанию
    public function get_data(array $parameters) {
        
    }
    
}

