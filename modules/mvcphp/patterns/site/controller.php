<?php
/**
 * MVCPHP Framework
 * 
 * @copyright Copyright (c) 2013, Alexey Novitskiy
 * @author Alexey Novitskiy
 * @link http://mvcphp.ru/
 * 
 */
/*{!
class Controller_{!!controller!} extends Controller {
    
    public function __construct() {
        parent::__construct('Model_{!!controller!}');
        $this->tpl->assign('content',array($this->tpl->path.'{!controller!}_view.php'));
    }
    
    public function action_{!action!}(array $parameters) {
        $this->model->get_data($parameters);
        $this->view->generate($this->tpl, $this->tpl->path.'template_main.php');
    }
    
}
!}*\
