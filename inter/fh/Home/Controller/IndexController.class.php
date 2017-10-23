<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	header("Content-Type:text/html; charset=utf-8");
    	
    	
    	$year = date("Y");
    	$month = date("m");
    	$day = date("d");
    	
    	$dayBegin = mktime(0,0,0,$month,$day,$year);//當天開始時間戳
    	$dayEnd = mktime(23,59,59,$month,$day,$year);//當天結束時間戳
    	
    	$startTime = date('Y-m-d H:i:s',$dayBegin);
    	$endTime=date('Y-m-d H:i:s',$dayEnd);
    	
    	$startTimed = date('Y-m-d H:i:s',$dayBegin);
    	$endTimed=date('Y-m-d H:i:s',$dayEnd);
    	
    	if(M('fhdate')->where("date > '".$startTimed."' and date < '".$endTimed."'")->find()){
    		echo '今天已经分红过了';
    	}else{
    	
    	
    	$map['jinyu']=array('neq','0');
    	$user=M('member')->where($map)->select();
    	$fhgs=0;
    	$cjgs=0;
    	foreach($user as $val){
    		
    		//echo $val['mname'];
    		
    		$jb=$val['jinyu']*2*0.9;
    		$zzb=$val['jinyu']*2*0.1;
    		M('member')->where(array('mname'=>$val['mname']))->setInc('wode',$jb);
    		M('member')->where(array('mname'=>$val['mname']))->setInc('t9',$zzb);
    		$fhgs++;
    		if($val['qq']=='7'){
    			M('member')->where(array('mname'=>$val['mname']))->save(array('jinyu'=>'0','qq'=>'0'));
    			$cjgs++;
    		}else{
    			M('member')->where(array('mname'=>$val['mname']))->setInc('qq',1);
    		}
    		
    	}
    	M('fhdate')->add(array('date'=>date ( 'Y-m-d H:i:s', time () )));
    	echo '成功分红会员'.$fhgs.'个,出局会员'.$cjgs;
    }
    }
}