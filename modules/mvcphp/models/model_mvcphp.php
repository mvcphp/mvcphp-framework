<?php
/**
 * MVCPHP Framework
 * 
 * @copyright Copyright (c) 2013, Alexey Novitskiy
 * @author Alexey Novitskiy
 * @link http://mvcphp.ru/
 * 
 */

class Model_Mvcphp extends Model {
    
    private $mvcphp_type;
    private $mvcphp_controller;
    private $mvcphp_action;
    private $mvcphp_file_m;
    private $mvcphp_file_v;
    private $mvcphp_file_c;
    private $mvcphp_theme;
    private $mvcphp_language;
    
	
	public function get_data(array $parameters) {
            $this->tpl->html_title='MVCPHP генератор';
            $this->tpl->html_rout='';
            
            if(isset($_POST['mvcphp_construct'])) {
                $this->mvcphp_type=(isset($_POST['mvcphp_type']))?$_POST['mvcphp_type']:'';
                $this->mvcphp_controller=(isset($_POST['mvcphp_controller']))?$_POST['mvcphp_controller']:'';
                $this->mvcphp_action=(isset($_POST['mvcphp_action']))?$_POST['mvcphp_action']:'';
                $this->mvcphp_file_m=(isset($_POST['mvcphp_file_m']))?$_POST['mvcphp_file_m']:'';
                $this->mvcphp_file_v=(isset($_POST['mvcphp_file_v']))?$_POST['mvcphp_file_v']:'';
                $this->mvcphp_file_c=(isset($_POST['mvcphp_file_c']))?$_POST['mvcphp_file_c']:'';
                $this->mvcphp_theme=(isset($_POST['mvcphp_theme']))?$_POST['mvcphp_theme']:'';
                $this->mvcphp_language=(isset($_POST['mvcphp_language']))?$_POST['mvcphp_language']:'';
                
                if(empty($this->mvcphp_controller) || !preg_match("/^[a-z0-9]+[a-z0-9_]*$/i", $this->mvcphp_controller)) {
                    Log::ini()->add('В имени контроллера разрешено использовать [a-z0-9_] (для модулей это так же имя папки)','mvcphp');
                }
                if(empty($this->mvcphp_action) || !preg_match("/^[a-z0-9]+[a-z0-9_]*$/i", $this->mvcphp_action)) {
                    Log::ini()->add('В имени действия разрешено использовать [a-z0-9_]','mvcphp');
                }
                if(empty($this->mvcphp_file_m) && empty($this->mvcphp_file_v) && empty($this->mvcphp_file_c)) {
                    Log::ini()->add('Нужно выбрать создаваемые файлы','mvcphp');
                }
                if(empty($this->mvcphp_theme) || !preg_match("/^[a-z0-9]+[a-z0-9_]*$/i", $this->mvcphp_theme)) {
                    Log::ini()->add('В имени темы разрешено использовать [a-z0-9_]','mvcphp');
                }
                if(empty($this->mvcphp_language) || !preg_match("/^[a-z0-9]+[a-z0-9_]*$/i", $this->mvcphp_language)) {
                    Log::ini()->add('В имени языка разрешено использовать [a-z0-9_]','mvcphp');
                }
                
                    //если ошибок нет
                    if(Log::ini()->no_entries('mvcphp')) {
                        if(!empty($this->mvcphp_type)) {
                            switch($this->mvcphp_type) {
                                case 1:
                                    $this->construct_site();
                                break;
                                case 2:
                                    $this->construct_admin();
                                break;
                                case 3:
                                    $this->construct_module();
                                break;
                            }
                                if(Log::ini()->no_entries('mvcphp')) {
                                    Log::ini()->add('Конструирование успешно завершено!','mvcphp');
                                }
                        }
                    }
                    
                $this->tpl->error=Log::ini()->get('mvcphp');
                
            }
            
	}
        
