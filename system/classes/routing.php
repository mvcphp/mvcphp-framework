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
 * Класс добавления карты маршрутизации в settings
 * 
 */
class Routing {
    
    protected $routing_map;
    
    public function __construct() {
        
    }
    
    protected function add_routing(array $new_routing_map) {
        $routing=Settings::get('routing');
        if(!empty($routing)) {
            $new_map=array();
            foreach ($routing as $key => $value) {
                $new_map[$key]=$value;
                foreach ($new_routing_map['routing'] as $nkey => $nvalue) {
                    if($nkey===$key) {
                        foreach ($nvalue as $n_value) {
                            $new_map[$key][]=$n_value;
                        }
                    }
                }
            }
            Settings::add(array('routing' => $new_map));
        }
        else {
            Settings::add($this->routing_map);
        }
    }
    
}

