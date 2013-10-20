<?php
/**
 * MVCPHP Framework
 * 
 * @copyright Copyright (c) 2013, Alexey Novitskiy
 * @author Alexey Novitskiy
 * @link http://mvcphp.ru/
 * 
 */

class Model_Captcha extends Model {
    
        private $font;
	private $width;
	private $height;
	private $symbols;
	private $sesname;
        
        public function __construct($tpl) {
                $this->tpl=$tpl;
                
                $default=array('font'=>'arial.ttf','width'=>120,'height'=>30,'symbols'=>'123457890abcfgkpvnsx','sesname'=>'captcha');
		
                if(func_num_args()>1 && is_array(func_get_arg(1))) {
			$arguments=func_get_arg(1);
			foreach($default as $key => $value) {
				if(array_key_exists($key, $arguments)) {
					$this->{$key}=$arguments[$key];
				}
				else {
					$this->{$key}=$value;
				}
			}
		}
		else {
			foreach($default as $key => $value) {
				$this->{$key}=$value;
			}
		}
                
	}
        
        public function show() {
		srand();
		
		$img=imagecreatetruecolor($this->width, $this->height);
		
		$bgc=imagecolorallocate($img,rand(0,125),rand(0,125),rand(0,125));
		$txc1=imagecolorallocate($img,rand(125,255),rand(125,255),rand(125,255));
		$txc2=imagecolorallocate($img,rand(125,255),rand(125,255),rand(125,255));
		$txc3=imagecolorallocate($img,rand(125,255),rand(125,255),rand(125,255));
		$txc4=imagecolorallocate($img,rand(125,255),rand(125,255),rand(125,255));
		$txc5=imagecolorallocate($img,rand(125,255),rand(125,255),rand(125,255));
		imagefill($img,0,0,$bgc);
		$znk='-+';
		$buk1=$this->symbols[rand(0,strlen($this->symbols)-1)];
		$buk2=$this->symbols[rand(0,strlen($this->symbols)-1)];
		$buk3=$this->symbols[rand(0,strlen($this->symbols)-1)];
		$buk4=$this->symbols[rand(0,strlen($this->symbols)-1)];
		$buk5=$this->symbols[rand(0,strlen($this->symbols)-1)];
		
		imagettftext($img,18,$znk[rand(0,strlen($znk)-1)].rand(0,30),10,23,$txc1,realpath(dirname(__FILE__).'/../views/fonts/'.$this->font),$buk1);
		imagettftext($img,18,$znk[rand(0,strlen($znk)-1)].rand(0,30),32,23,$txc2,realpath(dirname(__FILE__).'/../views/fonts/'.$this->font),$buk2);
		imagettftext($img,18,$znk[rand(0,strlen($znk)-1)].rand(0,30),52,23,$txc3,realpath(dirname(__FILE__).'/../views/fonts/'.$this->font),$buk3);
		imagettftext($img,18,$znk[rand(0,strlen($znk)-1)].rand(0,30),72,23,$txc4,realpath(dirname(__FILE__).'/../views/fonts/'.$this->font),$buk4);
		imagettftext($img,18,$znk[rand(0,strlen($znk)-1)].rand(0,30),97,23,$txc5,realpath(dirname(__FILE__).'/../views/fonts/'.$this->font),$buk5);
		
		for($i=0;$i<10;$i++) {
			$ink=imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255));
			imageline($img,rand(0,$this->width),rand(0,$this->height),rand(0,$this->width),rand(0,$this->height),$ink);
		}
		
		header ('Content-type: image/jpeg');
		imagejpeg($img,'',100);
		imagedestroy($img);
		$_SESSION[$this->sesname]=$buk1.$buk2.$buk3.$buk4.$buk5;
	}
	
	public function getsesname() {
		return $this->sesname;
	}
	
	public function get_data(array $parameters) {
                //$this->tpl->sesname=$this->getsesname();
                $this->show();
	}

}

