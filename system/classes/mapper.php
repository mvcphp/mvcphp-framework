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
 * Класс для работы с картой маршрутизации
 * 
 */
class Mapper {
    
    /**
     * Функция генерации параметров маршрутизации
     * 
     * Находит имя контроллера и имя действия
     * Формирует параметры запроса
     * 
     * @retern array Возвращает массив параметров для роутера
     * 
     */
    public static function get_parameters(array $routing_map, array $routes, $controller_name, $action_name, $action_parameters) {
        
        
        $url_param=$routes;
        $action_parameters['/']='';
        
        if(strpos(end($routes), '?') !== false) {
            $q_routes=end($routes);
            $new_routes=Functions::url_arr(substr($q_routes,strpos($q_routes, '?')));
            array_pop($routes);
            $routes=array_merge($routes, $new_routes);
            //if(strpos($q_routes, '?') !== 0) {
                //$free_param = substr($q_routes,0,strpos($q_routes, '?'));
            //}
            //parse_url
            //http_build_query
        }
        
        //print_r($routes);exit;
        
        $action_exists = false;
        $controller_exists = false;
        
        $error_exists=true;
        
        
        //ищем совпадения в карте маршрутизации по контроллеру и действию и формируем массив параметров
        foreach ($routing_map as $routing_map_rout) {
            foreach ($routing_map_rout as $pattern_controller => $pattern_filter) {
                if (!empty($routes[0]) && strval($pattern_controller) == $routes[0]) {
                    $controller_name = $routes[0];
                    $controller_exists = true;
                    if($error_exists) {
                        $error_exists=false;
                    }
                        if($routes[0]!='404' && empty($routes[1])) {
                            $routes[1]='index';
                        }
                    //if (!empty($routes[1]) && !empty($pattern_filter[0]) && ($pattern_filter[0] == $routes[1] || ($routes[1] == 'index' && strpos($pattern_filter[0], ':') === 0))) {
                    if (!empty($routes[1]) && ((count($pattern_filter)==0 && $routes[1] == 'index') || (!empty($pattern_filter[0]) && ($pattern_filter[0] == $routes[1] || ($routes[1] == 'index' && strpos($pattern_filter[0], ':') === 0))))) {
                        $action_name = $routes[1];
                        $action_exists = true;
                        
                                array_shift($routes);
                                array_shift($routes);
                                $routes_param=array();
                                $routes_value=array();
                                
                                if(count($routes)>0 && $routes[0]=='') {
                                    array_shift($routes);
                                }
                                
                                if(is_array($url_param) && count($url_param)>2) {
                                    array_shift($url_param);
                                    array_shift($url_param);
                                    $url_param=implode('/',$url_param);
                                    $action_parameters['/']=$url_param;
                                }
                                
                                foreach ($routes as $rout_k => $rout_v) {
                                    if(!$error_exists) {
                                        $error_exists=true;
                                    }
                                    if($rout_k % 2 === 0) {
                                        $routes_param[]=$rout_v;
                                    }
                                    else {
                                        $routes_value[]=$rout_v;
                                    }
                                }
                                
                        foreach ($pattern_filter as $param) {
                            if (strpos($param, ':') === 0) {
                                if($param==':/') {
                                    $error_exists=false;
                                    break;
                                }
                                    if(preg_match("/^:[\/#@|]/", $param)) {
                                        if(preg_match(substr($param, 1), implode("/", $routes))) {
                                            $error_exists=false;
                                        }
                                        continue;
                                    }
                                if (in_array(substr($param, 1), $routes_param)) {
                                    if (array_key_exists(array_search(substr($param, 1), $routes_param), $routes_value)) {
                                        $action_parameters[substr($param, 1)] = $routes_value[array_search(substr($param, 1), $routes_param)];
                                        if($error_exists) {
                                            $error_exists=false;
                                        }
                                    }
                                }
                            }
                        }
                        
                        break;
                    }
                }
            }
        }
        
        
        //если действие не найдено ищем совпадения по контроллеру и формируем массив параметров
        //данный код контролирует вывод ошибки если вместо действия идут не существующие параметры
        //так же код контролирует вывод ошибки если действие равно index и идут не существующие параметры
        if ($controller_exists && !$action_exists) {
            $action_exists = true;//index
                if(!empty($routes[1])) {
                    $error_exists=true;
                }
            //if(!empty($routes[1]) && ($routes[1]!='index' || count($routes)>2)) {
            if(!empty($routes[1]) && count($routes)>1) {
                foreach ($routing_map as $routing_map_rout) {
                    foreach ($routing_map_rout as $pattern_controller => $pattern_filter) {
                        if (!empty($routes[0]) && strval($pattern_controller) == $routes[0]) {
                            
                            if($error_exists) {
                                $error_exists=false;
                            }
                                    
                                    array_shift($routes);
                                    $routes_param=array();
                                    $routes_value=array();

                                    if(is_array($url_param) && count($url_param)>1) {
                                        array_shift($url_param);
                                        $url_param=implode('/',$url_param);
                                        $action_parameters['/']=$url_param;
                                    }

                                    foreach ($routes as $rout_k => $rout_v) {
                                        if(!$error_exists) {
                                            $error_exists=true;
                                        }
                                        if($rout_k % 2 === 0) {
                                            $routes_param[]=$rout_v;
                                        }
                                        else {
                                            $routes_value[]=$rout_v;
                                        }
                                    }

                            foreach ($pattern_filter as $param) {
                                if (strpos($param, ':') === 0) {
                                    if($param==':/') {
                                        $error_exists=false;
                                        break;
                                    }
                                        if(preg_match("/^:[\/#@|]/", $param)) {
                                            if(preg_match(substr($param, 1), implode("/", $routes))) {
                                                $error_exists=false;
                                            }
                                            continue;
                                        }
                                    if (in_array(substr($param, 1), $routes_param)) {
                                        if (array_key_exists(array_search(substr($param, 1), $routes_param), $routes_value)) {
                                            $action_parameters[substr($param, 1)] = $routes_value[array_search(substr($param, 1), $routes_param)];
                                            if($error_exists) {
                                                $error_exists=false;
                                            }
                                        }
                                    }
                                }
                            }

                            break;
                            
                        }
                    }
                }
            }
        }
        
        
        //если это главная страница формируем массив параметров
        if (!$controller_exists && !$action_exists) {
            $controller_exists = true;//index
            $action_exists = true;//index
            $error_exists=false;
            foreach ($routing_map as $routing_map_rout) {
                foreach ($routing_map_rout as $pattern_controller => $pattern_filter) {
                    if (strval($pattern_controller) == 'index') {
                        if (count($pattern_filter)==0 || (!empty($pattern_filter[0]) && ($pattern_filter[0] == 'index' || strpos($pattern_filter[0], ':') === 0))) {
                            
                                    $routes_param=array();
                                    $routes_value=array();
                                    
                                    if(is_array($url_param) && count($url_param)>0) {
                                        $url_param=implode('/',$url_param);
                                        $action_parameters['/']=$url_param;
                                    }
                                    
                                    foreach ($routes as $rout_k => $rout_v) {
                                        if(!$error_exists) {
                                            $error_exists=true;
                                        }
                                        if($rout_k % 2 === 0) {
                                            $routes_param[]=$rout_v;
                                        }
                                        else {
                                            $routes_value[]=$rout_v;
                                        }
                                    }
                                    
                            foreach ($pattern_filter as $param) {
                                if (strpos($param, ':') === 0) {
                                    if($param==':/') {
                                        $error_exists=false;
                                        break;
                                    }
                                        if(preg_match("/^:[\/#@|]/", $param)) {
                                            if(preg_match(substr($param, 1), implode("/", $routes))) {
                                                $error_exists=false;
                                            }
                                            continue;
                                        }
                                    if (in_array(substr($param, 1), $routes_param)) {
                                        if (array_key_exists(array_search(substr($param, 1), $routes_param), $routes_value)) {
                                            $action_parameters[substr($param, 1)] = $routes_value[array_search(substr($param, 1), $routes_param)];
                                            if($error_exists) {
                                                $error_exists=false;
                                            }
                                        }
                                    }
                                }
                            }
                            
                            break;
                        }
                    }
                }
            }
        }
        
        if($error_exists) {
            Route::NoFound();
            //$controller_name = '404';
        }
        
        /*
        print_r(array(
            'controller_name' => $controller_name,
            'action_name' => $action_name,
            'action_parameters' => $action_parameters
                ));
        exit();
        */
        
        return array(
            'controller_name' => $controller_name,
            'action_name' => $action_name,
            'action_parameters' => $action_parameters
                );
    }

}

