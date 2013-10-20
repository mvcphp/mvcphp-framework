<?php
/**
 * MVCPHP Framework
 * 
 * @copyright Copyright (c) 2013, Alexey Novitskiy
 * @author Alexey Novitskiy
 * @link http://mvcphp.ru/
 * 
 */

class Model_Index extends Model {
	
	public function get_data(array $parameters) {
                $this->tpl->html_title='Админка: Главная';
	}

}

