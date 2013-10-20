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
 * Класс загрузки файлов из формы
 * 
 */
class File_Upload {
    
    private $upload_param;
    private $upload_file;

    public function __construct($upload_file,array $param=array()) {
        
        $def_param=array(
                            'file_type_allow'=>array('jpg','JPG','gif','GIF','png','PNG'),
                            'max_file_size'=>1024*1024*3
                        );
        $this->upload_param=array_merge($def_param,$param);
        $this->upload_file=$upload_file;
    }
    
    public function IsFile() {
        if(isset($this->upload_file) && $this->upload_file['size']!=0) {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function SizeOk() {
        if($this->upload_file['size']>$this->upload_param['max_file_size']) {
            return false;
        }
        else {
            return true;
        }
    }
    
    public function NoError() {
        if($this->upload_file['error']==0) {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function ExtensionOk() {
        if(!in_array($this->GetExtension(),$this->upload_param['file_type_allow'])) {
            return false;
        }
        else {
            return true;
        }
    }
    
    public function GetParam($param='tmp_name') {
        return $this->upload_file[$param];
    }
    
    public function GetExtension() {
        $file_info=pathinfo($this->upload_file['name']);
        return $file_info['extension'];
    }

}

