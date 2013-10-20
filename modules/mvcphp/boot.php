<?php
/**
 * MVCPHP Framework
 * 
 * @copyright Copyright (c) 2013, Alexey Novitskiy
 * @author Alexey Novitskiy
 * @link http://mvcphp.ru/
 * 
 */

class Mvcphp_Routing extends Routing {
    
    public function __construct() {
        $this->routing_map=
        array(
            'routing' =>
            array(
                'site' => 
                array (
                    array(
                            'mvcphp' => array(':/')
                        )
                ),
                'admin' =>
                array (
                    array(
                            'mvcphp' => array(':/')
                        )
                )
            ) 
        );
        if(Settings::get('developer_mode')) {
            $this->add_routing($this->routing_map);
        }
    }

}

