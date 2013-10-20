<?php
/**
 * MVCPHP Framework
 * 
 * @copyright Copyright (c) 2013, Alexey Novitskiy
 * @author Alexey Novitskiy
 * @link http://mvcphp.ru/
 * 
 */

class Controller_404 extends Controller {
	
	public function action_index(array $parameters) {
            $this->tpl->html_title='404 - страница не найдена';
            
            $this->tpl->assign('top',array($this->tpl->path.'top_view.php'));
            $this->tpl->assign('left',array($this->tpl->path.'left_view.php'));
            $this->tpl->assign('footer',array($this->tpl->path.'footer_view.php'));
            $this->tpl->assign('content',array($this->tpl->path.'404_view.php'));
            $this->view->generate($this->tpl, $this->tpl->path.'template_main.php');
	}

}

