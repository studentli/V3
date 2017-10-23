<?php

namespace Home\Controller;

use Think\Controller;

class InfoController extends CommonController {
	// 首頁
	public function index() {
		$userData = M ( 'user' )->where ( array ('UE_ID' => $_SESSION ['uid']) )->find ();
		$this->userData = $userData;
		
		

		$ip=M ( 'drrz' )->where ( array ('user' => $_SESSION ['uname'],'leixin'=>0) )->order ( 'id DESC' )->limit ( 2 )->select();
		$this->assign("ssid",session_id());
		$this->bcip=$ip[0];
		$this->scip=$ip[1];
		$this->display ( 'grsz' );
	}
	//短信验证修改资料
	public function yzm(){
		$phone = I('post.phone');

		if($phone == ''){
			$this->ajaxReturn('shoujihao');
			die;
		}
		$rand['val'] = rand(1000,9999);
		$rand['active_time'] = 60;
		$rand['create_time'] = time();
		vendor("Sendsms.sendsms");
		$send = new \Sendsms();
		// $get_user=M('user')->where(array('UE_account'=>$ppddxx['p_user']))->find();
		if ($phone) $mes = $send->my_send($phone, "您好，您修改个人资料的手机验证码为".$rand['val']."，请妥善保管验证码，请勿泄露他人。【V3财富】");
		if($mes){
			session('yzm',$rand['val']);
			$this->ajaxReturn('验证码已发送！');
		}else{
			$this->ajaxReturn('验证码发送失败！');
		}
	}
	public function xgmm() {
		$userData = M ( 'user' )->where ( array (
				'UE_ID' => $_SESSION ['uid']
		) )->find ();
		$this->userData = $userData;
		$this->display ( 'xgmm' );
	}
	public function djye() {
		$userData = M ( 'userget' )->where ( array ('UG_account' => $_SESSION ['uname'],'UG_dataType'=>'djye') )->select ();
		$this->assign('list',$userData);
		$this->display ( 'djye' );
	}
	public function xgmme() {
		$userData = M ( 'user' )->where ( array (
				'UE_ID' => $_SESSION ['uid']
		) )->find ();
		$this->userData = $userData;
		$this->display ( 'xgmme' );
	}
	public function bdmb() {
		$userData = M ( 'user' )->where ( array (
				'UE_ID' => $_SESSION ['uid']
		) )->find ();
		$this->userData = $userData;
		if($userData['ue_question']==''){
		$this->display ( 'bdmb' );
		}else{
			$this->display ( 'xgmb' );
		}
	}
	public function xgmb() {
		$userData = M ( 'user' )->where ( array (
				'UE_ID' => $_SESSION ['uid']
		) )->find ();
		$this->userData = $userData;
		$this->display ( 'xgmb' );
	}
	public function addskzh() {
		$userData = M ( 'user' )->where ( array (
				'UE_ID' => $_SESSION ['uid']
		) )->find ();
		$this->userData = $userData;
		$this->display ( 'addskzh' );
	}
public function skzh() {
		$userData = M ( 'user' )->where ( array (
				'UE_ID' => $_SESSION ['uid']
		) )->find ();
		$caution = M ( 'userinfo' )->where ( array (
				'UI_userID' => $_SESSION ['uid']
		) )->order ( 'UI_ID DESC' )->select ();
		$this->caution = $caution;
		//dump($caution);die;
		$this->userData = $userData;
		$this->display ( 'skzh' );
	}
	
	public function skzhdl() {
		if (!preg_match ( '/^[0-9]{1,10}$/', I ('get.id') )) {
			$this->success('非法操作,將凍結賬號!');
		}else{
			$userinfo = M ( 'userinfo' )->where ( array ('UI_ID' => I ('get.id')) )->find ();
			if ($userinfo['ui_userid']<>$_SESSION ['uid']) {
				$this->success('非法操作,將凍結賬號!');
			}else{
				$reg = M ( 'userinfo' )->where(array ('UI_ID' => I ('get.id')))->delete();
				if ($reg) {
					$this->success('刪除成功!');
				}else {
					$this->success('刪除失敗!');
				}
			}
		}
	}
	
