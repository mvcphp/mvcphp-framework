<?php

/**
 * MVCPHP Framework
 * 
 * @copyright Copyright (c) 2013, Alexey Novitskiy
 * @author Alexey Novitskiy
 * @link http://mvcphp.ru/
 * 
 */

//подключаем файл загрузчика
include Q_PATH.'/system/classes/booter.php';

//можно использовать автолоад, вместо простыни ниже
//spl_autoload_register(array('Booter','autoload'));


foreach (Booter::boot(array(
    '/application/core/model.php',
    '/application/core/view.php',
    '/application/core/controller.php',
    '/system/classes/routing.php',
    '/system/classes/mapper.php',
    '/system/classes/functions.php',
    '/system/classes/log.php',
    '/system/config/config.php',
    '/system/config/main_routing.php',
    '/system/classes/timer.php',
    '/system/classes/database.php',
    '/system/classes/cache.php',
    '/system/classes/settings.php',
    '/system/classes/template.php',
    '/system/classes/upload.php',
    '/system/classes/picture.php',
    '/system/database/database.php',
    '/system/database/database_pdo.php',
    '/system/database/database_mysqli.php',
    '/system/database/database_mysql.php',
    '/system/database/database_sqlite.php',
    '/system/database/database_postgresql.php',
    '/system/database/database_mssql.php',
    '/system/database/database_oracledb.php',
    '/system/cache/cache.php',
    '/system/cache/cache_file.php',
    '/system/cache/cache_memcache.php',
    '/system/cache/cache_memcached.php',
    '/system/form/file_upload.php'
)) as $inc_file) {
    include $inc_file;
}


//автозагрузка и инициализация модулей
foreach (Booter::boot_modules() as $inc_file) {
    include $inc_file;
}


//загрузка основного роутера
foreach (Booter::boot(array(
    '/application/core/route.php'
)) as $inc_file) {
    include $inc_file;
}


//запускаем маршрутизатор
Route::start();

