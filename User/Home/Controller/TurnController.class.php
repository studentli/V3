<?php

namespace Home\Controller;

use Think\Controller;

class TurnController extends CommonController {
	// 首页
	public function index() {
		$config = M('turn')->find();
        $money=M('user')->where(array('UE_account'=>$_SESSION['uname']))->getField('ue_money');
        //dump($money);
        if($money<$config['consume']){
        	die("<script>alert('您的余额不足，请及时充值！');history.back(-1);</script>");
        }

		$config['turn_v'] = json_decode($config['turn_v']);
		$config['turn_num'] = json_decode($config['turn_num']);
		$list = M('turn_log')->where(array('uid'=>$_SESSION['uid']))->select();
		$news = M('info')->where(array('IF_type'=>'dzp'))->order('IF_ID DESC')->find();
		$this->assign('news',$news);
		$this->assign('config',$config);
		$this->assign('list',$list);
		$this->display('turn');
	}
	
	function get_v(){
		$config = M('turn')->find();
		$v = json_decode($config['turn_v']);
		$num = json_decode($config['turn_num']);
		$result['switch'] = $config['switch'];
		$usermoney = M('user')->where(array('UE_account'=>session('uname')))->getField('UE_money');
		if($config['consume']>$usermoney){
		    echo json_encode(['status'=>0,'info'=>'余额不足']);exit;
		}
		if($config['switch']){
			$prize_arr = array( 
				'0' => array('id'=>1,'min'=>array(0,330),'max'=>array(30,360),'prize'=>'一等奖','v'=>$v[0]), 
				'1' => array('id'=>2,'min'=>32,'max'=>88,'prize'=>'二等奖','v'=>$v[1]), 
				'2' => array('id'=>3,'min'=>92,'max'=>148,'prize'=>'三等奖','v'=>$v[2]), 
				'3' => array('id'=>5,'min'=>212,'max'=>268,'prize'=>'四等奖','v'=>$v[3]), 
				'4' => array('id'=>6,'min'=>272,'max'=>328,'prize'=>'五等奖','v'=>$v[4]),
			  '5' => array('id'=>4,'min'=>152,'max'=>208,'prize'=>'谢谢参与','v'=>$v[5]),
			); 
			
			foreach ($prize_arr as $key => $val) { 
				$arr[$val['id']] = $val['v']; 
			} 
			$rid = getTurnRand($arr); //根据概率获取奖项id 
			 
			$res = $prize_arr[$rid-1]; //中奖项 
			$min = $res['min']; 
			$max = $res['max']; 
			if($res['id']==1){ //谢谢参与奖 
				$i = mt_rand(1,2); 
				$result['angle'] = mt_rand($min[$i],$max[$i]); 
			}else{ 
				$result['angle'] = mt_rand($min,$max); //随机生成一个角度 
			} 
			$result['prize'] = $res['prize'];
		
			$data['uid'] = $_SESSION['uid'];
			$data['consume'] = $config['consume'];
			$data['reward_id'] = $rid;
			$data['reward_num'] = $num[($rid-1)];
			$data['addtime'] = time();
			if($res['id']!=1){
			    //消耗
			    $user = M('user')->where(array('UE_account'=>session('uname')))->find();
			    $record4 ["UG_allGet"] = $user['ue_money'];
			    M('user')->where(array('UE_ID'=>$_SESSION['uid']))->setDec('UE_money',$config['consume']);
			    $user_after = M('user')->where(array('UE_account'=>session('uname')))->getField('UE_money');
			    $record4 ["UG_balance"] = $user_after;
			    $record4 ["UG_othraccount"] = 1;
			    $time=date('Y-m-d H:i:s',time());
			    $record4 ["UG_account"] = $_SESSION['uname']; // 登入轉出賬戶
			    $record4 ["UG_type"] = 'jb';
			    $record4 ["UG_money"] = -$config['consume']; //
			    $record4 ["UG_dataType"] = 'jtj'; // 金幣轉出
			    $record4 ["UG_note"] = '大转盘抽奖消耗'; // 推薦獎說明
			    $record4['status'] = 1;
			    $record4["UG_getTime"] = date ('Y-m-d H:i:s', time ()); //操作時間
			    $record4['wallettype'] = 1;
			    $reg4 = M ('userget' )->add ($record4);
			    //奖励入到静态钱包
			    $user = M('user')->where(array('UE_account'=>session('uname')))->find();
			    $record3 ["UG_allGet"] = $user['ue_money'];
			    M('user')->where(array('UE_ID'=>$_SESSION['uid']))->setInc('UE_money',$num[($rid-1)]);
			    $user_after = M('user')->where(array('UE_account'=>session('uname')))->getField('UE_money');
			    $record3 ["UG_balance"] = $user_after;
			    $record3 ["UG_othraccount"] = 1;
			    $time=date('Y-m-d H:i:s',time());
			    $record3 ["UG_account"] = $_SESSION['uname']; // 登入轉出賬戶
			    $record3 ["UG_type"] = 'jb';
			    $record3 ["UG_money"] = $num[($rid-1)]; //
			    $record3 ["UG_dataType"] = 'jtj'; // 金幣轉出
			    $record3 ["UG_note"] = '大转盘抽奖'; // 推薦獎說明
			    $record3['status'] = 1;
			    $record3["UG_getTime"] = date ('Y-m-d H:i:s', time ()); //操作時間
			    $record3['wallettype'] = 1;
			    $reg3 = M ('userget' )->add ($record3);
			    
			    
			    
			    
			}
			$turn_res = M('turn_log')->add($data);
		}

		echo json_encode($result); 
	}
	
}