	public function ejmm() {
		$this->display ( 'ejmm' );
	}
	public function ejmmcl() {
		//echo $_SESSION['url'];die;
	if (IS_POST) {
		        $data_P = I ( 'post.' );
	            $addaccount = M ( 'user' )->where ( array (UE_account => $_SESSION ['uname']) )->find ();
	//dump($addaccount['ue_secpwd']);
	//dump(md5($data_P['ejmmqr']));
	//die;
				if ($addaccount['ue_secpwd']<>md5($data_P['ejmmqr'])) {
					$this->error('二級密碼不正確!');
				}else {
					$_SESSION['ejmmyz'] = $addaccount['ue_secpwd'];
				//	echo ;die;
					$this->success('驗證成功',$_SESSION['url']);
				}
    	}
    	
	}
	public function xgzlcl() {
		if (IS_POST) {
			$data_P = I ( 'post.' );
			$userxx=M('user')->where(array('UE_account'=>$_SESSION['uname']))->find();
			$map['zt'] = 0;
			$map['qr_zt'] = 0;
			$map['_logic']='or';
			$where['_complex'] = $map;
			$where['user']=$_SESSION['uname'];
			$tgbz = M('tgbz')->where($where)->find();
			$jsbz = M('jsbz')->where($where)->find();
			if($tgbz || $jsbz){
				die("<script>alert('提供帮助或者接受帮助成功后不可修改个人信息！');history.back(-1);</script>");
			}else{
				if($userxx['ue_secpwd']<>md5($data_P['ejmm'])){
					die("<script>alert('二级密码输入有误！');history.back(-1);</script>");
				}else{
		
					$data_up['weixin'] = $data_P['weixin'];
				
					$data_up['zfb'] = $data_P['zfb'];
					$data_up['yhmc'] = $data_P['yhmc'];
					//$data_up['zhxm'] = $data_P['bank_user'];
					$data_up['yhzh'] = $data_P['yhzh'];
					$data_up['UE_truename'] = $data_P['truename'];
					$data_up['address'] = $data_P['address'];
					// $data_up['UE_phone'] = $data_P['phone'];
					$reg = M('user')->where(array('UE_account'=>$_SESSION['uname']))->save($data_up);
					
					
					
					if ($reg) {
						die("<script>alert('修改成功！');history.back(-1);</script>");
					} else {
						die("<script>alert('修改失败！');history.back(-1);</script>");
					}
				}
			
		}
		}
	}
	
	
	public function xgyjmmcl() {
		
		if (IS_POST) {
			$data_P = I ( 'post.' );
			$user1 = M ();
			if (!preg_match ( '/^[a-zA-Z0-9]{1,15}$/', $data_P ['xmm'] )) {
			    die("<script>alert('新密码为6-12字母数字组合！');history.back(-1);</script>");
			}elseif ($data_P['xmm']<>$data_P['xmmqr']) {
			    die("<script>alert('两次输入的密码不一致！');history.back(-1);</script>");
			}elseif ($data_P['ymm']==$data_P['xmm']) {
			    die("<script>alert('原密码和新密码不能相同！');history.back(-1);</script>");
			} else {
				$addaccount = M ( 'user' )->where ( array (UE_account => $_SESSION ['uname']) )->find ();
				if ($addaccount['ue_password']<>md5($data_P['ymm'])) {
				    die("<script>alert('原密码不正确！');history.back(-1);</script>");
				}else {
					$reg = M ( 'user' )->where ( array (
							'UE_ID' => $_SESSION ['uid']
					) )->save (array('UE_password'=>md5($data_P['xmm'])));
						
					$user6 = M ( 'user' )->where ( array ('UE_ID' => $_SESSION ['uid']) )->find();
						vendor("Sendsms.sendsms");
						$send = new \Sendsms();
						if ($user6['ue_phone']) $mes = $send->my_send($user6['ue_phone'], "您好！您正在修改V3财富账号的密码，如非本人操作，请联系V3财富管理员！【V3财富】");
						
					if ($reg) {
						$this->success("修改成功！",U("Home/Index/index"));
					} else {
							die("<script>alert('失败！');history.back(-1);</script>");
					}
				}
			}
		}
	}
	
