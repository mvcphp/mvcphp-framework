<?php
/**
 * MVCPHP Framework
 * 
 * @copyright Copyright (c) 2013, Alexey Novitskiy
 * @author Alexey Novitskiy
 * @link http://mvcphp.ru/
 * 
 */

class Captcha_Routing extends Routing {
    
    public function __construct() {
        $this->routing_map=
        array(
            'routing' =>
            array(
                'site' => 
                array (
                    array(
                            'captcha' => array(':/')
                        )
                ),
                'admin' =>
                array (
                    array(
                            'captcha' => array(':/')
                        )
                )
            ) 
        );
        $this->add_routing($this->routing_map);
    }

}

