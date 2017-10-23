<?php
namespace Home\Controller;
use Think\Controller;

class OtherController extends Controller{
    public function system(){
        $this->display('Index/guide');
    }
    
    public function guide(){
        $this->display('Index/guide');
    }
    
    public function guide_con(){
        $this->display('Index/guide_con');
    }
}


?>