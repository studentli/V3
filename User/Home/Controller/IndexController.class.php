<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends CommonController {
	// 首页
	public function index() {
		$this->redirect('/Home/Index/home');
	}
	
  public function uploadify()
    {
        if (!empty($_FILES)) {
            //图片上传设置
            $config = array(   
                'maxSize'    =>    3145728, 
                'savePath'   =>    '',  
                'saveName'   =>    array('uniqid',''), 
                'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),  
                'autoSub'    =>    true,   
                'subName'    =>    array('date','Ymd'),
            );
            $upload = new \Think\Upload($config);// 实例化上传类
            $images = $upload->upload();
            //判断是否有图
            if($images){
                $info=$images['file']['savepath'].$images['file']['savename'];
                //返回文件地址和名给JS作回调用
                echo $info;
            }
            else{
                //$this->error($upload->getError());//获取失败信息
            }
        }
    }
	public function qiandao(){
	  $settings = include( APP_PATH . 'Home/Conf/settings.php' );
	  if(!session('?uname')){
	      $this->error('请登录',U('Home/Login/login'));exit;
	  }
		$qdModel = M ( 'qiandao' ); // 实例化User对象
		$data['UE_account']=$_SESSION['uname'];
		$data['time']=date('Y-m-d 00:00:00',time());
		$info = $qdModel->where($data)->find();
		if($info){
		    die("<script>alert('您已经签过到了！');history.back(-1);</script>");
		}
		$data['money']=$settings['qdjl'];
		$re=$qdModel->add($data);
		if($re){
		    $user = M('user')->where(array('UE_account'=>$_SESSION['uname']))->find;
		    $user = M('user')->where(array('UE_account'=>$_SESSION['uname']))->setInc('UE_money',$data['money']);
		    $user_after = M('user')->where(array('UE_account'=>$_SESSION['uname']))->getField('UE_money'); 
		    $record3 ["UG_allGet"] = $user['ue_money'];
		    $record3 ["UG_balance"] = $user_after;
		    $record3 ["UG_othraccount"] = 1;
		    $time=date('Y-m-d H:i:s',time());
		     
		    $record3 ["UG_account"] = $_SESSION['uname']; // 登入轉出賬戶
		    $record3 ["UG_type"] = 'jb';
		     
		    $record3 ["UG_money"] = $data['money']; //
		    $record3 ["UG_dataType"] = 'jtj'; // 金幣轉出
		     
		    $record3 ["UG_note"] = '静态签到奖励'; // 推薦獎說明
		    $record3['status'] = 1;
		    $record3["UG_getTime"] = date ('Y-m-d H:i:s', time ()); //操作時間
		    $record3['wallettype'] = 1;
		    $reg3 = M ('userget' )->add ($record3);
			 die("<script>alert('签到成功,获得".$data['money']."金币!');history.back(-1);</script>");
		}
	}
	
	public function home() {
// 		membership_upgrade($_SESSION['uname']);
		$num = auto_match();
		$user = $_SESSION['uname'];
		
		$User = M ( 'tgbz' ); // 实例化User对象
		
		$map['user']=$_SESSION['uname'];
		$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
		
		$p = getpage($count,100);
		
		$list = $User->where ( $map )->order ( 'id DESC' )->limit ( $p->firstRow, $p->listRows )->select ();
		foreach($list as $k=>$v){
			$pdtime=$v['date2'];
			$time=date('Y-m-d',time());
			$pdtime=date('Y-m-d',strtotime("$pdtime -1 days"));
			$cha=diffBetweenTwoDays($pdtime,$time);
			
			$list[$k]['date2']=$cha;
		}
		$this->assign("tgbzCount",$count);
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $p->show() ); // 赋值分页输出
		$User = M ( 'jsbz' ); // 实例化User对象
		
		$map1['user']=$_SESSION['uname'];
		$count1 = $User->where ( $map1 )->count (); // 查询满足要求的总记录数
		
		$p1 = getpage($count1,100);
		
		$list1 = $User->where ( $map1 )->order ( 'id DESC' )->limit ( $p1->firstRow, $p1->listRows )->select ();
		foreach($list1 as $k=>$v){
			$pdtime=$v['date'];
			$time=date('Y-m-d',time());
			$pdtime=date('Y-m-d',strtotime($pdtime));
			$cha=diffBetweenTwoDays($pdtime,$time);
			
			$list1[$k]['date1']=$cha;
		}
		$this->assign('jsbzCount',$count1);
		$this->assign ( 'list1', $list1 ); // 赋值数据集
		$this->assign ( 'page1', $p1->show() ); // 赋值分页输出
		$User = M ( 'ppdd' ); // 实例化User对象
		
		$map2['p_user']=$_SESSION['uname'];
		$count2 = $User->where ( $map2 )->count (); // 查询满足要求的总记录数
		
		$p2 = getpage($count2,100);
		
		$list2 = $User->where ( $map2 )->order ( 'id DESC' )->limit ( $p2->firstRow, $p2->listRows )->select ();
		$this->assign ( 'list2', $list2 ); // 赋值数据集
		$this->assign ( 'page2', $p2->show() ); // 赋值分页输出
		/////////////////----------------
		$mp['UE_account'] = $_SESSION['uname'];
		$pd = M('user')->where($mp)->find();
		//dump($pd);die();
		$pdb = $pd['ue_pdb'];
		$this->assign("pdb",$pdb);
		
		//////////////////----------
		$User = M ( 'ppdd' ); // 实例化User对象
		
		$map3['g_user']=$_SESSION['uname'];
		// $map3['zt']=array('neq',2);
		$count3 = $User->where ( $map3 )->count (); // 查询满足要求的总记录数
		
		$p3 = getpage($count3,100);
		
		$list3 = $User->where ( $map3 )->order ( 'id DESC' )->limit ( $p3->firstRow, $p3->listRows )->select ();
		$this->assign ( 'list3', $list3 ); // 赋值数据集
		$this->assign ( 'page3', $p3->show() ); // 赋值分页输出
		$tdrenshu=0;
		xiajirenshu($_SESSION ['uname'],$tdrenshu);
		$this->assign('tdrenshu',$tdrenshu);
		 $waitactCount= M('user')->where(array('UE_accName'=>$_SESSION ['uname'],'UE_status'=>array('neq',0)))->count();
		 $this->assign('waitactCount',$waitactCount);
		if(session('?uid')){
		    $user = M ( 'user' )->where (array('UE_account' => $_SESSION ['uname']))->find ();
		    if($user['zfb']=='' || $user['yhzh']=='' || $user['weixin']==''){
		        $this->assign('wszl',1);
		    }else{
		        $this->assign('wszl',0);
		    }
		    $this->display('home');
		}else{
		    $settings = include( APP_PATH . 'Home/Conf/settings.php' );
		    $this->assign('settings',$settings);
		    $this->display ( 'index' );
		}
		
	}
	// 注册模块
	public function reg() {
		//////////////////----------
		$User = M ( 'user' ); // 实例化User对象
		$qrcode = prcode_create('reg',"http://".$_SERVER['SERVER_NAME']."/Home/Login/register?phone=".$this->userData['ue_phone']);
	
			$map['zcr']=$_SESSION['uname'];
		$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)
		
		$p = getpage($count,20);
		$_SESSION['token'] = md5(rand(255,100000).'%*%'.rand(1,100));
		$list = $User->where ( $map )->order ( 'UE_ID DESC' )->limit ( $p->firstRow, $p->listRows )->select ();
		$this->assign ('list', $list); // 赋值数据集
		$this->assign ( 'page', $p->show() ); // 赋值分页输出
		/////////////////----------------
		
		$this->email=sprintf("%0".strlen(9)."d", mt_rand(0,99999999999)).'@qq.com';
		
		$pin1=M('pin')->where(array('user'=>$_SESSION['uname'],'zt'=>'0'))->find();
		$this->moren = $_SESSION ['uname'];
		$this->assign('qrcode',$qrcode);
		$this->assign('token',$_SESSION['token']);
		$this->assign('pin1',$pin1);
		$this->display ( 'reg' );
	}
	
	// 添加会员
	public function regadd() {
			$data_P = I ('post.');
// 			if($_SESSION['smsnum'] != $data_P['yzm'] || $data_P['yzm']==''){
// 				die("<script>alert('验证码错误!');history.go(-1);</script>");
// 			}
			$tjr = M('user')->where(array('UE_account'=>$data_P ['pemail']))->find();
			if(!$tjr){
				die("<script>alert('推荐人不存在!');history.go(-1);</script>");
			}
			$data_arr ["UE_account"] = $data_P ['phone'];
			$data_arr ["UE_accName"] = $data_P ['pemail'];
			$data_arr ["UE_password"] = $data_P ['password'];
			$data_arr ["UE_repwd"] = $data_P ['password'];
			$data_arr ["UE_secpwd"] = $data_P ['ejmm'];
			$data_arr ["UE_resecpwd"] = $data_P ['ejmm'];
			$data_arr ["UE_status"] = '2'; // 用户状态
			$data_arr ["UE_level"] = '1'; // 用户等级
			$data_arr ["UE_check"] = '0'; // 是否通过验证
			$data_arr ["UE_truename"] = $data_P ['username'];
			$data_arr ["UE_phone"] = $data_P ['phone'];
			$data_arr ["yhzh"] = $data_P ['yhzh'];
			$data_arr ["yhmc"] = $data_P ['yhmc'];
			$data_arr ["weixin"] = $data_P ['weixin'];
			$data_arr ["zfb"] = $data_P ['zfb'];
			$data_arr ["UE_regIP"] = I ( 'post.ip' );
			$data_arr ["zcr"] = $_SESSION['uname'];
			$data_arr ["UE_regTime"] = date ( 'Y-m-d H:i:s', time () );
			$data_arr ["UE_regTime1"] = date ( 'Y-m-d H:i:s', time () );
			$data = D ('User');
			if ($data->create ( $data_arr )) {
				if(false){
					die("<script>alert('请先勾选,我已完全了解所有风险!');history.back(-1);</script>");
				}else{
					if ($data->add ()) {
						membership_upgrade($post_data['pemail']);
						vendor("Sendsms.sendsms");
						$send = new \Sendsms();
						if($data_P ['phone']) $mes = $send->my_send($data_P ['phone'], "恭喜您注册成功，请牢记您的账号" . $data_arr['UE_account'] . "，登录密码：" . $data_arr['UE_password'] . "，二级密码：" . $data_arr['UE_secpwd'] . "【V3财富】"); 
						
						die("<script>alert('注册成功!');window.location.href='/Home/Index/index';</script>");
							
					} else {
					
						die("<script>alert('注册会员失败,继续注册请刷新页面!');history.back(-1);</script>");
			
					}
				}
			} else {
				die("<script>alert('".$data->getError ()."');history.back(-1);</script>");

			}
	}
	
	

	public function reg2() {
	
			$this->data_P = I ( 'get.' );
			$this->display('reg2');
			
	}
	
	
	// 新闻列表页
	public function news() {
		$User = M ( 'info' ); // 实例化User对象
		$count = $User->where ( array (
				'IF_type' => 'news' 
		) )->count (); // 查询满足要求的总记录数
		$page = new \Think\Page ( $count, 20 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)
		                                       
		// $page->lastSuffix=false;
		$page->setConfig ( 'header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录    第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>' );
		$page->setConfig ( 'prev', '上一页' );
		$page->setConfig ( 'next', '下一页' );
		$page->setConfig ( 'last', '末页' );
		$page->setConfig ( 'first', '首页' );
		$page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
		
		$show = $page->show (); // 分页显示输出
    // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where ( array (
				'IF_type' => 'news' 
		) )->order ( 'IF_ID DESC' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $show ); // 赋值分页输出
		
		
		
		
		//////////////////----------
		$User = M ( 'info' ); // 实例化User对象
		
		$map1['IF_type']='bzzx';
		$count1 = $User->where ( $map1 )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)
		
		$p1 = getpage($count1,100);
		
		$list1 = $User->where ( $map1 )->order ( 'IF_ID DESC' )->limit ( $p1->firstRow, $p1->listRows )->select ();
		$this->assign ( 'list1', $list1 ); // 赋值数据集
		$this->assign ( 'page1', $p1->show() ); // 赋值分页输出
		
		
		
		
		$this->display ( 'news' ); // 输出模板
	}
	// 新闻内页
	public function newsPage() {
		header ( "Content-Type:text/html; charset=utf-8" );
		$id = I ( 'id' );
		$data = M ( 'info' )->where ( array (
				'IF_ID' => $id 
		) )->find ();
		$this->data = $data;
		$this->display ( 'news_con' );
	}
	// 帮助中心
	public function helpCenter() {
		header ( "Content-Type:text/html; charset=utf-8" );
		$User = M ( 'infoweb' ); // 实例化User对象
		$count = $User->where ( array (
				'IW_type' => 'bzzx' 
		) )->count (); // 查询满足要求的总记录数
		$page = new \Think\Page ( $count, 20 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)
		                                       
		// $page->lastSuffix=false;
		$page->setConfig ( 'header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录    第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>' );
		$page->setConfig ( 'prev', '上一页' );
		$page->setConfig ( 'next', '下一页' );
		$page->setConfig ( 'last', '末页' );
		$page->setConfig ( 'first', '首页' );
		$page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
		;
		
		$show = $page->show (); // 分页显示输出
		                        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where ( array (
				'IW_type' => 'bzzx' 
		) )->order ( 'IW_ID DESC' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $show ); // 赋值分页输出
		$this->display ( 'bzzx' ); // 输出模板
	}
	// 帮助中心内页
	public function helpCenterPage() {
		header ( "Content-Type:text/html; charset=utf-8" );
		$id = I ( 'id' );
		$data = M ( 'infoweb' )->where ( array (
				'IW_ID' => $id 
		) )->find ();
		$this->data = $data;
		$this->display ( 'bzzx_xx' );
	}
	// 新手入门
	public function novice() {
		header ( "Content-Type:text/html; charset=utf-8" );
		$data = M ( 'infoweb' )->where ( array (
				'IW_ID' => 11 
		) )->find ();
		$this->data = $data;
		$this->display ( 'bzzx_xx' );
	}
	// 安全中心
	public function safe() {
		
		$this->mbzt = M ( 'user' )->where ( array (UE_account => $_SESSION ['uname']) )->find ();
		
		$this->display ( 'zhaq' );
	}
	// 一键收币
	
	// 金币明细
	public function jbmx() {
		header ( "Content-Type:text/html; charset=utf-8" );
		$User = M ( 'userget' ); // 实例化User对象
		$date1 = I ( 'post.date1', '', '/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/' );
		$date2 = I ( 'post.date2', '', '/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/' );
		$map ['UG_account'] = $_SESSION ['uname'];
		$map ['UG_type'] = 'jb';
		//$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));
		
		if (! empty ( $date1 ) && ! empty ( $date2 )) {
			$map ['UG_getTime'] = array (
					array (
							'gt',
							$date1 
					),
					array (
							'lt',
							$date2 
					),
					'and' 
			);
		}
		$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
		$page = new \Think\Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)
		                                        
		// $page->lastSuffix=false;
		$page->setConfig ( 'header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录    第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>' );
		$page->setConfig ( 'prev', '上一页' );
		$page->setConfig ( 'next', '下一页' );
		$page->setConfig ( 'last', '末页' );
		$page->setConfig ( 'first', '首页' );
		$page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
		;
		
		$show = $page->show (); // 分页显示输出
		                        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where ( $map )->order ( 'UG_ID DESC' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $show ); // 赋值分页输出
		
		
		$ztj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'tjj'))->sum('UG_money');
		$ztj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'tjj'))->sum('UG_integral');
		$this->ztj = $ztj1+$ztj2;
		
		
		$bdj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'kdj'))->sum('UG_money');
		$bdj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'kdj'))->sum('UG_integral');
		$this->bdj = $bdj1+$bdj2;
		
		$fhj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrfh'))->sum('UG_money');
		$fhj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrfh'))->sum('UG_integral');
		$this->fhj = $fhj1+$fhj2;
		
		$ldj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrldj'))->sum('UG_money');
		$ldj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrldj'))->sum('UG_integral');
		$this->ldj = $ldj1+$ldj2;
		
		
		$glj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'glj'))->sum('UG_money');
		$glj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'glj'))->sum('UG_integral');
		$this->glj = $glj1+$glj2;
		
		
		
		
		$this->display ( 'jbmx' ); // 输出模板
	}
	
	public function ybmx() {
		header ( "Content-Type:text/html; charset=utf-8" );
		$User = M ( 'userget' ); // 实例化User对象
		$date1 = I ( 'post.date1', '', '/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/' );
		$date2 = I ( 'post.date2', '', '/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/' );
		$map ['UG_account'] = $_SESSION ['uname'];
		$map ['UG_type'] = 'yb';
		//$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));
	
		if (! empty ( $date1 ) && ! empty ( $date2 )) {
			$map ['UG_getTime'] = array (
					array (
							'gt',
							$date1
					),
					array (
							'lt',
							$date2
					),
					'and'
			);
		}
		$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
		$page = new \Think\Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)
	
		// $page->lastSuffix=false;
		$page->setConfig ( 'header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录    第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>' );
		$page->setConfig ( 'prev', '上一页' );
		$page->setConfig ( 'next', '下一页' );
		$page->setConfig ( 'last', '末页' );
		$page->setConfig ( 'first', '首页' );
		$page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
		;
	
		$show = $page->show (); // 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where ( $map )->order ( 'UG_ID DESC' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $show ); // 赋值分页输出
	
	
		$ztj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'tjj'))->sum('UG_money');
		$ztj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'tjj'))->sum('UG_integral');
		$this->ztj = $ztj1+$ztj2;
	
	
		$bdj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'kdj'))->sum('UG_money');
		$bdj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'kdj'))->sum('UG_integral');
		$this->bdj = $bdj1+$bdj2;
	
		$fhj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrfh'))->sum('UG_money');
		$fhj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrfh'))->sum('UG_integral');
		$this->fhj = $fhj1+$fhj2;
	
		$ldj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrldj'))->sum('UG_money');
		$ldj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrldj'))->sum('UG_integral');
		$this->ldj = $ldj1+$ldj2;
	
	
		$glj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'glj'))->sum('UG_money');
		$glj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'glj'))->sum('UG_integral');
		$this->glj = $glj1+$glj2;
	
	
	
	
		$this->display ( 'ybmx' ); // 输出模板
	}
	
	public function zsbmx() {
		header ( "Content-Type:text/html; charset=utf-8" );
		$User = M ( 'userget' ); // 实例化User对象
		$date1 = I ( 'post.date1', '', '/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/' );
		$date2 = I ( 'post.date2', '', '/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/' );
		$map ['UG_account'] = $_SESSION ['uname'];
		$map ['UG_type'] = 'zsb';
		//$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));
	
		if (! empty ( $date1 ) && ! empty ( $date2 )) {
			$map ['UG_getTime'] = array (
					array (
							'gt',
							$date1
					),
					array (
							'lt',
							$date2
					),
					'and'
			);
		}
		$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
		$page = new \Think\Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)
	
		// $page->lastSuffix=false;
		$page->setConfig ( 'header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录    第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>' );
		$page->setConfig ( 'prev', '上一页' );
		$page->setConfig ( 'next', '下一页' );
		$page->setConfig ( 'last', '末页' );
		$page->setConfig ( 'first', '首页' );
		$page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
		;
	
		$show = $page->show (); // 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where ( $map )->order ( 'UG_ID DESC' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $show ); // 赋值分页输出
	
	
		$ztj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'tjj'))->sum('UG_money');
		$ztj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'tjj'))->sum('UG_integral');
		$this->ztj = $ztj1+$ztj2;
	
	
		$bdj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'kdj'))->sum('UG_money');
		$bdj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'kdj'))->sum('UG_integral');
		$this->bdj = $bdj1+$bdj2;
	
		$fhj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrfh'))->sum('UG_money');
		$fhj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrfh'))->sum('UG_integral');
		$this->fhj = $fhj1+$fhj2;
	
		$ldj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrldj'))->sum('UG_money');
		$ldj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrldj'))->sum('UG_integral');
		$this->ldj = $ldj1+$ldj2;
	
	
		$glj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'glj'))->sum('UG_money');
		$glj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'glj'))->sum('UG_integral');
		$this->glj = $glj1+$glj2;
	
	
	
	
		$this->display ( 'zsbmx' ); // 输出模板
	}
	
	
	// 奖金明细
	public function jjjl() {
		header ( "Content-Type:text/html; charset=utf-8" );
		$User = M ( 'userget' ); // 实例化User对象
		$date1 = I ( 'post.date1', '', '/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/' );
		$date2 = I ( 'post.date2', '', '/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/' );
		$map ['UG_account'] = $_SESSION ['uname'];
		$map ['UG_dataType'] = array('IN',array('mrfh','tjj','tjj1','tjj2','tjj3','bdj','mrldj'));
	
		if (! empty ( $date1 ) && ! empty ( $date2 )) {
			$map ['UG_getTime'] = array (
					array (
							'gt',
							$date1
					),
					array (
							'lt',
							$date2
					),
					'and'
			);
		}
		
		//$map  = array('tjj','kdj','glj');
		//	$map['UE_Faccount']  = $_SESSION ['uname']
		//$ljtc1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>array('IN',$map)))->sum('UG_money');
		
		$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
		$page = new \Think\Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)
	
		// $page->lastSuffix=false;
		$page->setConfig ( 'header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录    第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>' );
		$page->setConfig ( 'prev', '上一页' );
		$page->setConfig ( 'next', '下一页' );
		$page->setConfig ( 'last', '末页' );
		$page->setConfig ( 'first', '首页' );
		$page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
		;
	
		$show = $page->show (); // 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where ( $map )->order ( 'UG_ID DESC' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $show ); // 赋值分页输出
		
		
