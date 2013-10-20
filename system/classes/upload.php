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
 * Класс загрузки
 * 
 */
class Upload {
    
    public $id;
    private $upload_dir;
    private $max_file_count;
    private $branches;

    public function __construct(array $param=array()) {
        $def_param=array('upload_dir'=>Q_PATH.'/uploads/','max_file_count'=>1000,'branches'=>2,'pattern'=>'');
        $upload_param=Functions::arr_union($def_param,$param);
        $this->upload_dir=$upload_param['upload_dir'];
        $this->max_file_count=$upload_param['max_file_count'];
        $this->branches=$upload_param['branches'];
        //сложность надумана, все зависит от инодов df -i и tune2fs -l /dev/hda1 и df -Ti
        switch($upload_param['pattern']) {
            case 'bigint':
                $this->max_file_count=512;
                $this->branches=6;
            break;
            case 'int':
                $this->max_file_count=216;
                $this->branches=3;
            break;
            case 'mediumint':
                $this->max_file_count=204;
                $this->branches=2;
            break;
            case 'smallint':
                $this->max_file_count=182;
                $this->branches=1;
            break;
        }
        $this->del_id();
    }
    
    public function set_id($id) {
        $this->id=$id;
    }
	
    public function del_id() {
        $this->id=0;
    }
    
    public function find_upload($url) {
        if(is_file($url)) {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function get_upload($id,$fl) {
        $this->set_id($id);
        for($i=$this->branches;$i>=1;$i--) {
            $dir=ceil($this->id/pow($this->max_file_count,$i))%$this->max_file_count;
            $dir_file_arr[]=$dir>0?$dir:$this->max_file_count;
        }
        $dir_file_str=implode("/", $dir_file_arr);
        return $this->upload_dir.$dir_file_str.'/'.$this->id.$fl;
    }
    
    public function put_upload($id,$fl,$data) {
        $this->set_id($id);
        for($i=$this->branches;$i>=1;$i--) {
            $dir=ceil($this->id/pow($this->max_file_count,$i))%$this->max_file_count;
            $dir_file_arr[]=$dir>0?$dir:$this->max_file_count;
            
            $dir_file_str=implode("/", $dir_file_arr);
            if(!is_dir($this->upload_dir.$dir_file_str)) {
                mkdir($this->upload_dir.$dir_file_str, 0777);
                chmod($this->upload_dir.$dir_file_str, 0777);
            }
        }
        file_put_contents($this->upload_dir.$dir_file_str.'/'.$this->id.$fl, $data);
        return $this->upload_dir.$dir_file_str.'/'.$this->id.$fl;
    }
    
    public function set_upload($id,$fl) {
        $this->set_id($id);
        for($i=$this->branches;$i>=1;$i--) {
            $dir=ceil($this->id/pow($this->max_file_count,$i))%$this->max_file_count;
            $dir_file_arr[]=$dir>0?$dir:$this->max_file_count;
            
            $dir_file_str=implode("/", $dir_file_arr);
            if(!is_dir($this->upload_dir.$dir_file_str)) {
                mkdir($this->upload_dir.$dir_file_str, 0777);
                chmod($this->upload_dir.$dir_file_str, 0777);
            }
        }
        return $this->upload_dir.$dir_file_str.'/'.$this->id.$fl;
    }
    
    public function get_upload_dir($id) {
        $this->set_id($id);
        for($i=$this->branches;$i>=1;$i--) {
            $dir=ceil($this->id/pow($this->max_file_count,$i))%$this->max_file_count;
            $dir_file_arr[]=$dir>0?$dir:$this->max_file_count;
        }
            $dir_file_str=implode("/", $dir_file_arr);
        return $this->upload_dir.$dir_file_str.'/'.$this->id;
    }
    
    public function set_upload_dir($id) {
        $this->set_id($id);
        for($i=$this->branches;$i>=1;$i--) {
            $dir=ceil($this->id/pow($this->max_file_count,$i))%$this->max_file_count;
            $dir_file_arr[]=$dir>0?$dir:$this->max_file_count;
            
            $dir_file_str=implode("/", $dir_file_arr);
            if(!is_dir($this->upload_dir.$dir_file_str)) {
                mkdir($this->upload_dir.$dir_file_str, 0777);
                chmod($this->upload_dir.$dir_file_str, 0777);
            }
        }
            if(!is_dir($this->upload_dir.$dir_file_str.'/'.$this->id)) {
                mkdir($this->upload_dir.$dir_file_str.'/'.$this->id, 0777);
                chmod($this->upload_dir.$dir_file_str.'/'.$this->id, 0777);
            }
        return $this->upload_dir.$dir_file_str.'/'.$this->id;
    }

}