        private function construct_site() {
            $path_to_model=Q_PATH.'/modules/mvcphp/patterns/site/model.php';
            $path_to_view=Q_PATH.'/modules/mvcphp/patterns/site/view.php';
            $path_to_controller=Q_PATH.'/modules/mvcphp/patterns/site/controller.php';
            $path_to_rout=Q_PATH.'/modules/mvcphp/patterns/site/rout.php';
            
            $model_dir=Q_PATH.'/application/models';
            $view_dir=Q_PATH.'/application/views/themes';
            $controller_dir=Q_PATH.'/application/controllers';
            
            if(!is_dir($view_dir.'/'.$this->mvcphp_theme)) {
                mkdir($view_dir.'/'.$this->mvcphp_theme, 0777);
                chmod($view_dir.'/'.$this->mvcphp_theme, 0777);
            }
            
            if(!is_dir($view_dir.'/'.$this->mvcphp_theme.'/'.$this->mvcphp_language)) {
                mkdir($view_dir.'/'.$this->mvcphp_theme.'/'.$this->mvcphp_language, 0777);
                chmod($view_dir.'/'.$this->mvcphp_theme.'/'.$this->mvcphp_language, 0777);
            }
            
            //создание модели
            if(!empty($this->mvcphp_file_m) && Functions::int($this->mvcphp_file_m)>0) {
                if(!is_file($model_dir.'/model_'.$this->mvcphp_controller.'.php')) {
                    $data=$this->compile(file_get_contents($path_to_model));
                    file_put_contents($model_dir.'/model_'.$this->mvcphp_controller.'.php', $data);
                    
                    Log::ini()->add($model_dir.'/model_'.$this->mvcphp_controller.'.php','mvcphp');
                }
                else {
                    Log::ini()->add('Файл '.'model_'.$this->mvcphp_controller.'.php'.' уже существует','mvcphp');
                }
            }
            
            //создание представления
            if(!empty($this->mvcphp_file_v) && Functions::int($this->mvcphp_file_v)>0) {
                if(!is_file($view_dir.'/'.$this->mvcphp_theme.'/'.$this->mvcphp_language.'/'.$this->mvcphp_controller.'_view.php')) {
                    $data=$this->compile(file_get_contents($path_to_view));
                    file_put_contents($view_dir.'/'.$this->mvcphp_theme.'/'.$this->mvcphp_language.'/'.$this->mvcphp_controller.'_view.php', $data);
                    
                    Log::ini()->add($view_dir.'/'.$this->mvcphp_theme.'/'.$this->mvcphp_language.'/'.$this->mvcphp_controller.'_view.php','mvcphp');
                }
                else {
                    Log::ini()->add('Файл '.$this->mvcphp_controller.'_view.php'.' уже существует','mvcphp');
                }
            }
            
            //создание контроллера
            if(!empty($this->mvcphp_file_c) && Functions::int($this->mvcphp_file_c)>0) {
                if(!is_file($controller_dir.'/controller_'.$this->mvcphp_controller.'.php')) {
                    $data=$this->compile(file_get_contents($path_to_controller));
                    file_put_contents($controller_dir.'/controller_'.$this->mvcphp_controller.'.php', $data);
                    
                    Log::ini()->add($controller_dir.'/controller_'.$this->mvcphp_controller.'.php','mvcphp');
                }
                else {
                    Log::ini()->add('Файл '.'controller_'.$this->mvcphp_controller.'.php'.' уже существует','mvcphp');
                }
            }
            
            //создание роутера
            $this->tpl->html_rout=highlight_string($this->compile(file_get_contents($path_to_rout)),true);
        }
        
