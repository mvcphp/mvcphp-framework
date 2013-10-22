<?php

/**
 * MVCPHP Framework
 * 
 * @copyright Copyright (c) 2013, Alexey Novitskiy
 * @author Alexey Novitskiy
 * @link http://mvcphp.ru/
 * 
 */

/////////////////////
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('Location:' . $host . '404/');
        exit();
    /////////////////////

//запускаю загрузчик
define("Q_PATH",dirname(dirname(__FILE__)));
include Q_PATH.'/admin/application/bootstrap.php';