	public function addskzhcl() {
	
		if (IS_AJAX) {
			$data_P = I ( 'post.' );
			//dump($data_P);
			//$this->ajaxReturn($data_P['ymm']);die;
			//$user = M ( 'user' )->where ( array (
			//		UE_account => $_SESSION ['uname']
			//) )->find ();
				
			$user1 = M ();
			//! $this->check_verify ( I ( 'post.yzm' ) )
			//! $user1->autoCheckToken ( $_POST )
			if (! $this->check_verify ( I ( 'post.yzm' ) )) {
					
				$this->ajaxReturn ( array ('nr' => '驗證碼錯誤!','sf' => 0 ) );
			} elseif (strlen($data_P['skfs']) > 13 || strlen($data_P['skfs']) <6 ) {
				$this->ajaxReturn ( array ('nr' => '請選擇收款方式!','sf' => 0 ) );
			} elseif (!preg_match ( '/^[0-9]{6,30}$/', $data_P ['skzh'] )) {
				$this->ajaxReturn ( array ('nr' => '收款賬號為數字6-30位！','sf' => 0 ) );
			}elseif (strlen($data_P['khh']) > 60 || strlen($data_P['khh']) <6) {
				$this->ajaxReturn ( array ('nr' => '開戶支行中文字數2-20字!','sf' => 0 ) );
			}else {
				
			//	if ($addaccount['ue_password']<>md5($data_P['ymm'])) {
				//	$this->ajaxReturn ( array ('nr' => '原密碼不正確!','sf' => 0 ) );
				if(! $user1->autoCheckToken ( $_POST )){
					$this->ajaxReturn ( array ('nr' => '新勿重複提交,請刷新頁面!','sf' => 0 ) );
				} else {
					$addaccount = M ( 'user' )->where ( array (UE_account => $_SESSION ['uname']) )->find ();
					
					$data_up['UI_userID'] = $_SESSION ['uid'];
					$data_up['UI_time'] = date ( 'Y-m-d H:i:s', time () );
					$data_up['UI_realName'] = $addaccount['ue_truename'];
					$data_up['UI_payaccount'] = $data_P['skzh'];
					$data_up['UI_payStyle'] = $data_P ['skfs'];
					$data_up['UI_isindex'] = I ('post.sfqy',0,'/^[1]{1}$/');
					$data_up['UI_opendress'] = $data_P ['khh'];
					$reg=M ( 'userinfo' )->add ( $data_up );
				//	$reg = M ( 'user' )->where ( array (
				//			'UE_ID' => $_SESSION ['uid']
				//	) )->save (array('UE_password'=>md5($data_P['xmm'])));
	
				//dump($data_up);
	
					if ($reg) {
						$this->ajaxReturn ( '添加成功!' );
					} else {
						$this->ajaxReturn ( '添加失敗!' );
					}
				}
			}
		}
	}
	
public function xgejmmcl() {
		if (IS_POST) {
			$data_P = I ( 'post.' );
			$user1 = M ();
			if (!preg_match ( '/^[a-zA-Z0-9]{1,15}$/', $data_P ['xejmm'] )) {
				die("<script>alert('新二级密碼6-12個字元,大小寫英文+數字,請勿用特殊詞符！');history.back(-1);</script>");
			}elseif ($data_P['xejmm']<>$data_P['xejmmqr']) {
				die("<script>alert('新二级密碼兩次輸入不一致！');history.back(-1);</script>");
			}elseif ($data_P['yejmm']==$data_P['xejmm']) {
				die("<script>alert('原二级密碼和新密碼不能相同！');history.back(-1);</script>");
			} else {
				$addaccount = M ( 'user' )->where ( array (UE_account => $_SESSION ['uname']) )->find ();
				if ($addaccount['ue_secpwd']<>md5($data_P['yejmm'])) {
					die("<script>alert('原二级密碼不正確！');history.back(-1);</script>");
				}else {

					$reg = M ( 'user' )->where ( array (
							'UE_ID' => $_SESSION ['uid']
					) )->save (array('UE_secpwd'=>md5($data_P['xejmm'])));
						$user6 = M ( 'user' )->where ( array ('UE_ID' => $_SESSION ['uid']) )->find();
						vendor("Sendsms.sendsms");
						$send = new \Sendsms();
						if ($user6['ue_phone']) $mes = $send->my_send($user6['ue_phone'], "您好！您正在修改V3财富账号的密码，如非本人操作，请联系V3财富管理员！【V3财富】");
						
					if ($reg) {
						$this->success('修改成功',U("Home/Index/index"));exit;
					} else {
						die("<script>alert('修改失敗！');history.back(-1);</script>");
					}
				}
			}
		}
	}
	
	public function bdmbadd() {
	
		if (IS_AJAX) {
			$data_P = I ( 'post.' );
	
			$user1 = M ();
			if (! $this->check_verify ( I ( 'post.yzm' ) )) {
					
				$this->ajaxReturn ( array ('nr' => '驗證碼錯誤!','sf' => 0 ) );
			}elseif ($data_P['wt1'] == '0' ||$data_P['wt2'] == '0'||$data_P['wt3'] == '0') {
				$this->ajaxReturn ( array ('nr' => '請選擇問題!','sf' => 0 ) );
			}elseif ($data_P['wt1'] == $data_P['wt2'] ||$data_P['wt1'] == $data_P['wt3']||$data_P['wt2'] == $data_P['wt3']) {
				$this->ajaxReturn ( array ('nr' => '密保問題不能相同!','sf' => 0 ) );
			} elseif (strlen($data_P['wt1']) > 60 ||strlen($data_P['wt2']) > 60||strlen($data_P['wt3']) > 60) {
				$this->ajaxReturn ( array ('nr' => '問題格式不對!','sf' => 0 ) );
			} elseif (strlen($data_P['da1']) > 20 ||strlen($data_P['da2']) > 20||strlen($data_P['da3']) > 20) {
				$this->ajaxReturn ( array ('nr' => '答案1-10個字！','sf' => 0 ) );
			}elseif (strlen($data_P['da1']) < 1 ||strlen($data_P['da2']) < 1||strlen($data_P['da3']) < 1) {
				$this->ajaxReturn ( array ('nr' => '答案1-10個字！','sf' => 0 ) );
			}elseif (! $user1->autoCheckToken ( $_POST )) {
				$this->ajaxReturn ( array ('nr' => '新勿重複提交,請刷新頁面!','sf' => 0 ) );
			} else {
				$addaccount = M ( 'user' )->where ( array (UE_account => $_SESSION ['uname']) )->find ();
	
				if ($addaccount['ue_question']<>'') {
					$this->ajaxReturn ( array ('nr' => '您已經設置過密保!','sf' => 0 ) );
				//}elseif(false){
				//	$this->ajaxReturn ( array ('nr' => '新勿重複提交,請刷新頁面!','sf' => 0 ) );
				} else {
	                
					
					$data_up['UE_question'] = $data_P['wt1'];
					$data_up['UE_question2'] = $data_P['wt2'];
					$data_up['UE_question3'] = $data_P['wt3'];
					$data_up['UE_answer'] = $data_P['da1'];
					$data_up['UE_answer2'] = $data_P ['da2'];
					$data_up['UE_answer3'] = $data_P ['da3'];
					
					
					$reg = M ( 'user' )->where ( array (
							'UE_ID' => $_SESSION ['uid']
					) )->save ($data_up);
	
	                  
	
					if ($reg) {
						$this->ajaxReturn ( array ('nr' => '綁定成功!','sf' => 0 ) );
					} else {
						$this->ajaxReturn (  array ('nr' => '綁定失敗!','sf' => 0 ));
					}
				}
			}
		}
	}
	