// 		$ztj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'tjj'))->sum('UG_money');
// 		$ztj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'tjj'))->sum('UG_integral');
// 		$this->ztj = $ztj1+$ztj2;
		
		
// 		$bdj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'kdj'))->sum('UG_money');
// 		$bdj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'kdj'))->sum('UG_integral');
// 		$this->bdj = $bdj1+$bdj2;
		
// 		$fhj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrfh'))->sum('UG_money');
// 		$fhj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrfh'))->sum('UG_integral');
// 		$this->fhj = $fhj1+$fhj2;
		
// 		$ldj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrldj'))->sum('UG_money');
// 		$ldj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'mrldj'))->sum('UG_integral');
// 		$this->ldj = $ldj1+$ldj2;
		
		
// 		$glj1 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'glj'))->sum('UG_money');
// 		$glj2 = M('userget')->where(array('UG_account'=>$_SESSION ['uname'],'UG_dataType'=>'glj'))->sum('UG_integral');
// 		$this->glj = $glj1+$glj2;
		
		
		
		$this->display ( 'jjjl' ); // 输出模板
	}
	
	// 金币转账
	public function jbzz() {
		header ( "Content-Type:text/html; charset=utf-8" );
		$userData = M ( 'user' )->where ( array (
				'UE_account' => $_SESSION ['uname'] 
		) )->find ();
		$this->userData = $userData;
		$this->display ( 'jbzz' );
	}
	// 金币转账处理
