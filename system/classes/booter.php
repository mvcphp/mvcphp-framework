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
 * Класс автоматической подгрузки модулей
 * 
 */
class Booter {
    
    private static $include_files = array();
    
    private static $include_module_files = array();
    public static $include_module_classes = array();
    
    
    public static function boot(array $include_array) {
        $inc_files=array();
        foreach ($include_array as $inc_file) {
            if(!in_array($inc_file, self::$include_files)) {
                if (file_exists(Q_PATH.$inc_file)) {
                    self::$include_files[]=$inc_file;
                    $inc_files[] = Q_PATH.$inc_file;
                }
            }
        }
        return $inc_files;
    }
    
    public static function autoload($class) {
        //пляски с бубном
        //имена файлов с маленькой буквы, должны совпадать с именами классов
        $file = strtolower($class).'.php';
        $inc_files=array();
        $load_path=array(
            '/application/core/',
            '/application/models/',
            '/application/controllers/',
            '/system/classes/',
            '/system/config/',
            '/system/database/',
            '/system/cache/',
            '/system/form/'
        );
        foreach ($load_path as $inc_path) {
            if(!in_array($inc_path.$file, self::$include_files)) {
                if (file_exists(Q_PATH.$inc_path.$file)) {
                    self::$include_files[]=$inc_path.$file;
                    $inc_files[] = Q_PATH.$inc_path.$file;
                }
            }
        }
        
        foreach ($inc_files as $inc_file) {
            include $inc_file;
        }
    }
    
    public static function admin_autoload($class) {
        //пляски с бубном
        //имена файлов с маленькой буквы, должны совпадать с именами классов
        $file = strtolower($class).'.php';
        $inc_files=array();
        $load_path=array(
            '/admin/application/core/',
            '/admin/application/models/',
            '/admin/application/controllers/',
            '/system/classes/',
            '/system/config/',
            '/system/database/',
            '/system/cache/',
            '/system/form/'
        );
        foreach ($load_path as $inc_path) {
            if(!in_array($inc_path.$file, self::$include_files)) {
                if (file_exists(Q_PATH.$inc_path.$file)) {
                    self::$include_files[]=$inc_path.$file;
                    $inc_files[] = Q_PATH.$inc_path.$file;
                }
            }
        }
        
        foreach ($inc_files as $inc_file) {
            include $inc_file;
        }
    }

    public static function boot_modules() {
        $modules_dir=Functions::find_dirs(Q_PATH.'/modules/');
        foreach ($modules_dir as $module_dir) {
            if(file_exists(Q_PATH.'/modules/'.$module_dir.'/boot.php')) {
                self::$include_module_files[]=Q_PATH.'/modules/'.$module_dir.'/boot.php';
                self::$include_module_classes[]=$module_dir;
            }
        }
        return self::$include_module_files;
    }
    
}