	public function xgmbadd() {
	
		if (IS_AJAX) {
			$data_P = I ( 'post.' );
			//dump($data_P);die;
			//$this->ajaxReturn($data_P['ymm']);die;
			//$user = M ( 'user' )->where ( array (
			//		UE_account => $_SESSION ['uname']
			//) )->find ();
	
			$user1 = M ();
			//! $this->check_verify ( I ( 'post.yzm' ) )
			//! $user1->autoCheckToken ( $_POST )
			$addaccount = M ( 'user' )->where ( array (UE_account => $_SESSION ['uname']) )->find ();
			if (! $this->check_verify ( I ( 'post.yzm' ) )) {
				$this->ajaxReturn ( array ('nr' => '驗證碼錯誤!','sf' => 0 ) );
			}elseif ($addaccount['ue_question']=='') {
				$this->ajaxReturn ( array ('nr' => '您從未綁定過密保,請先綁定保密!','sf' => 0 ) );
			}elseif ($addaccount['ue_answer']<>$data_P['yda1']||$addaccount['ue_answer2']<>$data_P['yda2']||$addaccount['ue_answer3']<>$data_P['yda3']) {
				$this->ajaxReturn ( array ('nr' => '原密保答案不正確!','sf' => 0 ) );
			}elseif ($data_P['wt1'] == '0' ||$data_P['wt2'] == '0'||$data_P['wt3'] == '0') {
				$this->ajaxReturn ( array ('nr' => '請選擇新保密問題!','sf' => 0 ) );
			}elseif ($data_P['wt1'] == $data_P['wt2'] ||$data_P['wt1'] == $data_P['wt3']||$data_P['wt2'] == $data_P['wt3']) {
				$this->ajaxReturn ( array ('nr' => '新保密問題不能相同!','sf' => 0 ) );
			} elseif (strlen($data_P['wt1']) > 60 ||strlen($data_P['wt2']) > 60||strlen($data_P['wt3']) > 60) {
				$this->ajaxReturn ( array ('nr' => '新保密問題格式不對!','sf' => 0 ) );
			} elseif (strlen($data_P['da1']) > 20 ||strlen($data_P['da2']) > 20||strlen($data_P['da3']) > 20) {
				$this->ajaxReturn ( array ('nr' => '新保密答案1-10個字！','sf' => 0 ) );
			}elseif (strlen($data_P['da1']) < 1 ||strlen($data_P['da2']) < 1||strlen($data_P['da3']) < 1) {
				$this->ajaxReturn ( array ('nr' => '新保密答案1-10個字！','sf' => 0 ) );
			}elseif (false) {
				$this->ajaxReturn ( array ('nr' => '新勿重複提交,請刷新頁面!','sf' => 0 ) );
			} else {
				
	
				//if ($addaccount['ue_question']<>'') {
				//	$this->ajaxReturn ( array ('nr' => '您已經設置過密保!','sf' => 0 ) );
					//}elseif(false){
					//	$this->ajaxReturn ( array ('nr' => '新勿重複提交,請刷新頁面!','sf' => 0 ) );
				//} else {
					 
						
					$data_up['UE_question'] = $data_P['wt1'];
					$data_up['UE_question2'] = $data_P['wt2'];
					$data_up['UE_question3'] = $data_P['wt3'];
					$data_up['UE_answer'] = $data_P['da1'];
					$data_up['UE_answer2'] = $data_P ['da2'];
					$data_up['UE_answer3'] = $data_P ['da3'];
						
						
					$reg = M ( 'user' )->where ( array (
							'UE_ID' => $_SESSION ['uid']
					) )->save ($data_up);
	
					 
	
					if ($reg) {
						$this->ajaxReturn (array ('nr' => '修改成功!','sf' => 0 ) );
					} else {
						$this->ajaxReturn ( array ('nr' => '修改失敗!','sf' => 0 ) );
					}
				//}
			}
		}
	}
	