        private function construct_admin() {
            $path_to_model=Q_PATH.'/modules/mvcphp/patterns/admin/model.php';
            $path_to_view=Q_PATH.'/modules/mvcphp/patterns/admin/view.php';
            $path_to_controller=Q_PATH.'/modules/mvcphp/patterns/admin/controller.php';
            $path_to_rout=Q_PATH.'/modules/mvcphp/patterns/admin/rout.php';
            
            $model_dir=Q_PATH.'/admin/application/models';
            $view_dir=Q_PATH.'/admin/application/views/themes';
            $controller_dir=Q_PATH.'/admin/application/controllers';
            
            if(!is_dir($view_dir.'/'.$this->mvcphp_theme)) {
                mkdir($view_dir.'/'.$this->mvcphp_theme, 0777);
                chmod($view_dir.'/'.$this->mvcphp_theme, 0777);
            }
            
            if(!is_dir($view_dir.'/'.$this->mvcphp_theme.'/'.$this->mvcphp_language)) {
                mkdir($view_dir.'/'.$this->mvcphp_theme.'/'.$this->mvcphp_language, 0777);
                chmod($view_dir.'/'.$this->mvcphp_theme.'/'.$this->mvcphp_language, 0777);
            }
            
            //создание модели
            if(!empty($this->mvcphp_file_m) && Functions::int($this->mvcphp_file_m)>0) {
                if(!is_file($model_dir.'/model_'.$this->mvcphp_controller.'.php')) {
                    $data=$this->compile(file_get_contents($path_to_model));
                    file_put_contents($model_dir.'/model_'.$this->mvcphp_controller.'.php', $data);
                    
                    Log::ini()->add($model_dir.'/model_'.$this->mvcphp_controller.'.php','mvcphp');
                }
                else {
                    Log::ini()->add('Файл '.'model_'.$this->mvcphp_controller.'.php'.' уже существует','mvcphp');
                }
            }
            
            //создание представления
            if(!empty($this->mvcphp_file_v) && Functions::int($this->mvcphp_file_v)>0) {
                if(!is_file($view_dir.'/'.$this->mvcphp_theme.'/'.$this->mvcphp_language.'/'.$this->mvcphp_controller.'_view.php')) {
                    $data=$this->compile(file_get_contents($path_to_view));
                    file_put_contents($view_dir.'/'.$this->mvcphp_theme.'/'.$this->mvcphp_language.'/'.$this->mvcphp_controller.'_view.php', $data);
                    
                    Log::ini()->add($view_dir.'/'.$this->mvcphp_theme.'/'.$this->mvcphp_language.'/'.$this->mvcphp_controller.'_view.php','mvcphp');
                }
                else {
                    Log::ini()->add('Файл '.$this->mvcphp_controller.'_view.php'.' уже существует','mvcphp');
                }
            }
            
            //создание контроллера
            if(!empty($this->mvcphp_file_c) && Functions::int($this->mvcphp_file_c)>0) {
                if(!is_file($controller_dir.'/controller_'.$this->mvcphp_controller.'.php')) {
                    $data=$this->compile(file_get_contents($path_to_controller));
                    file_put_contents($controller_dir.'/controller_'.$this->mvcphp_controller.'.php', $data);
                    
                    Log::ini()->add($controller_dir.'/controller_'.$this->mvcphp_controller.'.php','mvcphp');
                }
                else {
                    Log::ini()->add('Файл '.'controller_'.$this->mvcphp_controller.'.php'.' уже существует','mvcphp');
                }
            }
            
            //создание роутера
            $this->tpl->html_rout=highlight_string($this->compile(file_get_contents($path_to_rout)),true);
            
        }
        
