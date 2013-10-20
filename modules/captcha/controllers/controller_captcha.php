<?php
/**
 * MVCPHP Framework
 * 
 * @copyright Copyright (c) 2013, Alexey Novitskiy
 * @author Alexey Novitskiy
 * @link http://mvcphp.ru/
 * 
 */

class Controller_Captcha extends Controller {
        
	public function __construct() {
		parent::__construct('Model_Captcha');
                //$this->tpl->mpath='/modules/captcha/views/'.Settings::get('language').'/';
                //$this->tpl->assign('content',array($this->tpl->mpath.'captcha_view.php'));
	}
	
	public function action_index(array $parameters) {
		$this->model->get_data($parameters);
                //$this->tpl->path=$this->tpl->mpath;
                //$this->view->generate($this->tpl, $this->tpl->path.'captcha_view.php');
	}
}

