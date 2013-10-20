<?php
/**
 * MVCPHP Framework
 * 
 * @copyright Copyright (c) 2013, Alexey Novitskiy
 * @author Alexey Novitskiy
 * @link http://mvcphp.ru/
 * 
 */

class Controller_Index extends Controller {
        
        public function __construct() {
            parent::__construct('Model_Index');
            $this->tpl->assign('top',array($this->tpl->path.'top_view.php'));
            $this->tpl->assign('left',array($this->tpl->path.'left_view.php'));
            $this->tpl->assign('footer',array($this->tpl->path.'footer_view.php'));
            $this->tpl->assign('content',array($this->tpl->path.'index_view.php'));
        }

	public function action_index(array $parameters) {
            $this->model->get_data($parameters);
            $this->view->generate($this->tpl, $this->tpl->path.'template_main.php');
	}
}