	public function cwmx_old() {
		//提供帮助钱包
// 		$User = M ( 'user_jj' ); // 實例化User對象
// 		//session(uname)是用户在登录之后就存在的
// 		$map1['user']=$_SESSION['uname'];
// 		$count1 = $User->where ( $map1 )->count (); // 查詢滿足要求的總記錄數
		
// 		$p1 = getpage($count1,10);
		
// 		$list1 = $User->where ( $map1 )->order ( 'id DESC' )->limit ( $p1->firstRow, $p1->listRows )->select ();
// 		$this->assign ( 'list1', $list1 ); // 賦值數據集
// 		$this->assign ( 'page1', $p1->show() ); // 賦值分頁輸出
// 		//互助钱包记录
// 		$User = M ( 'userget' ); // 實例化User對象
		
// 		$map['UG_account']=$_SESSION['uname'];
// 		$map['UG_type']='jb';
// 		$count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數
// 		//$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
		
// 		$p = getpage($count,10);
		
// 		$list = $User->where ( $map )->order ( 'UG_ID DESC' )->limit ( $p->firstRow, $p->listRows )->select ();
// 		$this->assign ( 'list', $list ); // 賦值數據集
// 		$this->assign ( 'page', $p->show()); // 賦值分頁輸出
// 		/////////////////----------------
		
		
// 		$userdata = M ( 'user' )->where ( array (
// 				'UE_account' => $_SESSION ['uname']
// 		) )->find ();
// 		$this->userdata=$userdata;
		
// 	dump($list1);exit;
		$this->display('cwmx');
	}
	public function cwmx(){
	    $settings = include( APP_PATH . 'Home/Conf/settings.php' );
	    $userGet = M('userget');
	    //静态钱包
	    $map['UG_account']=$_SESSION['uname'];
	    $map['UG_type']='jb';
	    $map['wallettype'] =1;
	    $list = $userGet->where($map)->select();
	    foreach ($list as $key=>$v){
	        $dk_time = M('ppdd')->where(array('id'=>$v['ppddid']))->getField('date_hk');
	        $list[$key]['backtime'] = date("Y-m-d H:i:s",strtotime($dk_time)+$settings['backtopack']*3600);
	    }
	    //动态钱包
	    $map1['UG_account']=$_SESSION['uname'];
	    $map1['UG_type']='jb';
	    $map1['wallettype'] = 0;
	    $list2 = $userGet->where($map1)->select();
	    rsort($list);
	    $this->assign('list',$list);
	    $this->assign('list2',$list2);
	    $this->display('cwmx');
	}
	
