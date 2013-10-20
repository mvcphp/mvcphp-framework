<?php
/**
 * MVCPHP Framework
 * 
 * @copyright Copyright (c) 2013, Alexey Novitskiy
 * @author Alexey Novitskiy
 * @link http://mvcphp.ru/
 * 
 */
/*{!
class {!!controller!}_Routing extends Routing {
    
    public function __construct() {
        $this->routing_map=
        array(
            'routing' =>
            array(
                'site' => 
                array (
                    array(
                            '{!controller!}' => array('{!action!}')
                        )
                ),
                'admin' =>
                array (
                    array(
                            '{!controller!}' => array('{!action!}')
                        )
                )
            ) 
        );
        $this->add_routing($this->routing_map);
    }

}
!}*\