public function jbzzcl() {
		if (IS_POST) {
			$pin_zs=M('pin')->where ( array('user'=>$_SESSION['uname'],'zt'=>0) )->count ();
			$data_P = I ( 'post.' );
			$user_df = M ( 'user' )->where ( array (UE_account => $data_P['user']) )->find ();

			$userxx=M('user')->where(array('UE_account'=>$_SESSION['uname']))->find();

			if($userxx['ue_secpwd']<>md5($data_P['ejmm'])){
				die("<script>alert('二级密码输入有误！');history.back(-1);</script>");
			}else{
			
			
			$jbhe=$data_P ['sh'];
			if (! preg_match ( '/^[0-9]{1,10}$/', $data_P ['sh'] )||!$data_P ['sh']>0) {
				die("<script>alert('数量输入有勿！');history.back(-1);</script>");
			} elseif ($pin_zs < $jbhe) {
				die("<script>alert('激活码数量不足！');history.back(-1);</script>");
			}elseif (!$user_df) {
				die("<script>alert('对方账号不存在！');history.back(-1);</script>");
			}else {
				
				$pin_zs_df=M('pin')->where ( array('user'=>$data_P['user'],'zt'=>0) )->count ();
				for ($i=0;$i<$data_P ['sh'];$i++){
					$pin_xx=M('pin')->where ( array('user'=>$_SESSION['uname'],'zt'=>0) )->find();
					M('pin')->where ( array('id'=>$pin_xx['id'],'zt'=>0) )->save(array('user'=>$data_P['user']));
				}
				
				$pin_zs_xz=M('pin')->where ( array('user'=>$_SESSION['uname'],'zt'=>0) )->count ();
				$pin_zs_df_xz=M('pin')->where ( array('user'=>$data_P['user'],'zt'=>0) )->count ();
				
				$note3 = "激活码转出";
				$record3 ["UG_account"] = $_SESSION['uname']; // 登入转出账户
				$record3 ["UG_type"] = 'mp';
				$record3 ["UG_allGet"] = $pin_zs; // 金币
				$record3 ["UG_money"] = '-'.$jbhe; //
				$record3 ["UG_balance"] = $pin_zs_xz; // 当前推荐人的金币馀额
				$record3 ["UG_dataType"] = 'jbzc'; // 金币转出
				$record3 ["UG_note"] = $note3; // 推荐奖说明
				$record3["UG_getTime"]		= date ( 'Y-m-d H:i:s', time () ); //操作时间
				$record3['UG_othraccount'] = $data_P['user'];
				$reg4 = M ( 'userget' )->add ( $record3 );
				
				$note3 = "激活码转入";
				$record3 ["UG_account"] = $data_P['user']; // 登入转出账户
				$record3 ["UG_type"] = 'mp';
				$record3 ["UG_allGet"] = $pin_zs_df; // 金币
				$record3 ["UG_money"] = '+'.$jbhe; //
				$record3 ["UG_balance"] = $pin_zs_df_xz; // 当前推荐人的金币馀额
				$record3 ["UG_dataType"] = 'jbzr'; // 金币转出
				$record3 ["UG_note"] = $note3; // 推荐奖说明
				$record3["UG_getTime"]		= date ( 'Y-m-d H:i:s', time () ); //操作时间
				$record3['UG_othraccount'] = $data_P['user'];
				$reg4 = M ( 'userget' )->add ( $record3 );
				
				
				$this->success('转让成功!');
			}
			}
		}
	}
	public function ldtj() {
		if(IS_AJAX){
			//$this->ajaxReturn ( array ('nr' => '验证码错误!','sf' => 0 ) );
			if (false) {
				$this->ajaxReturn ( array ('nr' => '验证码错误!','sf' => 0 ) );
			}else {
			
		$user = M('user');
		$ztname=$user->where(array('UE_accName'=>$_SESSION ['uname'],'UE_Faccount'=>'0','UE_check'=>'1','UE_stop'=>'1'))->getField('ue_account',true);
		$zttj = count($ztname);
		$reg=$ztname;
		$datazs = $zttj;
		if($zttj<=10){
			$s=$zttj;
		}else{
			$s=10;
		}
		if($zttj!=0){

		  for($i=1;$i<$s;$i++){
				if($reg!=''){
					$reg=$user->where(array('UE_accName'=>array('IN',$reg),'UE_Faccount'=>'0','UE_check'=>'1','UE_stop'=>'1'))->getField('ue_account',true);
					$datazs +=count($reg);
				}
			}
			
		}
		
		$this->ajaxReturn(array ('nr' => $datazs,'sf' => 0 ) );
			}
		}
		
	}
	public function zzjl() {
		$User = M ( 'userjyinfo' ); // 实例化User对象
		
	$map ['UJ_usercount'] = $_SESSION ['uname'];
	$map ['UJ_dataType'] = 'zs';
	
	
	
	
	$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
	//dump($var)
	$page = new \Think\Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)
	
	// $page->lastSuffix=false;
	$page->setConfig ( 'header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录    第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>' );
	$page->setConfig ( 'prev', '上一页' );
	$page->setConfig ( 'next', '下一页' );
	$page->setConfig ( 'last', '末页' );
	$page->setConfig ( 'first', '首页' );
	$page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
	;
	
	$show = $page->show (); // 分页显示输出
	// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
	$list = $User->where ( $map )->order ( 'UJ_ID DESC' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
	
	//dump($list);die;
	
	$this->assign ( 'list', $list ); // 赋值数据集
	$this->assign ( 'page', $show ); // 赋值分页输出
	$this->display ( 'zzjl' );
	}

	public function tgbzcl() {
	    $settings = include( APP_PATH . 'Home/Conf/settings.php' );
	    if(!$settings['pipei']){
	        die("<script>alert('小伙伴今日额度已满，请改日再来！');history.back(-1);</script>");
	    }
		if (IS_POST) {
		        //引入分成管理文件
				$data_P = I ( 'post.' );
				
				$user = M ( 'user' )->where (array('UE_account' => $_SESSION ['uname']))->find ();
				if($user['ue_secpwd'] != md5($data_P['secpwd'])){
				    die("<script>alert('二级密码错误！');history.back(-1);</script>");
				}
        if($user['zfb']=='' || $user['yhzh']=='' || $user['weixin']==''){
            die("<script>alert('请先去完善个人资料！');history.back(-1);</script>");
                }
               
                //当天排单总额
        $min = date('Y-m-d 00:00:00');
        $max = date('Y-m-d 23:59:59');
 
        $map['date']=array(array('gt',$min),array('lt',$max));
        $todaymoney = M('tgbz')->where(array('date'=>$map['date']))->getField('sum(jb)');

        if(($todaymoney*1) >= $settings['tgbz_jb']){
            die("<script>alert('今天预约额度已满,请明天继续！');window.location.href='/';</script>");
                }
                //所选择的区域
        $qy = $data_P['qy'];
				$chine = $data_P ['amount'];
				$num = 0;
				//根据所在区，确定需要的排单币数量
				if($qy == 1){
				    $num = $settings['ty_xy_pdb'];
				}
				if($qy == 2){
				    $num = $settings['baiyin_xy_pdb'];
				}
				if($qy == 3){
				    $num = $settings['huangjin_xy_pdb'];
				}
				if($qy == 4){
				    $num = $settings['zuanshi_xy_pdb'];
				}
				if($num > $user['ue_pdb']){
				    die("<script>alert('排单币数量不足！');history.back(-1);</script>");
				}
             

        $tg_money = M('tgbz')->where(array('user'=>$_SESSION['uname'],'zt'=>1,'qr_zt'=> 1))->order('date desc')->getField('yjb');
// 				if($data_P ['amount'] < $tg_money){
//                     die("<script>alert('每次下单金额不得小于上一次订单金额！');history.back(-1);</script>");
//                 }
				$tgcount=M('tgbz')->where(array('user'=>$_SESSION['uname'],'zt'=>0))->count();
				$ppcount=M('ppdd')->where(array('p_user'=>$_SESSION['uname'],'zt'=>0))->count();
				if($tgcount>0||$ppcount>0){
					die("<script>alert('您有未匹配或未打款的订单!');history.go(-1);</script>");
				}
				
// 				if($user['ue_level'] == 1){
// 					if(($data_P ['amount']<1000) || ($data_P ['amount'] > 5000)){
// 						die("<script>alert('白银会员积分金额在1000-3000之间！');history.back(-1);</script>");
// 					}
// 				}
// 				if($user['ue_level'] == 2){
// 					if(($data_P ['amount']<10000) || ($data_P ['amount'] > 20000)){
// 						die("<script>alert('黄金会员积分金额在10000-2000之间！！');history.back(-1);</script>");
// 					}
// 				}
// 				if($user['ue_level'] == 3){
// 					if(($data_P ['amount']<30000) || ($data_P ['amount'] > 50000)){
// 						die("<script>alert('白银会员积分金额在30000-50000之间！！');history.back(-1);</script>");
// 					}
// 				}
        if($qy == 1){
            if(($data_P ['amount']!=1000)){
                						die("<script>alert('体验区积分金额在1000！');history.back(-1);</script>");
                					}
        }
        if($qy == 2){
            if(($data_P ['amount']<2000) || ($data_P ['amount'] > 5000)){
                						die("<script>alert('白银会员积分金额在2000-5000之间！');history.back(-1);</script>");
                					}
        }
        
        if($qy == 3){
            if(($data_P ['amount']<6000) || ($data_P ['amount'] > 10000)){
                						die("<script>alert('白银会员积分金额在6000-10000之间！');history.back(-1);</script>");
                					}
        }
        if($qy == 4){
            if(($data_P ['amount']<11000) || ($data_P ['amount'] > 12000)){
                						die("<script>alert('白银会员积分金额在11000-12000之间！');history.back(-1);</script>");
                					}
        }
				if ($data_P ['zffs1']<>'1'&&$data_P ['zffs2']<>'1'&&$data_P ['zffs3']<>'1') {
					  die("<script>alert('至少选择一个收款方式！');history.back(-1);</script>");
				}elseif ($data_P ['amount']%$settings['jifen_count'] > 0) {
					  die("<script>alert('买入积分金额必须是".$settings['jifen_count']."的倍数！');history.back(-1);</script>");
				} else {
          if($data_P ['zffs1']=='1'){$data['zffs1']='1';}else{$data['zffs1']='0';}
          if($data_P ['zffs2']=='1'){$data['zffs2']='1';}else{$data['zffs2']='0';}
          if($data_P ['zffs3']=='1'){$data['zffs3']='1';}else{$data['zffs3']='0';}
					$data['user']=$_SESSION ['uname'];
					$data['jb']=$data_P ['amount'];
					$data['user_nc']=$user['ue_theme'];
					$data['user_tjr']=$user['ue_accname'];
					$data['date']=date ( 'Y-m-d H:i:s', time () );
					$data['zt'] = 0;
					$data['yjb'] = $data_P ['amount'];
					$data['qr_zt'] = 0;
					$data['date1']=date('Y-m-d H:i:s',time());
					$data['date2']=date('Y-m-d H:i:s',time());
					$data['qy'] = $qy;
					if($tgbz_id = M('tgbz')->add($data)){
                         //减少排单币
                         M("user")->where(array("UE_account"=>$user['ue_account']))->setDec("ue_pdb",$num);
                         //增加商城积分
//                          M("user")->where(array("UE_account"=>$user['ue_account']))->setInc("shop_money",$num*$settings['pd_price']);
						//增加利息数据
						$data2['user']=$data['user'];
						$data2['zt']=2;
						$data2['date']=$data['date'];
						$data2['note']='买入积分';
						$data2['jb']=$data['jb']; 
						$data2['tgbz_id']=$tgbz_id; 
						M('user_jj')->add($data2);
						die("<script>alert('提交成功！');window.location.href='/';</script>");
					}else{
						die("<script>alert('提交失败！');history.back(-1);</script>");
					}
				}
            }else{
                $this->assign('settings',$settings);
                $this->display('offer_help');
                
            }
		}

        public  function buy_record(){
            $User = M ('tgbz'); //接受帮助列表
            $map1['user']=$_SESSION['uname'];
            $map1['zt'] = '0';
            $count1 = $User->where ($map1)->count();
            $p1 = getpage($count1,100);
            $list1 = $User->where ( $map1 )->order ( 'id DESC' )->limit ( $p1->firstRow, $p1->listRows )->select ();
            foreach($list1 as $k=>$v){
                $pdtime=$v['date'];
                $time=date('Y-m-d',time());
                $pdtime=date('Y-m-d',strtotime($pdtime));
                $cha=diffBetweenTwoDays($pdtime,$time);
                $list1[$k]['date1']=$cha;
            }
            $this->assign ( 'list', $list1 );
            $this->assign ( 'page1', $p1->show());
            $this->display ('sqbz');
        }
	
	public function jsbzcl() {
		if (IS_POST) {
			$settings = include( APP_PATH . 'Home/Conf/settings.php' );
			$data_P = I ( 'post.' );
            if ($data_P ['zffs1']<>'1' && $data_P ['zffs2']<>'1'&&$data_P ['zffs3']<>'1') {
                die("<script>alert('至少选择一种收款方式！');history.back(-1);</script>");
            }
			$user = M ( 'user' )->where ( array ('UE_account' => $_SESSION['uname']))->find ();
			if($data_P['moneytype'] == 1){//静态积分卖出
                if ($data_P ['get_amount']% $settings['tx_jtjj'] > 0) {
                    die("<script>alert('静态积分卖出必须是".$settings['tx_jtjj']."的倍数！！');history.back(-1);</script>");
                } elseif ($user['ue_money'] < $data_P ['get_amount']) {
                    die("<script>alert('余额不足！');history.back(-1);</script>");
                } else {
                    if($data_P ['zffs1']=='1'){$data['zffs1']='1';}else{$data['zffs1']='0';}
                    if($data_P ['zffs2']=='1'){$data['zffs2']='1';}else{$data['zffs2']='0';}
                    if($data_P ['zffs3']=='1'){$data['zffs3']='1';}else{$data['zffs3']='0';}
                    $data['user']=$user['ue_account'];
                    $data['jb']=$data_P ['get_amount'];
                    $data['user_nc']=$user['ue_theme'];
                    $data['user_tjr']=$user['ue_accname'];
                    $data['date']=date ( 'Y-m-d H:i:s', time () );
                    $data['zt']=0;
                    $data['qr_zt']=0;
                    $data['date1']=date ( 'Y-m-d H:i:s', time () );
                    $user_zq=M('user')->where(array('UE_ID'=>$_SESSION['uid']))->find();
                    M('user')->where(array('UE_account' => $_SESSION ['uname']))->setDec('UE_money',$data_P ['get_amount']);

                    $user_xz=M('user')->where(array('UE_ID'=>$_SESSION['uid']))->find();
                    $note3 = "静态积分卖出扣款";
                    $record3 ["UG_account"] = $_SESSION['uname']; // 登入转出账户
                    $record3 ["UG_type"] = 'jb';
                    $record3 ["UG_allGet"] = $user_zq['ue_money']; // 金币
                    $record3 ["UG_money"] = '-'.$data_P ['get_amount']; //
                    $record3 ["UG_balance"] = $user_xz['ue_money']; // 当前推荐人的金币馀额
                    $record3 ["UG_dataType"] = 'jsbz'; // 金币转出
                    $record3 ["UG_note"] = $note3; // 推荐奖说明
                    $record3["UG_getTime"]		= date ( 'Y-m-d H:i:s', time () ); //操作时间
                    $reg4 = M ( 'userget' )->add ( $record3 );

                    if(M('jsbz')->add($data)){
                        die("<script>alert('提交成功！');window.location.href='/';</script>");
                    }else{
                        die("<script>alert('提交失败！');history.back(-1);</script>");
                    }
                }

			}elseif ($data_P['moneytype']==2){//动态积分卖出

                $tg_jb = M('jsbz')->where(array('user'=>$_SESSION['uname'],'zt'=>1,'qr_zt'=>1))->order('date desc')->getField('jb');
                if($data_P ['get_amount'] > $tg_jb){
                    die("<script>alert('动态奖金每次提取额度，不得高于该账户最近单笔投资额！！');history.back(-1);</script>");
                }
                if($data_P ['get_amount'] < $settings['tx_dtjj']){
                    die("<script>alert('动态积分卖出数量不能低于".$settings['tx_dtjj']."！');history.back(-1);</script>");
                } elseif ($data_P ['get_amount']% $settings['tx_dtjj_beishu'] > 0) {
                    die("<script>alert('动态积分卖出数量不能低于".$settings['tx_dtjj']."！必须是".$settings['tx_dtjj_beishu']."的倍数！！');history.back(-1);</script>");
                } elseif ($user['tj_he'] < $data_P ['get_amount']) {
                    die("<script>alert('余额不足！');history.back(-1);</script>");
                } else {

                    if($data_P ['zffs1']=='1'){$data['zffs1']='1';}else{$data['zffs1']='0';}
                    if($data_P ['zffs2']=='1'){$data['zffs2']='1';}else{$data['zffs2']='0';}
                    if($data_P ['zffs3']=='1'){$data['zffs3']='1';}else{$data['zffs3']='0';}
                    $data['user']=$user['ue_account'];
                    $data['jb'] = $data_P['get_amount'];
                    $data['user_nc']=$user['ue_theme'];
                    $data['user_tjr']=$user['ue_accname'];
                    $data['date']=date ( 'Y-m-d H:i:s', time () );
                    $data['zt']=0;
                    $data['qr_zt']=0;
                    $data['date1']=date ( 'Y-m-d H:i:s', time () );
                    $user_zq=M('user')->where(array('UE_ID'=>$_SESSION['uid']))->find();
                    M('user')->where(array('UE_account' => $_SESSION ['uname']))->setDec('tj_he',$data_P ['get_amount']);

                    $user_xz=M('user')->where(array('UE_ID'=>$_SESSION['uid']))->find();
                    $note3 = "动态积分卖出扣款";
                    $record3 ["UG_account"] = $_SESSION['uname']; // 登入转出账户
                    $record3 ["UG_type"] = 'jb';
                    $record3 ["UG_allGet"] = $user_zq['tj_he']; // 金币
                    $record3 ["UG_money"] = '-'.$data_P ['get_amount']; //
                    $record3 ["UG_balance"] = $user_xz['tj_he']; // 当前推荐人的金币馀额
                    $record3 ["UG_dataType"] = 'jsbz'; // 金币转出
                    $record3 ["UG_note"] = $note3; // 推荐奖说明
                    $record3["UG_getTime"]		= date ( 'Y-m-d H:i:s', time () ); //操作时间
                    M ('userget')->add ( $record3 );
                    if(M('jsbz')->add($data)){
                        die("<script>alert('提交成功！');window.location.href='/';</script>");
                    }else{
                        die("<script>alert('提交失败！');history.back(-1);</script>");
                    }
                }

            }
				
		}else{
		    $this->display("accept_help");
		}
	}
    public  function sell_record(){
        $User = M ('jsbz'); //接受帮助列表
        $map1['user']=$_SESSION['uname'];
        $map1['zt']=array('neq',1);
        $count1 = $User->where ($map1)->count();
        $p1 = getpage($count1,100);
        $list1 = $User->where ( $map1 )->order ( 'id DESC' )->limit ( $p1->firstRow, $p1->listRows )->select ();
        foreach($list1 as $k=>$v){
            $pdtime=$v['date'];
            $time=date('Y-m-d',time());
            $pdtime=date('Y-m-d',strtotime($pdtime));
            $cha=diffBetweenTwoDays($pdtime,$time);
            $list1[$k]['date1']=$cha;
        }
        $this->assign ( 'list1', $list1 );
        $this->assign ( 'page1', $p1->show());
        $this->display ('jsbz');
    }
    public function sqbzjl(){
        $User = M ( 'ppdd' );
        $map2['p_user']=$_SESSION['uname'];
        $map2['zt']=array('neq',2);
        $count2 = $User->where ( $map2 )->count ();
        $p2 = getpage($count2,100);
        $list2 = $User->where ( $map2 )->order ( 'id DESC' )->limit ( $p2->firstRow, $p2->listRows )->select ();
        $this->assign ( 'list2', $list2 ); // 赋值数据集
        $this->assign ( 'page2', $p2->show() ); // 赋值分页输出
        $this->display('sqbzjl');
        //////////////////----------
//         $map3['g_user']=$_SESSION['uname'];
//         $map3['zt']=array('neq',2);
//         $count3 = $User->where ( $map3 )->count ();
//         $p3 = getpage($count3,100);
//         $list3 = $User->where ( $map3 )->order ( 'id DESC' )->limit ( $p3->firstRow, $p3->listRows )->select ();
//         $this->assign ( 'list3', $list3 ); // 赋值数据集
//         $this->assign ( 'page3', $p3->show() ); // 赋值分页输出
//         $this->display ('sqbzjl');
    }
    
    public function jsbzjl(){
                $User = M ( 'ppdd' );
                $map3['g_user']=$_SESSION['uname'];
                $map3['zt']=array('neq',2);
                $count3 = $User->where ( $map3 )->count ();
                $p3 = getpage($count3,100);
                $list3 = $User->where ( $map3 )->order ( 'id DESC' )->limit ( $p3->firstRow, $p3->listRows )->select ();
                $this->assign ( 'list3', $list3 ); // 赋值数据集
                $this->assign ( 'page3', $p3->show() ); // 赋值分页输出
                $this->display ('jsbzjl');
    }
    
   
	public function tgbz_del() {
		if (!preg_match ( '/^[0-9]{1,10}$/', I ('get.id') )) {
			$this->success('非法操作,将冻结账号!');
		}else{
			$userinfo = M ( 'tgbz' )->where ( array ('id' => I ('get.id'),'zt'=>'0') )->find ();
			//dump(I ('get.id'));
			//dump($userinfo['ue_accname']);die;
			if ($userinfo['user']<>$_SESSION ['uname']) {
				$this->success('订单当前状态不可取消!');
			}else{
				lkdsjfsdfj($userinfo['user'],'-'.$userinfo['jb']);
				$reg = M ( 'tgbz' )->where(array ('id' => I ('get.id')))->delete();
				
				if ($reg) {
					die("<script>alert('取消成功!');window.location.href='/';</script>");
				}else {
					die("<script>alert('取消失败!');window.location.href='/';</script>");
				}
			}
		}
	}
	
	public function jsbz_del() {
		//die("<script>alert('不可取消!');window.location.href='/';</script>");
		if (!preg_match ( '/^[0-9]{1,10}$/', I ('get.id') )) {
			$this->success('非法操作,将冻结账号!');
		}else{
			$userinfo = M ( 'jsbz' )->where ( array ('id' => I ('get.id'),'zt'=>'0') )->find ();
			//$userinfo1 = M ( 'jsbz' )->where ( array ('id' => I ('get.id'),'zt'=>'0','qb'=>'1') )->find ();
			//dump(I ('get.id'));
			//dump($userinfo['ue_accname']);die;
			$jl_tj = $userinfo['qb'];

			
			if ($userinfo['user']<>$_SESSION ['uname']) {
				$this->success('订单当前状态不可取消!');
			}elseif($jl_tj == 0){
				$reg = M ( 'jsbz' )->where(array ('id' => I ('get.id')))->delete();
				$a = M('user')->where(array('UE_account' => $userinfo['user']))->setInc('UE_money',$userinfo['jb']);
			}elseif($jl_tj == 1){
				$reg = M ( 'jsbz' )->where(array ('id' => I ('get.id')))->delete();
				$a = M('user')->where(array('UE_account' => $userinfo['user']))->setInc('jl_he',$userinfo['jb']);
			}elseif($jl_tj == 2){
				$reg = M ( 'jsbz' )->where(array ('id' => I ('get.id')))->delete();
				$a = M('user')->where(array('UE_account' => $userinfo['user']))->setInc('tj_he',$userinfo['jb']);
			}
			if ($reg&&$a) {
						die("<script>alert('取消成功!');window.location.href='/';</script>");
					}else {
						die("<script>alert('取消失败!');window.location.href='/';</script>");
					}
		}
	}
	
	
	
	public function pipei() {
		
		$xypipeije=10;
		$data=array(1,2,3,4,5,6,7,8);
		$tj=count($data);
		$sf_tcpp='0';
		for ($b=0;$b<$tj;$b++){
			if($sf_tcpp=='1'){break;}
			$tj_j=$tj-1;
			echo '===========<br>';
		for ($i=0;$i<$tj;$i++){
			if($b<$i){
				$pipeihe=$data[$b]+$data[$tj_j];
				if($pipeihe==$xypipeije){
					echo $data[$b].'+'.$data[$tj_j].'<br>';$sf_tcpp='1';break;
				}
				
			
			
			$tj_j--;
			}
		}
		}
		
	}
	
	public function home_ddxx(){
		 
		$ppddxx=M('ppdd')->where(array('id'=>I('get.id')))->find();
		$g_user=M('user')->where(array('UE_account'=>$ppddxx['g_user']))->find();
		$g_user_t=M('user')->where(array('UE_account'=>$g_user['ue_accname']))->find();
		$p_user=M('user')->where(array('UE_account'=>$ppddxx['p_user']))->find();
		$p_user_t=M('user')->where(array('UE_account'=>$p_user['ue_accname']))->find();
		
		$this->ppddxx=$ppddxx;
		$this->g_user=$g_user;
		$this->p_user=$p_user;
		
		$this->g_user_t=$g_user_t;
		$this->p_user_t=$p_user_t;
		$this->display('home_ddxx');
	}
	
	public function home_ddxx_ly(){
		$ppddxx=M('ppdd')->where(array('id'=>I('get.id')))->find();;
		$this->ppddxx=$ppddxx;
		
		
		
		//////////////////----------
		$User = M ( 'ppdd_ly' ); // 实例化User对象
		
		$map['ppdd_id']=I('get.id');
		$list = $User->where ( $map )->select ();
		$this->assign ( 'list', $list ); // 赋值数据集
		//dump($list);die;
		/////////////////----------------
		
		
		
		$this->display('home_ddxx_ly');
	}
	
	
	public function home_ddxx_ly_cl(){
		 
		$data_P = I ( 'post.' );
		//echo strlen(trim($data_P['mesg']));die;
		$ppddxx=M('ppdd')->where(array('id'=>$data_P['id']))->find();
		
		$user1 = M ();
		if ($ppddxx['p_user']<>$_SESSION['uname']&&$ppddxx['g_user']<>$_SESSION['uname']) {
		
			die("<script>alert('非法操作！');history.back(-1);</script>");
		} elseif( strlen(trim($data_P['mesg']))<1) {
		    die("<script>alert('留言内容不能为空！');history.back(-1);</script>");
		}else {
			$userData = M ( 'user' )->where ( array (
					'UE_ID' => $_SESSION ['uid']
			) )->find ();
		
			$record['ppdd_id'] = $ppddxx['id'];
			$record['user']	= $_SESSION['uname'];
			$record['user_nc']	= $userData['ue_theme'];
			$record['nr']	= $data_P['mesg'];
			$record['date']		= date ( 'Y-m-d H:i:s', time () );;
		
			$reg = M ( 'ppdd_ly' )->add ( $record );
				
		
		
		
			if ($reg) {
				$this->success( '留言成功!' );
			} else {
				$this->success( '留言失败!' );
			}
		
		}
		
	}
	
	public function home_ddxx_pcz(){
        $this->id = I ( 'get.id' );
        $this->assign('sid',session_id());
        $this->display('home_ddxx_pcz');
	}
	
	/*
	 * 确认已付款
	 * */
	public function home_ddxx_pcz_cl(){
		$data_P = I ( 'post.' );
		$ppddxx = M('ppdd')->where(array('id'=>$data_P['id'],'zt'=>'0'))->find();
		if ($ppddxx['p_user']<>$_SESSION['uname']) {
			die("<script>alert('非法操作！');history.back(-1);</script>");
		}elseif($data_P['comfir2']<>'1') {
		    die("<script>alert('请选择,我完成打款！');history.back(-1);</script>");
		}else {
			if($data_P['comfir2']=='1'){
			if($_FILES['img']['name']!=null){
                $data_P['img']=$this->_upload('Pic');
                $data_P['img']='Uploads/'.$data_P['img'];
			}else{	
			 $data_P['img']='';
			}
			//更新订单状态
			$resc = M('ppdd')->where(array('id'=>$data_P['id'],'zt'=>'0'))->save(array('pic'=>$data_P['img'],'zt'=>'1','date_hk'=>date ('Y-m-d H:i:s', time ()),
				'date_hk1'=>date ( 'Y-m-d H:i:s', time () )));
			}
            //增加商城积分
			if($resc){
                M('user')->where(array('UE_account'=>$_SESSION['uname']))->setInc('shop_money',$ppddxx['jb']);
            }
			if($data_P['content']<>''){
			$userData = M ( 'user' )->where (array ('UE_ID' => $_SESSION ['uid']))->find ();
			$record['ppdd_id'] = $ppddxx['id'];
			$record['user']	= $_SESSION['uname'];
			$record['user_nc']	= $userData['ue_theme'];
			$record['nr']	= $data_P['content'];
			$record['date']		= date ( 'Y-m-d H:i:s', time () );
			$reg = M ( 'ppdd_ly' )->add ( $record );
			}
			if(M('user_jj')->where(array('r_id'=>$ppddxx['id']))->find()){
				M('user_jj')->where(array('r_id'=>$ppddxx['id']))->save(array('zt'=>4));
				//查询接受方用户信息
				vendor("Sendsms.sendsms");
				$send = new \Sendsms();
				$get_user=M('user')->where(array('UE_account'=>$ppddxx['g_user']))->find();
				if($get_user['ue_phone']) $mes = $send->my_send($get_user['ue_phone'],"尊敬的客户，您的账户资金有变动，请登录网站确认！【V3财富】！");
				die("<script>alert('提交成功2,请联系对方！');parent.location.reload();</script>");
			}else{
				$settings = include( APP_PATH . 'Home/Conf/settings.php' );
				$peiduidate=M('tgbz')->where(array('id'=>$ppddxx['p_id'],'user'=>$ppddxx['p_user']))->find();
				$data2['user']=$ppddxx['p_user'];
				$data2['r_id']=$ppddxx['id'];
				$data2['date']=$peiduidate['date'];
				$data2['note']='买入积分';
				$data2['jb']=$ppddxx['jb']; 
				$data2['tgbz_id']=$ppddxx['p_id'];
				if(M('user_jj')->add($data2)){
					vendor("Sendsms.sendsms");
					$send = new \Sendsms();
					$get_user=M('user')->where(array('UE_account'=>$ppddxx['g_user']))->find();
					if ($get_user['ue_phone']) $mes = $send->my_send($get_user['ue_phone'], "尊敬的客户，您的账户资金有变动，请登录网站确认！【V3财富】");
					die("<script>alert('提交成功,请联系对方确认收款！');parent.location.reload();</script>");
				}else{
					die("<script>alert('提交失败,请联系管理员！');history.back(-1);</script>");
				}
				
			}
		}
	}
	
	public function home_ddxx_gcz(){
		$this->id = I ( 'get.id' );
		$this->display('home_ddxx_gcz');
	}
	/*
	 * 确认收款
	 * */
    public function home_ddxx_gcz_cl()
    {
        $qylx =array(
            array('ty_jt_li' ,'baiyin_jt_li_out' ),
            array('baiyin_jt_li','baiyin_jt_li_out'),
            array('baiyin_jt_li' ,'baiyin_jt_li_out'),
            array('baiyin_jt_li','baiyin_jt_li_out'),
        );
        $settings = include( APP_PATH . 'Home/Conf/settings.php' );
        $coldtime = $settings['cold4_user_time'];
        $data_P = I('post.');
        $ppddxx = M('ppdd')->where(array('id' => $data_P['id'], 'zt' => '1'))->find();
        $time = date('Y-m-d H:i:s');
        $dktime = $ppddxx['date_hk'];
        $maxtime = date('Y-m-d H:i:s', strtotime("$dktime")+$coldtime*3600);
        if ($ppddxx['g_user'] <> $_SESSION['uname'])
                  {
            die("<script>alert('非法操作！');history.back(-1);</script>");
        } elseif ($data_P['comfir'] <> '1' && $data_P['comfir'] <> '2' && $data_P['comfir'] <> '3')
                  {
            die("<script>alert('请选择,确认收款！');history.back(-1);</script>");
        } elseif ($ppddxx['ts_zt'] == '3')
                {
            die("<script>alert('24小时未确认收款,已被投诉！');history.back(-1);</script>");
        } else
                 {
            if($_FILES['img']['name']!=null){
                $data_P['img']=$this->_upload('Pic');
                $data_P['img']='Uploads/'.$data_P['img'];
			}else{	
			 $data_P['img']='';
			}
            if ($data_P['comfir'] == '1')
            {
                //更新此订单状态
                M('ppdd')->where(array('id' => $data_P['id'], 'zt' => '1'))->save(array('zt' => '2', 'pic2' => $data_P['img'],'date1'=>date('Y-m-d H:i:s', time())));
//                 M('user_jj')->where(array('r_id' => $ppddxx['id'], 'zt' => '4'))->save(array('zt' => '0'));
                $order = M('ppdd')->where(array('id' => $data_P['id']))->find();
                $qy = $order['qy'];
                //-------------发放静态奖金开始--------------//
                $dk_time = strtotime($dktime);//当前时间
                $jl_time = strtotime($ppddxx['date']) + $settings['max_baiyin_hours']*3600;//N小时之后的时间
                $user = M('user')->where(array('UE_account'=>$ppddxx['p_user']))->field('UE_level,UE_money')->find();
                if($dk_time <= $jl_time){//N小时内打款奖励利息
                    $lixi = $settings[$qylx[$qy-1][0]] + $settings[$qylx[$qy-1][1]];
                }else{
                    $lixi = $settings[$qylx[$qy-1][0]];
                               }
                $money =  $ppddxx['jb']*$lixi/100.0;
                
                $user_after =  M('user')->where(array('UE_account'=>$ppddxx['p_user']))->getField('UE_money');
                $record3 ["UG_allGet"] = $user['ue_money'];
                $record3 ["UG_balance"] = $user['ue_money']+$money;
                $record3 ["UG_othraccount"] = 1;
                $time=date('Y-m-d H:i:s',time());

                $record3 ["UG_account"] = $ppddxx['p_user']; // 登入轉出賬戶
                $record3 ["UG_type"] = 'jb';

                $record3 ["UG_money"] = $money; //
                $record3 ["UG_dataType"] = 'jtj'; // 金幣轉出

                $record3 ["UG_note"] = '静态奖金'; // 推薦獎說明
                $record3['status'] = 0;
                $record3["UG_getTime"] = date ('Y-m-d H:i:s', time ()); //操作時間
                $record3['benjin'] = $ppddxx['jb'];
                $record3['ppddid'] = $data_P['id'];
                $reg3 = M ('userget' )->add ($record3);

                
                //-------------发放静态奖金结束--------------//

                $txyqr = M('ppdd')->where(array('g_id' => $ppddxx['g_id'], 'zt' => '2'))->sum('jb');
                $txzs = M('jsbz')->where(array('id' => $ppddxx['g_id']))->find();
                if ($txzs['jb'] == $txyqr){
                    M('jsbz')->where(array('id' => $ppddxx['g_id']))->save(array('qr_zt' => '1')); //提现订单已确认
                                }
                /* NOTED BY SKYRIM: P - 充值订单 */
                $czyqr = M('ppdd')->where(array('p_id' => $ppddxx['p_id'], 'zt' => '2'))->sum('jb');
                $czzs = M('tgbz')->where(array('id' => $ppddxx['p_id']))->find();
                if ($czzs['jb'] == $czyqr)
                               {
                    M('tgbz')->where(array('id' => $ppddxx['p_id']))->save(array('qr_zt' => '1','date1'=>date('Y-m-d H:i:s'))); //提现订单已确认
                                }

                $tgbz_user_xx = M('user')->where(array('UE_account' => $ppddxx['p_user']))->find(); //充值人详细
                if ($tgbz_user_xx['jh'] == 0)
                               {
                    M('user')->where(array('UE_account' => $ppddxx['p_user']))->save(array('jh' => 1));
                               }
                
                if ($tgbz_user_xx['ue_accname'] <> '') {
                    $accname_zq = M('user')->where(array('UE_account' => $tgbz_user_xx['ue_accname']))->find();
                    $this_node = $tgbz_user_xx['ue_accname'];
                    $i = $settings['max_user_level'];
                    $shaoshang = $settings['shaoshang'];
                    while ($i --) {
                        $uname = M('user')->where(array('UE_account' => $this_node))->find();
                        if ($this_node && strlen($this_node)) {
                            //烧伤 判断最小的那一个订单 发奖金
                            if ($shaoshang == 1) {
                                $redaxiao = M('tgbz')->where(['user' => $this_node])->order('date desc')->limit(1)->getField('yjb');
                                if ($redaxiao) {
                                    if ($redaxiao < $ppddxx['jb']) {
                                        $ppddmoney = $redaxiao;
                                    } else {
                                        $ppddmoney = $ppddxx['jb'];
                                                                          }
                                } else {
                                    $ppddmoney = 0;
                                                                  }
                            }else{
                                $ppddmoney = $ppddxx['jb'];
                                                       }
                            //烧伤
                            //------------------动态奖金发放开始------------//
                            if (($settings['max_user_level'] - $i) == 1){
                                $this_node = masses_j($this_node, $ppddmoney * floatval($settings['baiyin_vip']/100),  '一代推荐奖' . ( floatval($settings['baiyin_vip']) ) . '%', $ppddmoney);
                            } elseif (($settings['max_user_level'] - $i) == 2){
                                $this_node = $uname['ue_accname'];
                            } elseif (($settings['max_user_level'] - $i) == 3) {
                                $this_node = masses_j($this_node, $ppddmoney * floatval($settings['huangjin_vip']/100),  '三代推荐奖' . ( floatval($settings['huangjin_vip']) ) . '%', $ppddmoney);
                            } elseif (($settings['max_user_level'] - $i) == 4) {
                                $this_node = $uname['ue_accname'];
                            }elseif (($settings['max_user_level'] - $i) == 5) {
                                $this_node = masses_j($this_node, $ppddmoney * floatval($settings['zuanshi_vip']/100),  '五代推荐奖' . ( $settings['zuanshi_vip'] ) . '%', $ppddmoney);
                            }else {
                                $this_node = $uname['ue_accname'];
                               }

                            //------------------动态奖金发放结束------------//
                            
                       
                        } else{
                            break;
                                              }

                                 }
                                 //......................................管理奖.....................................//
             $teamarr = 0;
             $yeji = 0.0;
             $id = $tgbz_user_xx['ue_accname'];
             xiajirenshu($id,$arr);
             xiajiyeji($id,$yeji);
             $ztcount = M('user')->where(array('UE_accName'=>$id))->count();
             if($ztcount >= $settings['huangjin_zhitui'] && $teamarr >= $settings['huangjin_tuandui'])
                 $ldlx = 0.2;
             if($ztcount >= $settings['baiyin_zhitui'] && $teamarr >= $settings['baiyin_tuandui'])
                 $ldlx = 0.3;
             $ldjl = $yeji*$ldlx;
             if($ldjl){
                 $user_acc = M('user')->where(array('UE_accName'=>$id))->find();
                 M('user')->where(array('UE_accName'=>$id))->setInc('tj_he',$ldjl);
                 $use_acc_after = M('user')->where(array('UE_accName'=>$id))->getField('tj_he');
                 $record6 ["UG_allGet"] = $user_acc['ue_money'];
                 $record6 ["UG_balance"] = $use_acc_after;
                 $record6 ["UG_othraccount"] = 1;
                 $time=date('Y-m-d H:i:s',time());
                  
                 $record6 ["UG_account"] = $_SESSION['uname']; // 登入轉出賬戶
                 $record6 ["UG_type"] = 'jb';
                  
                 $record6 ["UG_money"] = $ldjl; //
                 $record6 ["UG_dataType"] = 'jtj'; // 金幣轉出
                  
                 $record6 ["UG_note"] = '团队业绩奖'; // 推薦獎說明
                 $record6['status'] = 1;
                 $record6["UG_getTime"] = date ('Y-m-d H:i:s', time ()); //操作時間
                 $record6['wallettype'] = 0;
                 $reg6 = M ('userget' )->add ($record6);
                                 }
                                 //-------------------管理奖end------------------/-
                }
               
                             
                vendor("Sendsms.sendsms");
				        $send = new \Sendsms();
                $get_user = M('user')->where(array('UE_account' => $ppddxx['p_user']))->find();
                if ($get_user['ue_phone'])
                    $mes = $send->my_send($get_user['ue_phone'], "尊敬的客户，您的账户资金有变动，请登录网站确认！【V3财富】");

                die("<script>alert('此次交易成功！');parent.window.location.href='/Home/Index/index';</script>");
            }elseif ($data_P['comfir'] == '2'){
                if ($ppddxx['ts_zt'] == '2') {
                    die("<script>alert('您已经投诉过了,请等待管理员审核！');parent.location.reload();</script>");
                }else {
                    if ($data_P['img'] == '') {
                        die("<script>alert('请上传截图！');parent.location.reload();</script>");
                    } else{
                        M('ppdd')->where(array('id' => $data_P['id'], 'zt' => '1'))->save(array('ts_zt' => '2', 'pic2' => $data_P['img']));
                        die("<script>alert('投诉成功,等待管理员审核,如果在审核过程中你收到款了,您还可以确认收款！');parent.location.reload();</script>");
                    }
                }
            }
        }
    }

	public function home_ddxx_pic_no(){
	
	
		$this->id = I ( 'get.id' );
	
		$this->display('home_ddxx_pic_no');
	}
	
	public function home_ddxx_g_wdk(){
	
	
		$this->id = I ( 'get.id' );
	
		$this->display('home_ddxx_g_wdk');
	}
	public function home_ddxx_g_wqr(){
	
	
		$this->id = I ( 'get.id' );
	
		$this->display('home_ddxx_g_wqr');
	}
	
	public function home_ddxx_g_wdk_cl(){
		$data_P = I ( 'post.' );
		$ppddxx=M('ppdd')->where(array('id'=>$data_P['id'],'zt'=>'0'))->find();
		$NowTime = $ppddxx['date'];
		$aab=strtotime($NowTime);
		$aab2=$aab+86400+86400;
		$bba = date('Y-m-d H:i:s',time());
		$bba2=strtotime($bba);
	
		if ($ppddxx['g_user']<>$_SESSION['uname']) {
	
			die("<script>alert('非法操作！');history.back(-1);</script>");
		}elseif($aab2>$bba2) {
			die("<script>alert('汇款时间未超过48时小,暂不能投诉,如未打款,请与提供帮助者取得联系！');history.back(-1);</script>");
		}elseif($data_P['comfir']<>'1'&&$data_P['comfir']<>'2') {
			die("<script>alert('请选择,确认投诉！');history.back(-1);</script>");
		}elseif($ppddxx['ts_zt']=='1'&&$data_P['comfir']<>'2') {
			die("<script>alert('您已经投诉过了,请等待管理员处理！');history.back(-1);</script>");
		}else {
			if($data_P['comfir']=='1'){
				M('ppdd')->where(array('id'=>$data_P['id'],'zt'=>'0'))->save(array('ts_zt'=>'1'));
				die("<script>alert('投诉提交成功,请等待管理员审核通过！');parent.location.reload();</script>");
			}elseif($data_P['comfir']=='2'){
				M('ppdd')->where(array('id'=>$data_P['id'],'zt'=>'0'))->save(array('ts_zt'=>'0'));
				die("<script>alert('投诉取消成功,卖家可以继续汇款！');parent.location.reload();</script>");
			}
	
	
	
	
			
	
	
		}
	}
	
	
	
	
	public function home_ddxx_g_wqr_cl(){
	
		$data_P = I ( 'post.' );
	
	//dump($data_P);die;
	
	
		// 		$NowTime = '2015-07-01 01:56:17';
		// 		$aab=strtotime($NowTime);
		// 		$aab2=$aab+86400+86400;
	
		// 		echo "Today:",date('Y-m-d H:i:s',$aab),"<br>";
		// echo "Tomorrow:",date('Y-m-d H:i:s',$aab2);die;
	
	
	
	
	
	
	
		//echo strlen(trim($data_P['mesg']));die;
		$ppddxx=M('ppdd')->where(array('id'=>$data_P['id'],'zt'=>'1'))->find();
		$NowTime = $ppddxx['date_hk'];
		$aab=strtotime($NowTime);
		$aab2=$aab+86400+86400;
		$bba = date('Y-m-d H:i:s',time());
		$bba2=strtotime($bba);
	
		if ($ppddxx['p_user']<>$_SESSION['uname']) {
	
			die("<script>alert('非法操作！');history.back(-1);</script>");
		}elseif($aab2>$bba2) {
			die("<script>alert('确认时间未超过48时小,暂不能投诉,如未确认,请与对方取得联系！');history.back(-1);</script>");
		}elseif($data_P['comfir']<>'1'&&$data_P['comfir']<>'2') {
			die("<script>alert('请选择,确认或取消！');history.back(-1);</script>");
		}elseif($ppddxx['ts_zt']=='2') {
			die("<script>alert('您已被对方投诉,请与对方取得联系！');history.back(-1);</script>");
		}else{
			
			
			
			
			
			
			
			
			
		
			//dump($data_P);die;
			//echo strlen(trim($data_P['mesg']));die;
			
			
			
			
				if($data_P['comfir']=='1'){
			
					M('ppdd')->where(array('id'=>$data_P['id'],'zt'=>'1'))->save(array('zt'=>'2'));//更新此订单状态
			
					$txyqr=M('ppdd')->where(array('g_id'=>$ppddxx['g_id'],'zt'=>'2'))->sum('jb');
			
			
					$txzs=M('jsbz')->where(array('id'=>$ppddxx['g_id']))->find();
					if($txzs['jb']==$txyqr){
						M('jsbz')->where(array('id'=>$ppddxx['g_id']))->save(array('qr_zt'=>'1'));//提现订单已确认
					}
			
			
					$czyqr=M('ppdd')->where(array('p_id'=>$ppddxx['p_id'],'zt'=>'2'))->sum('jb');
			
			
					$czzs=M('tgbz')->where(array('id'=>$ppddxx['p_id']))->find();
					if($czzs['jb']==$czyqr){
						M('tgbz')->where(array('id'=>$ppddxx['p_id']))->save(array('qr_zt'=>'1'));//提现订单已确认
					}
			
			
			
					////更新提现订单状态
			
					//M('tgbz')->where(array('id'=>$ppddxx['p_id']))->setInc('jycg_ds',1);
			
					// 			    $tgbzcs=M('tgbz')->where(array('id'=>$ppddxx['p_id']))->find();
					// 			    if($tgbzcs['cf_ds']==$tgbzcs['jycg_ds']){
					// 			    	M('tgbz')->where(array('id'=>$ppddxx['p_id']))->save(array('qr_zt'=>'1'));//更新充值订单状态
					// 			    }
			
					//推荐奖10%
					 
					$tgbz_user_xx=M('user')->where(array('UE_account'=>$ppddxx['p_user']))->find();//充值人详细
					//echo $ppddxx['p_id'];die;
					if($tgbz_user_xx['ue_accname']<>''){
						$money=$ppddxx['jb']*0.1;
						$accname_zq=M('user')->where(array('UE_account'=>$tgbz_user_xx['ue_accname']))->find();
						M('user')->where(array('UE_account'=>$tgbz_user_xx['ue_accname']))->setInc('UE_money',$money);
						$accname_xz=M('user')->where(array('UE_account'=>$tgbz_user_xx['ue_accname']))->find();
						 						$note3 = "推荐奖10%";
						// added by skyrim
						// purpose: custom share
						// version: 6.0
						$settings = include( APP_PATH . 'Home/Conf/settings.php' );
						$note3 = "推荐奖" . ( floatval($settings['tjr_share']) ) . "%";
						$money=$ppddxx['jb']*10*floatval($settings['tjr_share'])/100;
						// added ends
						$record3 ["UG_account"] = $tgbz_user_xx['ue_accname']; // 登入转出账户
						$record3 ["UG_type"] = 'jb';
						$record3 ["UG_allGet"] = $accname_zq['ue_money']; // 金币
						$record3 ["UG_money"] = '+'.$money; //
						$record3 ["UG_balance"] = $accname_xz['ue_money']; // 当前推荐人的金币馀额
						$record3 ["UG_dataType"] = 'tjj'; // 金币转出
						$record3 ["UG_note"] = $note3; // 推荐奖说明
						$record3["UG_getTime"]		= date ( 'Y-m-d H:i:s', time () ); //操作时间
						// $reg4 = M ( 'userget' )->add ( $record3 );
						 
						//$money_jlj1=;
						 
						// added by skyrim
						// purpose: custom share
						// version: 6.0
						$this_node = $tgbz_user_xx['ue_accname'];
						$i = $settings['max_jl_level'];
						while( $i -- ){
							if( $this_node && strlen( $this_node ) ){
							 $this_node = masses_j( $this_node, $ppddxx['jb']*floatval($settings['masses_share'][1+$settings['max_user_level']-$i]));
							}
						}
						
						$this_node = $tgbz_user_xx['ue_accname'];
						$i = $settings['max_jl_level'];
						while( $i -- ){
							if( $this_node && strlen( $this_node ) ){
								$this_node = jlj( $this_node, $ppddxx['jb']*floatval($settings['jl_share'][1+$settings['max_jl_level']-$i]), '经理奖' . ( floatval($settings['jl_share'][1+$settings['max_jl_level']-$i]) * 100 ) . '%' );
							}
						}
						// added ends
						// deleted by skyrim
						// purpose: custom share
						// version: 6.0
						// if($tgbz_user_xx['zcr']<>''){
						// 	$zcr2=jlj($tgbz_user_xx['zcr'],$ppddxx['jb']*0.05,'经理奖5%');
						// 	if($zcr2<>''){
						// 		$zcr3=jlj($zcr2,$ppddxx['jb']*0.03,'经理奖3%');
						// 		//echo $ppddxx['p_user'].'sadfsaf';die;
						// 		if($zcr3<>''){
						// 			$zcr4=jlj($zcr3,$ppddxx['jb']*0.01,'经理奖1%');
						// 			if($zcr4<>''){
						// 				$zcr5=jlj($zcr4,$ppddxx['jb']*0.0025,'经理奖0.25%');
						// 				if($zcr5<>''){
						// 					jlj($zcr5,$ppddxx['jb']*0.001,'经理奖0.1%');
						// 				}
						// 			}
						// 		}
						// 	}
						// }
						// deleted ends 
					}				 
					die("<script>alert('系统自动处理成功！');parent.location.reload();</script>");
				}
		}
	}
	
	public function tgbz_list_cf(){
	
	
		$User = M ( 'tgbz' ); // 实例化User对象
		$data = I ( 'post.user' );
	
		$this->z_jgbz=$User->sum('jb');
		$this->z_jgbz2=$User->where(array('qr_zt'=>'1'))->sum('jb');
		$this->z_jgbz3=$User->where(array('qr_zt'=>array('neq','1')))->sum('jb');
		//$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));
	
		$map['zt']=0;
	
		if(I ( 'get.cz' )==1){
			$map['zt']=1;
		}
		if($data<>''){
			$map['user']=$data;
		}
		$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)
	
		$p = getpage($count,20);
	
		$list = $User->where ( $map )->order ( 'id DESC' )->limit ( $p->firstRow, $p->listRows )->select ();
		//dump($list);die;
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $p->show() ); // 赋值分页输出
	
	
	
		$this->display('index/tgbz_list_cf');
	}
	
	
	public function jsbz_list_cf(){
	
	
	
		$User = M ( 'jsbz' ); // 实例化User对象
		$data = I ( 'post.user' );
	
		$this->z_jgbz=$User->sum('jb');
		$this->z_jgbz2=$User->where(array('qr_zt'=>'1'))->sum('jb');
		$this->z_jgbz3=$User->where(array('qr_zt'=>array('neq','1')))->sum('jb');
		//$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));
	
		$map['zt']=0;
	
		if(I ( 'get.cz' )==1){
			$map['zt']=1;
		}
		if($data<>''){
			$map['user']=$data;
		}
		$count = $User->where ( $map )->count (); // 查询满足要求的总记录数
		//$page = new \Think\Page ( $count, 3 ); // 实例化分页类 传入总记录数和每页显示的记录数(25)
	
		$p = getpage($count,20);
	
		$list = $User->where ( $map )->order ( 'id DESC' )->limit ( $p->firstRow, $p->listRows )->select ();
		//dump($list);die;
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $p->show() ); // 赋值分页输出
	
	
	
		$this->display('index/jsbz_list_cf');
	}
	
	public function tgbz_list_cf_cl(){
		$data=I('post.');
		$p_user=M('tgbz')->where(array('id'=>$data['pid']))->find();
		if (! preg_match ( '/^[0-9,]{1,100}$/', I('post.arrid') )) {
			$this->error( '格式不对!' );
			die;
		}
		$arr = explode(',',I('post.arrid'));
		//dump($arr);
		if(array_sum($arr)<>$p_user['jb']){
			$this->error( '拆分金额不对!' );
			die;
		}
	
    	// added by skyrim
    	// purpose: check money in range
    	// version: 4
		$settings = include( dirname( APP_PATH ) . '/User/Home/Conf/settings.php' );
		
		foreach( $arr as $q ){
			if( $settings['supply_money_upper_limit'] < $q || $q < $settings['supply_money_lower_limit'] ){
				$this->error('金额不在范围内!');
				
				return;
			}
		}
		$p_user1=M('tgbz')->where(array('id'=>$data['pid']))->find();
	
		$pipeits=0;
		foreach($arr as $value){
			if($value<>''){
				$data2['zffs1']=$p_user1['zffs1'];
				$data2['zffs2']=$p_user1['zffs2'];
				$data2['zffs3']=$p_user1['zffs3'];
				$data2['user']=$p_user1['user'];
				$data2['jb']=$value;
				$data2['user_nc']=$p_user1['user_nc'];
				$data2['user_tjr']=$p_user1['user_tjr'];
				$data2['date']=$p_user1['date'];
				$data2['zt']=$p_user1['zt'];
				$data2['qr_zt']=$p_user1['qr_zt'];
				$varid = M('tgbz')->add($data2);
				$pipeits++;
			}
			 
	
		}
	
		M('tgbz')->where(array('id'=>$data['pid']))->delete();
	
	
	
	
		$this->success('匹配成功!拆分成'.$pipeits.'条订单!');
	}
	
	public function jsbz_list_cf_cl(){
		$data=I('post.');
		$p_user=M('jsbz')->where(array('id'=>$data['pid']))->find();
		if (! preg_match ( '/^[0-9,]{1,100}$/', I('post.arrid') )) {
			$this->error( '格式不对!' );
			die;
		}
		$arr = explode(',',I('post.arrid'));
		//dump($arr);
		if(array_sum($arr)<>$p_user['jb']){
			$this->error( '拆分金额不对!' );
			die;
		}
    	// added by skyrim
    	// purpose: check money in range
    	// version: 4
		$settings = include( dirname( APP_PATH ) . '/User/Home/Conf/settings.php' );
		
		foreach( $arr as $q ){
			if( $settings['supply_money_upper_limit'] < $q || $q < $settings['supply_money_lower_limit'] ){
				$this->error('金额不在范围内!');
				
				return;
			}
		}
    	// added ends
		 
		 
		 
		 
		$p_user1=M('jsbz')->where(array('id'=>$data['pid']))->find();
		 
		$pipeits=0;
		foreach($arr as $value){
			if($value<>''){
				$data2['zffs1']=$p_user1['zffs1'];
				$data2['zffs2']=$p_user1['zffs2'];
				$data2['zffs3']=$p_user1['zffs3'];
				$data2['user']=$p_user1['user'];
				$data2['jb']=$value;
				$data2['user_nc']=$p_user1['user_nc'];
				$data2['user_tjr']=$p_user1['user_tjr'];
				$data2['date']=$p_user1['date'];
				$data2['zt']=$p_user1['zt'];
				$data2['qr_zt']=$p_user1['qr_zt'];
				$varid = M('jsbz')->add($data2);
				$pipeits++;
			}
	
			 
		}
		 
		M('jsbz')->where(array('id'=>$data['pid']))->delete();
		 
		 
		 
		 
		$this->success('匹配成功!拆分成'.$pipeits.'条订单!');
	}
	 
	
}