	public function tgbz_tx_cl() {
	$settings = include( dirname( dirname( __FILE__ ) ) . '/Conf/settings.php' );
		if(I('get.id')<>''){
			$varid=I('get.id');
			$proall = M('user_jj')->where(array('id'=>$varid))->find();
			if(user_jj_zt($varid)=='0'||$proall['zt']=='1'){
				die("<script>alert('转出失败,时间没有大于".$settings['withdraw_day_diff']."天或交易未完成！');history.back(-1);</script>");
			}else{
				
				$lx_he1=user_jj_lx($varid)*0.8+$proall['jb'];
				
				$money2=user_jj_lx($varid)*0.1;
				$user_zq=M('user')->where(array('UE_ID'=>$_SESSION['uid']))->find();
				M('user')->where(array('UE_ID'=>$_SESSION['uid']))->setInc('UE_money',$lx_he1);
				M('user')->where(array('UE_ID'=>$_SESSION['uid']))->setInc('shop_money',$money2);
				$user_xz=M('user')->where(array('UE_ID'=>$_SESSION['uid']))->find();
				M('user_jj')->where(array('id'=>$varid))->save(array('zt'=>'1'));
				
				$note3 = "提供帮助本金加利息";
				$record3 ["UG_account"] = $_SESSION['uname']; // 登入轉出賬戶
				$record3 ["UG_type"] = 'jb';
				$record3 ["UG_allGet"] = $user_zq['ue_money']; // 金幣
				$record3 ["UG_money"] = '+'.$lx_he1; //
				$record3 ["UG_balance"] = $user_xz['ue_money']; // 當前推薦人的金幣餘額
				$record3 ["UG_dataType"] = 'tgbz'; // 金幣轉出
				$record3 ["UG_note"] = $note3; // 推薦獎說明
				$record3["UG_getTime"]		= date ( 'Y-m-d H:i:s', time () ); //操作時間
				$reg4 = M ( 'userget' )->add ( $record3 );
				$note = "利息10%转入公益钱包";
				$record ["UG_account"] = $_SESSION['uname']; // 登入轉出賬戶
				$record ["UG_type"] = 'jb';
				$record ["UG_allGet"] = $user_zq['shop_money']; // 金幣
				$record ["UG_money"] = '+'.$money2; //
				$record ["UG_balance"] = $user_xz['shop_money']; // 當前推薦人的金幣餘額
				$record ["UG_dataType"] = 'tgbz'; // 金幣轉出
				$record ["UG_note"] = $note; // 推薦獎說明
				$record["UG_getTime"]		= date ( 'Y-m-d H:i:s', time () ); //操作時間
				$reg = M ( 'userget' )->add ( $record );
				$note1 = "利息10%作为平台维护费";
				$record1 ["UG_account"] = $_SESSION['uname']; // 登入轉出賬戶
				$record1 ["UG_type"] = 'jb';
				//$record1 ["UG_allGet"] = $user_zq['ue_money']; // 金幣
				$record1 ["UG_money"] ='-'.$money2; //
				//$record1 ["UG_balance"] = $user_xz['ue_money']; // 當前推薦人的金幣餘額
				$record1 ["UG_dataType"] = 'tgbz'; // 金幣轉出
				$record1 ["UG_note"] = $note1; // 推薦獎說明
				$record1["UG_getTime"]		= date ( 'Y-m-d H:i:s', time () ); //操作時間
				$reg = M ( 'userget' )->add ( $record1 );
				$this->success("提现转出成功.请查看您的账户余额！");
				// die("<script>alert('提现转出成功.请刷新查看你的账户余额！');history.back(-1);</script>");
				//echo $lx_he;
			}
			
			
		}
	
	}
	public function backtopack(){
	    $id = I('get.id');
	    $ug = M("userget")->where(array('UG_ID'=>$id,'status'=>0))->find();
	    if(!$ug){
	        die("<script>alert('交易信息不存在！');parent.window.location.href='/Home/Index/index';</script>");
	    }
	    
	    $benjin = $ug['benjin'];
	    $lixi   = $ug['ug_money'];
	    $allget = $benjin + $lixi;
	    $model = M();
	    $model->startTrans();
	    $res = M('user')->where(array("UE_account"=>$ug['ug_account']))->setInc('UE_money',$allget);
	    if(!$res){
	        $model->rollback();
	        $this->error('回包失败',U('cwmx'));
	    }
	    $user =  M('user')->where(array('UE_account'=>$ug['ug_account']))->find();
	    $res1 = M("userget")->where(array('UG_ID'=>$id,'status'=>0))->save(['status'=>1]);
	    if(!$res1){
	        $model->rollback();
	       $this->error('回包失败',U('cwmx'));
	    }
	    $user_after =  M('user')->where(array('UE_account'=>$ug['ug_account']))->getField('UE_money');
	    $record3 ["UG_allGet"] = $user['ue_money'];
	    $record3 ["UG_balance"] = $user_after;
	    $record3 ["UG_othraccount"] = 1;
	    $time=date('Y-m-d H:i:s',time());
	    
	    $record3 ["UG_account"] = $ug['ug_account']; // 登入轉出賬戶
	    $record3 ["UG_type"] = 'jb';
	    
	    $record3 ["UG_money"] = $benjin; //
	    $record3 ["UG_dataType"] = 'jtj'; // 金幣轉出
	    
	    $record3 ["UG_note"] = '静态本金回包'; // 推薦獎說明
	    $record3['status'] = 1;
	    $record3["UG_getTime"] = date ('Y-m-d H:i:s', time ()); //操作時間
	    $record3['wallettype'] = 1;
	    $reg3 = M ('userget' )->add ($record3);
	    if(!$reg3){
	        $model->rollback();
	        $this->error('回包失败',U('cwmx'));
	    }
	    $model->commit();
	    $this->success('回包成功，请及时查看你的账户',U('Home/Index/index'));
	}
	
	
	
	public function pin() {
	
	
		//////////////////----------
		$User = M ( 'pin' ); // 實例化User對象
	
		$map1['user']=$_SESSION['uname'];
		$count1 = $User->where ( $map1 )->count (); // 查詢滿足要求的總記錄數
		//$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
	
		$p1 = getpage($count1,10);
	
		$list1 = $User->where ( $map1 )->order ( 'id DESC' )->limit ( $p1->firstRow, $p1->listRows )->select ();
		$this->assign ( 'list1', $list1 ); // 賦值數據集
		$this->assign ( 'page1', $p1->show() ); // 賦值分頁輸出
		/////////////////----------------
	
		$this->pin_zs=M('pin')->where ( array('user'=>$_SESSION['uname'],'zt'=>0) )->count ()+0;
	
	
	
		// 激活码转账记录
		$map2['UG_account'] = $_SESSION['uname'];
		$map2['UG_othraccount'] = $_SESSION['uname'];
		$map2['_logic'] = 'or';
		$where['_complex'] = $map2;
		$where['UG_dataType'] = array('in', array('jbzc','jbzr'));
		
		$count2 = M('userget')->where($where)->count();
		$p2 = getpage($count2, 10);
		$list2 = M('userget')->where($where)->order('UG_getTime desc')->limit($p2->firstRow, $p2->listRows)->select();
		
		$this->assign ( 'list2', $list2 );
		$this->assign ( 'page2', $p2->show() );
	
		$this->display('pin');
	}
	public function pin_list(){
	    // 激活码转账记录
	    $map2['UG_account'] = $_SESSION['uname'];
	    $map2['UG_othraccount'] = $_SESSION['uname'];
	    $map2['_logic'] = 'or';
	    $where['_complex'] = $map2;
	    $where['UG_dataType'] = array('in', array('jbzc','jbzr'));
	    
	    $count2 = M('userget')->where($where)->count();
	    $p2 = getpage($count2, 10);
	    $list2 = M('userget')->where($where)->order('UG_getTime desc')->limit($p2->firstRow, $p2->listRows)->select();
	    $this->assign ( 'list', $list2 );
	    $this->assign ( 'page', $p2->show() );
	    $this->display('pin_list');
	}
	
