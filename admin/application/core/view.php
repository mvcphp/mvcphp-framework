<?php
/**
 * MVCPHP Framework
 * 
 * @copyright Copyright (c) 2013, Alexey Novitskiy
 * @author Alexey Novitskiy
 * @link http://mvcphp.ru/
 * 
 */

class View {
	
	public function generate(Template $tpl, $template_view) {
                
		foreach (Booter::boot(array($template_view)) as $inc_file) {
                    include $inc_file;
                }
		
	}
}

