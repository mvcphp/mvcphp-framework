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
 * Класс настройки карты маршрутизации
 * 
 */
class Main_Routing extends Routing {
    
    public function __construct() {
        $this->routing_map=
        array(
            'routing' => 
            array(
                'site' => 
                array (
                    array(
                            'index' => array()
                        ),
                    array(
                            '404' => array()
                        )
                ),
                'admin' =>
                array (
                    array(
                            'index' => array('index')
                        ),
                    array(
                            '404' => array()
                        )
                )
            )
        );
        $this->add_routing($this->routing_map);
    }
    
}