        private function construct_module() {
            $path_to_model=Q_PATH.'/modules/mvcphp/patterns/module/model.php';
            $path_to_view=Q_PATH.'/modules/mvcphp/patterns/module/view.php';
            $path_to_controller=Q_PATH.'/modules/mvcphp/patterns/module/controller.php';
            $path_to_rout=Q_PATH.'/modules/mvcphp/patterns/module/rout.php';
            
            $model_dir=Q_PATH.'/modules/'.$this->mvcphp_controller.'/models';
            $view_dir=Q_PATH.'/modules/'.$this->mvcphp_controller.'/views';
            $controller_dir=Q_PATH.'/modules/'.$this->mvcphp_controller.'/controllers';
            $boot_dir=Q_PATH.'/modules/'.$this->mvcphp_controller;
            
            if(!is_dir(Q_PATH.'/modules/'.$this->mvcphp_controller)) {
                mkdir(Q_PATH.'/modules/'.$this->mvcphp_controller, 0777);
                chmod(Q_PATH.'/modules/'.$this->mvcphp_controller, 0777);
            }
            
            if(!is_dir($model_dir)) {
                mkdir($model_dir, 0777);
                chmod($model_dir, 0777);
            }
            
            if(!is_dir($view_dir)) {
                mkdir($view_dir, 0777);
                chmod($view_dir, 0777);
            }
            
            if(!is_dir($controller_dir)) {
                mkdir($controller_dir, 0777);
                chmod($controller_dir, 0777);
            }
            
            if(!is_dir($view_dir.'/'.$this->mvcphp_language)) {
                mkdir($view_dir.'/'.$this->mvcphp_language, 0777);
                chmod($view_dir.'/'.$this->mvcphp_language, 0777);
            }
            
            //создание модели
            if(!empty($this->mvcphp_file_m) && Functions::int($this->mvcphp_file_m)>0) {
                if(!is_file($model_dir.'/model_'.$this->mvcphp_controller.'.php')) {
                    $data=$this->compile(file_get_contents($path_to_model));
                    file_put_contents($model_dir.'/model_'.$this->mvcphp_controller.'.php', $data);
                    
                    Log::ini()->add($model_dir.'/model_'.$this->mvcphp_controller.'.php','mvcphp');
                }
                else {
                    Log::ini()->add('Файл '.'model_'.$this->mvcphp_controller.'.php'.' уже существует','mvcphp');
                }
            }
            
            //создание представления
            if(!empty($this->mvcphp_file_v) && Functions::int($this->mvcphp_file_v)>0) {
                if(!is_file($view_dir.'/'.$this->mvcphp_language.'/'.$this->mvcphp_controller.'_view.php')) {
                    $data=$this->compile(file_get_contents($path_to_view));
                    file_put_contents($view_dir.'/'.$this->mvcphp_language.'/'.$this->mvcphp_controller.'_view.php', $data);
                    
                    Log::ini()->add($view_dir.'/'.$this->mvcphp_language.'/'.$this->mvcphp_controller.'_view.php','mvcphp');
                }
                else {
                    Log::ini()->add('Файл '.$this->mvcphp_controller.'_view.php'.' уже существует','mvcphp');
                }
            }
            
            //создание контроллера
            if(!empty($this->mvcphp_file_c) && Functions::int($this->mvcphp_file_c)>0) {
                if(!is_file($controller_dir.'/controller_'.$this->mvcphp_controller.'.php')) {
                    $data=$this->compile(file_get_contents($path_to_controller));
                    file_put_contents($controller_dir.'/controller_'.$this->mvcphp_controller.'.php', $data);
                    
                    Log::ini()->add($controller_dir.'/controller_'.$this->mvcphp_controller.'.php','mvcphp');
                }
                else {
                    Log::ini()->add('Файл '.'controller_'.$this->mvcphp_controller.'.php'.' уже существует','mvcphp');
                }
            }
            
            //создание роутера
            if(!is_file($boot_dir.'/boot.php')) {
                $data=$this->compile(file_get_contents($path_to_rout));
                file_put_contents($boot_dir.'/boot.php', $data);
                
                Log::ini()->add($boot_dir.'/boot.php','mvcphp');
            }
            else {
                //создание роутера
                //$this->tpl->html_rout=highlight_string($this->compile(file_get_contents($path_to_rout)),true);
                Log::ini()->add('Файл boot.php уже существует','mvcphp');
            }
            
        }
        
        private function compile($str) {
            $str=str_replace("{!!controller!}",Functions::mb_ucfirst($this->mvcphp_controller),$str);
            $str=str_replace("{!controller!}",$this->mvcphp_controller,$str);
            $str=str_replace("{!action!}",$this->mvcphp_action,$str);
            $str=str_replace("/*{!","",$str);
            $str=str_replace("!}*\\","",$str);
            return $str;
        }

}