	//一键回包
	//积分互转记录
	public function jifen() {
		$info = M('user')->field('UE_money,shop_money')->where(array('UE_account'=>$_SESSION['uname']))->find();
		$map2['UG_account'] = $_SESSION['uname'];
		$map2['UG_othraccount'] = $_SESSION['uname'];
		$map2['_logic'] = 'or';
		$where['_complex'] = $map2;
		$where['UG_dataType'] = array('in', array('jfzc','jfzr'));
		$count2 = M('userget')->where($where)->count();
		$p2 = getpage($count2, 10);
		$list2 = M('userget')->where($where)->order('UG_getTime desc')->limit($p2->firstRow, $p2->listRows)->select();
		$this->assign ( 'info', $info );
		$this->assign ( 'list2', $list2 );
		$this->assign ( 'page2', $p2->show() );
		$this->display('jifen');
	}
	// 积分转账处理
	public function jfzzcl() {
		if (IS_POST) {
			$data_P = I ( 'post.' );
			$user_df = M ( 'user' )->where ( array ('UE_account' => $data_P['user']) )->find ();
			$userxx=M('user')->where(array('UE_account'=>$_SESSION['uname']))->find();
			if($userxx['ue_secpwd']<>md5($data_P['ejmm'])){
				die("<script>alert('二级密码输入有误！');history.back(-1);</script>");
			}elseif($data_P['type'] == '' || $data_P['type'] > 2){
				die("<script>alert('请选择您要转让的类型！');history.back(-1);</script>");
			}else{
				$jbhe=$data_P ['sh'];
				if (! preg_match ( '/^[0-9]{1,10}$/', $data_P ['sh'] )||!$data_P ['sh']>0) {
					die("<script>alert('金额输入有勿！');history.back(-1);</script>");
				}elseif (!$user_df) {
					die("<script>alert('对方账号不存在！');history.back(-1);</script>");
				}else {

					if($data_P['type'] == 1){
						if($userxx['ue_money'] < $data_P ['sh']){
							die("<script>alert('静态积分不足！');history.back(-1);</script>");
						}
						if($data_P ['sh'] < 500 || $data_P ['sh']%500>0){
							die("<script>alert('静态积分转让至少500且是500的倍数！');history.back(-1);</script>");
						}
						M('user')->where(array('UE_account'=>$_SESSION['uname']))->setDec('UE_money',$jbhe);
						$after = M('user')->where(array('UE_account'=>$_SESSION['uname']))->getField('UE_money');
						$note3 = "积分转出";
						$record3 ["UG_account"] = $_SESSION['uname']; // 登入转出账户
						$record3 ["UG_type"] = 'jf';
						$record3 ["UG_allGet"] = $userxx['ue_money']; // 金币
						$record3 ["UG_money"] = '-'.$jbhe; //
						$record3 ["UG_balance"] = $after; // 当前推荐人的金币馀额
						$record3 ["UG_dataType"] = 'jfzc'; // 金币转出
						$record3 ["UG_note"] = $note3; // 推荐奖说明
						$record3["UG_getTime"]		= date ( 'Y-m-d H:i:s', time () ); //操作时间
						$record3['UG_othraccount'] = $data_P['user'];
						$reg4 = M ( 'userget' )->add ( $record3 );
						M('user')->where(array('UE_account'=>$data_P['user']))->setInc('UE_money',$jbhe);
						$after1 = M('user')->where(array('UE_account'=>$data_P['user']))->getField('UE_money');
						$note3 = "积分转入";
						$record3 ["UG_account"] = $_SESSION['uname']; // 登入转出账户
						$record3 ["UG_type"] = 'jf';
						$record3 ["UG_allGet"] = $user_df['ue_money']; // 金币
						$record3 ["UG_money"] = '+'.$jbhe; //
						$record3 ["UG_balance"] = $after1; // 当前推荐人的金币馀额
						$record3 ["UG_dataType"] = 'jfzr'; // 金币转出
						$record3 ["UG_note"] = $note3; // 推荐奖说明
						$record3["UG_getTime"]		= date ( 'Y-m-d H:i:s', time () ); //操作时间
						$record3['UG_othraccount'] = $data_P['user'];
						$reg4 = M ( 'userget' )->add ( $record3 );
						$this->success('转让成功!');
					}
					if($data_P['type'] == 2){
						if($userxx['shop_money'] < $data_P ['sh']){
							die("<script>alert('商城积分不足！');history.back(-1);</script>");
						}
						M('user')->where(array('UE_account'=>$_SESSION['uname']))->setDec('shop_money',$jbhe);
						$after = M('user')->where(array('UE_account'=>$_SESSION['uname']))->getField('shop_money');
						$note3 = "积分转出";
						$record3 ["UG_account"] = $_SESSION['uname']; // 登入转出账户
						$record3 ["UG_type"] = 'jf';
						$record3 ["UG_allGet"] = $userxx['shop_money']; // 金币
						$record3 ["UG_money"] = '-'.$jbhe; //
						$record3 ["UG_balance"] = $after; // 当前推荐人的金币馀额
						$record3 ["UG_dataType"] = 'jfzc'; // 金币转出
						$record3 ["UG_note"] = $note3; // 推荐奖说明
						$record3["UG_getTime"]		= date ( 'Y-m-d H:i:s', time () ); //操作时间
						$record3['UG_othraccount'] = $data_P['user'];
						$reg4 = M ( 'userget' )->add ( $record3 );
						M('user')->where(array('UE_account'=>$data_P['user']))->setInc('shop_money',$jbhe);
						$after1 = M('user')->where(array('UE_account'=>$data_P['user']))->getField('shop_money');
						$note3 = "积分转入";
						$record3 ["UG_account"] = $_SESSION['uname']; // 登入转出账户
						$record3 ["UG_type"] = 'jf';
						$record3 ["UG_allGet"] = $user_df['shop_money']; // 金币
						$record3 ["UG_money"] = '+'.$jbhe; //
						$record3 ["UG_balance"] = $after1; // 当前推荐人的金币馀额
						$record3 ["UG_dataType"] = 'jfzr'; // 金币转出
						$record3 ["UG_note"] = $note3; // 推荐奖说明
						$record3["UG_getTime"]		= date ( 'Y-m-d H:i:s', time () ); //操作时间
						$record3['UG_othraccount'] = $data_P['user'];
						$reg4 = M ( 'userget' )->add ( $record3 );
						$this->success('转让成功!');
					}	
				}
			}
		}
	}
	public function aab() {

		
		
		$arr = array(1,2,3,4,5,6,7,8,9,10);
		$p=0;
		$tj=count($arr);
		
		//$tj1=$tj;
		//$bba=array_slice($arr,0,1);
		//dump($bba);
		//die;
		//0,4
		
		
		
		
		
		for ($m=0;$m<$tj;$m++){
				
		
			for ($p=2;$p+$m<$tj;$p++){
				if($tj-$m<$p){break;}//1,4  5
				$bba=array_slice($arr,$m,2);
				
				//echo $arr[$p].'</br>';
				$bba[]=$arr[$p+$m];
				
				foreach ($bba as $var)
					echo $var.'+';
				
				//dump($bba);
				echo '='.array_sum($bba).'<br/>';
				//$bba=array();
			}
			//$tj1--;
			//$a=
			//$tj2=$tj1-1;
			//echo '------------<br>';
				
				
		}
		
		
		//die;
		
		
		
		for ($m=0;$m<$tj;$m++){
			

			for ($p=2;$p<=$tj;$p++){
				if($tj-$m<$p){break;}//1,4  5
		        $bba=array_slice($arr,$m,$p);
		       // dump($bba);
		        foreach ($bba as $var)
		        	echo $var.'+';
		        
		        echo '='.array_sum($bba).'<br/>';
		        //$bba=array();
			}
			//$tj1--;
			//$a= 
			//$tj2=$tj1-1;
			//echo '------------<br>';
			
			
		}
		
		
		die;
		
		
		
		
		
		sort($arr); //保证初始数组是有序的
		$last = count($arr) - 1; //$arr尾部元素下标
		$x = $last;
		$count = 1; //组合个数统计
		echo implode(',', $arr), "\n"; //输出第一种组合
		echo "<br/>";
		while (true) {
		$y = $x--; //相邻的两个元素
		if ($arr[$x] < $arr[$y]) { //如果前一个元素的值小于后一个元素的值
		$z = $last;
		while ($arr[$x] > $arr[$z]) { //从尾部开始，找到第一个大于 $x 元素的值
		$z--;
		}
		/* 交换 $x 和 $z 元素的值 */
		list($arr[$x], $arr[$z]) = array($arr[$z], $arr[$x]);
		/* 将 $y 之后的元素全部逆向排列 */
		for ($i = $last; $i > $y; $i--, $y++) {
		list($arr[$i], $arr[$y]) = array($arr[$y], $arr[$i]);
		}
		 echo implode(',', $arr), "\n"; //输出组合
 echo "<br/>";
		$x = $last;
		$count++;
		}
		if ($x == 0) { //全部组合完毕
		break;
		}
		}
		echo '组合个数： ', $count, "\n";
		//输出结果为：3628800个
		
		
		die;
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		$xypipeije=16;
		$data=array(1,2,3,4,5,6,7,8);
		$tj=count($data);
		$sf_tcpp='0';
		
		for ($m=0;$m<$tj;$m++){
			
			for ($p=0;$p<$tj-$m;$p++){
			$data1[$m][$p]=$data[$m];

			}
		}
		$adsfdsaf=$data1[0];
		dump($adsfdsaf);die;
		
		for ($v=0;$v<$tj;$v++){
			
			for ($c=0;$c<$tj;$c++){
		        echo $data[$v]+$data[$c+1].'<br>';
		
			}
		}
		
		die;
		
		
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
	
	
	
}