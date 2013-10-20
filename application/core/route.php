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
 * Класс маршрутизатор для определения запрашиваемой страницы.
 * 
 * Цепляет классы контроллеров и моделей.
 * Создает экземпляры контролеров страниц и вызывает действия этих контроллеров.
 * 
 */
class Route {
    
    /**
     * Оснавная статическая функция маршрутизации
     * 
     * Обрабатывает URL
     * Подключает модель и контроллер
     * 
     */
    public static function start() {
        
        //назначение параметров по умолчанию
        $controller_name = 'index';
        $action_name = 'index';
        $action_parameters = array();

        //преобразуем строку запроса в массив
        $route_array = explode('/', $_SERVER['REQUEST_URI']);

        //удаляем пустые элементы и формируем конечный массив для роутера
        $routes = array();
        $routes_key=false;
        foreach ($route_array as $value) {
            if(!empty($value)) {
                $routes_key=true;
            }
                if($routes_key) {
                    $routes[] = trim($value);
                }
        }
        
        //print_r($routes);exit;
        
        //инициализирую карту маршрутизации
        new Main_Routing(); 
        //запускаю все подключенные в бутстрапе классы модулей
        foreach(Booter::$include_module_classes as $new_class) {
            $new_class=$new_class.'_Routing';
            new $new_class();
        }
        $routing_map = Settings::get('routing');
        ////////////////////////////////////
        
        //print_r($routing_map);exit;
        
        //задействуем карту маршрутизации
        $routing_parameters = Mapper::get_parameters($routing_map['site'], $routes, $controller_name, $action_name, $action_parameters);
        $controller_name = $routing_parameters['controller_name'];
        $action_name = $routing_parameters['action_name'];
        $action_parameters = $routing_parameters['action_parameters'];
        
        // добавляем префиксы
        $model_name = 'Model_' . $controller_name;
        $controller_name = 'Controller_' . $controller_name;
        $action_name = 'Action_' . $action_name;
        
        // подцепляем файл с классом модели (файла модели может и не быть)
        $model_file = strtolower($model_name) . '.php';
        $model_path = Q_PATH . '/application/models/' . $model_file;
        if (file_exists($model_path)) {
            foreach (Booter::boot(array('/application/models/' . $model_file)) as $inc_file) {
                include $inc_file;
            }
        }
        else {
            ////////////////////////////////////
            foreach(Booter::$include_module_classes as $mod_dir) {
                if($routing_parameters['controller_name']==$mod_dir) {
                    $model_path = Q_PATH . '/modules/' .$mod_dir.'/models/'.$model_file;
                    if (file_exists($model_path)) {
                        foreach (Booter::boot(array('/modules/'.$mod_dir.'/models/'.$model_file)) as $inc_file) {
                            include $inc_file;
                        }
                        break;
                    }
                }
            }
            ////////////////////////////////////
        }
        
        // подцепляем файл с классом контроллера
        $controller_file = strtolower($controller_name) . '.php';
        $controller_path = Q_PATH . '/application/controllers/' . $controller_file;
        if (file_exists($controller_path)) {
            foreach (Booter::boot(array('/application/controllers/' . $controller_file)) as $inc_file) {
                include $inc_file;
            }
        } 
        else {
            ////////////////////////////////////
            $key_404=true;
            foreach(Booter::$include_module_classes as $mod_dir) {
                if($routing_parameters['controller_name']==$mod_dir) {
                    $controller_path = Q_PATH . '/modules/' .$mod_dir.'/controllers/'.$controller_file;
                    if (file_exists($controller_path)) {
                        foreach (Booter::boot(array('/modules/'.$mod_dir.'/controllers/'.$controller_file)) as $inc_file) {
                            include $inc_file;
                        }
                        $key_404=false;
                        break;
                    }
                }
            }
            ////////////////////////////////////
            // редирект на страницу 404
            if($key_404) {
                Route::NoFound();
            }
        }
        
        // создаем контроллер
        $controller = new $controller_name;
        $action = strtolower($action_name);
        
        if (method_exists($controller, $action)) {
            // вызываем действие контроллера
            $controller->$action($action_parameters);
        } else {
            // редирект на страницу 404
            Route::NoFound();
        }
    }
    
    public static function NoFound() {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404/');
        exit();
    }
    
}

