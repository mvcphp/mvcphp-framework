<?php
/**
 * MVCPHP Framework
 * 
 * @copyright Copyright (c) 2013, Alexey Novitskiy
 * @author Alexey Novitskiy
 * @link http://mvcphp.ru/
 * 
 */

class Controller {
	
	public $model;
	public $view;
        public $tpl;

        public function __construct($model='Model') {
		$this->view = new View();
                $this->tpl = new Template();
                $this->model = new $model($this->tpl);
                $this->tpl->path='/admin/application/views/themes/'.Settings::get('admin_template_dir').'/'.Settings::get('language').'/';
	}
	
        //действие по умолчанию
	public function action_index(array $parameters) {
            
	}
}

