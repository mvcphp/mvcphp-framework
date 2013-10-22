<?php
/**
 * MVCPHP Framework
 * 
 * @copyright Copyright (c) 2013, Alexey Novitskiy
 * @author Alexey Novitskiy
 * @link http://mvcphp.ru/
 * 
 */

//запускаю сессию
session_start();

//отображаю ошибки
error_reporting(E_ALL);
ini_set('display_errors', 1);

//проверяю версию php
if(version_compare(phpversion(), '5.3.0', '<') == true) {
    die('PHP >= 5.3.0 Only (Версия пхп должна быть >= 5.3.0)');
}

//проверяю установлена ли временная зона в файле php.ini
//и избавляюсь от предупреждений
if(!ini_get('date.timezone')) {
    ini_set('date.timezone', 'Europe/Moscow');
    if(function_exists('date_default_timezone_set')) {
        date_default_timezone_set('Europe/Moscow');
    }
}

//перенаправляю на админку
$route_array = explode('/', $_SERVER['REQUEST_URI']);
if($route_array[1]=='admin') {
    /////////////////////
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('Location:' . $host . '404/');
        exit();
    /////////////////////
    include dirname(__FILE__).'/admin/index.php';
    exit();
}

//запускаю загрузчик
define("Q_PATH",dirname(__FILE__));
include Q_PATH.'/application/bootstrap.php';

