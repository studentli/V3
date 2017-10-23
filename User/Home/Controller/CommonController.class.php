<?php

namespace Home\Controller;

use Think\Controller;

class CommonController extends Controller {

	public function _initialize()
    {
        header("Content-Type:text/html; charset=utf-8");
        $qylx =array(
            array('ty_jt_li' ,'baiyin_jt_li_out' ),
            array('baiyin_jt_li','baiyin_jt_li_out'),
            array('baiyin_jt_li' ,'baiyin_jt_li_out'),
            array('baiyin_jt_li','baiyin_jt_li_out'),
        );
        if (isMobile()) {
            C("DEFAULT_THEME", 'wap');
        }
        if (isMobile() && $_SERVER['SERVER_NAME'] == '3b.zzjunyi.cn') {
            echo "<script>alert('请访问手机域名:3bwap.zzjunyi.cn');location.href='http://wap3a.zzjunyi.cn'</script>";
        }
        $zt = M('system')->where(array('SYS_ID' => 1))->find();
        if ($zt['zt'] <> 0) {
            $this->error('系统升级中,请稍后访问!', '/Home/Login/index');
            die;
        }
        $czmcsy = CONTROLLER_NAME . ACTION_NAME;
        $czmc = ACTION_NAME;
        if ($czmcsy != 'Indexindex' && $czmcsy != "Indexhome") {
            if (!isset ($_SESSION ['uid'])) {
                $this->redirect('Index/index');
            }
            $this->checkAdminSession();
        }

        $userData = M('user')->where(array('UE_ID' => $_SESSION ['uid']))->find();
        $userData['pinCount'] = M('pin')->where(array('user'=>$userData['ue_account'],'zt'=>0))->count();
        $this->userData = $userData;
        $ob = M('user')->where(array('UE_account' => $userData['ue_account']))->find();
        $username = $userData['ue_account'];
        $settings = include(APP_PATH . 'Home/Conf/settings.php');

        $ppddxx = M('ppdd')->where(array('p_user' => $_SESSION['uname'], 'zt' => 0,'zhh'=>0))->select();//查询所有已匹配未打款

        //匹配进场后48小时内必须打款。超出时间没有打款，该账户冻结，由推荐人接单
        foreach ($ppddxx as $v) {
            $now_time = time();
            $pp_date = strtotime($v['date']) + $settings['cold2_user_time'] * 3600;

            if ($now_time > $pp_date) {//当前时间大于最后打款时间
                //打款方冻结账号
                M('user')->where(array('UE_account' => $v['p_user']))->save(array('cold' => 1, 'cold_type' => 1));
                $user_zq = M('user')->where(array('UE_account' => $v['p_user']))->find();
                //修改提供帮助订单
                M('tgbz')->where(array('id' => $v['p_id']))->save(array('user' => $user_zq['ue_accname'], 'date' => date('Y-m-d H:i:s', time())));
                //修改接受帮助订单恢复
                M('jsbz')->where(array('id' => $v['g_id']))->save(array('data' => date('Y-m-d H:i:s', time())));
                //修改user_jj表
                M('user_jj')->where(array('r_id' => $v['id']))->save(array('user' => $user_zq['ue_accname'], 'data' => date('Y-m-d H:i:s', time())));
                M('ppdd')->where(array('id' => $v['id']))->save(array('p_user' => $user_zq['ue_accname'], 'zhh' => 1, 'date' => date('Y-m-d H:i:s', time())));
            }
        }

        //推荐人接单后需要在24小时内打款，24小时内没有打款的，此推荐人全部动态奖金烧伤（扣除）50%，由平台接单。
        $ppdd_list = M('ppdd')->where(array('p_user' => $_SESSION['uname'], 'zt' => 0,'zhh'=>1))->select();//推荐人接单 的订单

        foreach ($ppdd_list as $v) {
            $now_time = time();
            $pp_date = strtotime($v['date']) + $settings['cold5_user_time'] * 3600;
            if ($now_time > $pp_date) {//当前时间大于最后打款时间
                //动态奖金扣除50%
                $tj_he = M('user')->where(array('UE_account' => $v['p_user']))->getField('tj_he');
                $money =  $tj_he * $settings['shaoshang_jl']/100;
                //打款方冻结账号
                M('user')->where(array('UE_account' => $v['p_user']))->save(array('tj_he' => $money,'cold' => 1, 'cold_type' => 6));

                //平台账号接单
                //修改提供帮助订单
                M('tgbz')->where(array('id' => $v['p_id']))->save(array('user' => $settings['admin_users'], 'date' => date('Y-m-d H:i:s', time())));
                //修改接受帮助订单恢复
                M('jsbz')->where(array('id' => $v['g_id']))->save(array('data' => date('Y-m-d H:i:s', time())));
                //修改user_jj表
                M('user_jj')->where(array('r_id' => $v['id']))->save(array('user' => $settings['admin_users'], 'data' => date('Y-m-d H:i:s', time())));
                M('ppdd')->where(array('id' => $v['id']))->save(array('p_user' => $settings['admin_users'], 'zhh' => 2, 'data' => date('Y-m-d H:i:s', time())));
            }
        }
            //注册激活48小时不排单冻结账号
            $tgbz=M('tgbz')->where(array('user'=>$_SESSION['uname']))->count();
            if($tgbz<1){
					$regdate=M('user')->where(array('UE_account'=>$_SESSION['uname']))->getField('UE_regTime');
  					$regdate=strtotime($regdate) + $settings['cold1_user_time']*3600;
                    $date=time();
					if($date > $regdate){
						M('user')->where(array('UE_account'=>$_SESSION['uname']))->save(array('cold'=>1,'cold_type'=>2));
					}
            }else{
                    // 收款后在24小时内必须下单，否则系统将自动进行冻结，该账户所有奖金清零。
					$tgdate=M('tgbz')->where(array('user'=>$_SESSION['uname'],'qr_zt'=>1))->order('date desc')->getField('date1');
                    if(!empty($tgdate)){
                        $tgdate = strtotime($tgdate) + $settings['cold3_user_time']*3600;
                        $time11 = time();
                        if($time11 > $tgdate){
                            M('user')->where(array('UE_account'=>$_SESSION['uname']))->save(array('tj_he'=>0,'cold'=>1,'cold_type'=>3));
                        }
                    }

            }
		    //推荐人直接推荐的会员有3人以上（含3人）没有诚信打款的，此推荐人动态奖金全部归零
            $user_zq_count = M('user')->where(array('UE_accName'=>$_SESSION['uname'],'cold'=>1,'cold_type'=>1))->count();
		    if($user_zq_count >= 3){
                M('user')->where(array('UE_account'=>$_SESSION['uname']))->save(array('tj_he'=>0,'cold'=>1,'cold_type'=>4));
            }

        //对方打款后，收款方需在24小时内确认。超时未确认的，系统自动确认，同时冻结该账户, 静态奖和动态奖照发
        $ppddxx_list = M('ppdd')->where(array('p_user' => $_SESSION['uname'], 'zt' => 1))->field('date_hk,g_user,p_user,p_id,g_id,id,jb')->select();//查询所有已打款 未收款的订单
        
        foreach ($ppddxx_list as $v) {
            $now_time = time();
            $pp_date = strtotime($v['date_hk']) + $settings['cold4_user_time'] * 3600;
            if ($now_time > $pp_date) {//当前时间大于最后收款款时间
                //收款方冻结
                $ob1=M('user')->where(array ('UE_account' => $v['g_user']) )->save(array('cold'=>1,'cold_time'=>$now_time,'cold_type'=>5));
                //修改匹配订单
                $ob2 = M('ppdd')->where(array('id' => $v['id']))->save(array('zt' => '2', 'date1' => $now_time));//更新此订单状态
                //修改user_jj订单
                $ob3 = M('user_jj')->where(array('r_id' => $v['id']))->save(array('zt' => '0'));
                //修改提供帮助订单
                $ob4 = M('tgbz')->where(array('id' => $v['p_id']))->save(array('qr_zt' => '1'));//提现订单已确认
                //修改求助单
                $ob5 = M('jsbz')->where(array('id' => $v['g_id']))->save(array('qr_zt' => '1'));//提现订单已确认
               
                $qy = $v['qy'];
                //-------------发放静态奖金开始--------------//
                $dk_time = strtotime($v['date_dk']);//当前时间
                $jl_time = strtotime($v['date']) + $settings['max_baiyin_hours']*3600;//五小时之后的时间
                $user = M('user')->where(array('UE_account'=>$_SESSION['uname']))->field('UE_level,UE_money')->find();
                if($dk_time <= $jl_time){//N小时内打款奖励利息
                    $lixi = $settings[$qylx[$qy-1][0]] + $settings[$qylx[$qy-1][1]];
                }else{
                    $lixi = $settings[$qylx[$qy-1][0]];
                               }
                $money =  $ppddxx['jb'] + $ppddxx['jb']*$lixi/100.0;
//                 M('ppdd')->where(array('id' => $data_P['id'], 'zt' => '1'))->save(['pusermoney'=>$money]);
//                 M('user')->where(array('UE_account'=>$ppddxx['p_user']))->setInc('UE_money',$money);
                $user_after =  M('user')->where(array('UE_account'=>$ppddxx['p_user']))->getField('UE_money');
                $record3 ["UG_allGet"] = $user['ue_money'];
                $record3 ["UG_balance"] = $user_after + $money;
                $record3 ["UG_othraccount"] = 1;
                $time=date('Y-m-d H:i:s',time());

                $record3 ["UG_account"] = $ppddxx['p_user']; // 登入轉出賬戶
                $record3 ["UG_type"] = 'jb';

                $record3 ["UG_money"] = $money; //
                $record3 ["UG_dataType"] = 'jtj'; // 金幣轉出

                $record3 ["UG_note"] = '静态奖金'; // 推薦獎說明
                $record3['status'] = 0;
                $record3["UG_getTime"] = date ('Y-m-d H:i:s', time ()); //操作時間
                $reg3 = M ('userget' )->add ($record3);
                
                //-------------发放静态奖金结束--------------//

                $tgbz_user_xx = M('user')->where(array('UE_account' => $v['p_user']))->find(); //充值人详细
                if ($tgbz_user_xx['ue_accname'] <> '')//推荐人
                {

                    $accname_zq = M('user')->where(array('UE_account' => $tgbz_user_xx['ue_accname']))->find();
                    $this_node = $tgbz_user_xx['ue_accname'];
                    $i = $settings['max_user_level'];
                    $shaoshang = $settings['shaoshang'];
                    while ($i--) {

                        $uname = M('user')->where(array('UE_account' => $this_node))->find();
                        if ($this_node && strlen($this_node)) {
                            //烧伤 判断最小的那一个订单 发奖金
                            if ($shaoshang == 1) {
                                $redaxiao = M('tgbz')->where(['user' => $this_node])->order('date desc')->group('date')->limit(1)->getField('sum(jb)');
                                if ($redaxiao) {
                                    if ($redaxiao < $ppddxx['jb']) {
                                        $ppddmoney = $redaxiao;
                                    } else {
                                        $ppddmoney = $ppddxx['jb'];
                                    }
                                } else {
                                    $ppddmoney = 0;
                                }
                            } else {
                                $ppddmoney = $ppddxx['jb'];
                            }
                            //烧伤
                            //------------------动态奖金发放开始------------//
                            if (($settings['max_user_level'] - $i) == 1)
                            {
                                $this_node = masses_j($this_node, $ppddmoney * floatval($settings['baiyin_vip']/100),  '一代推荐奖' . ( floatval($settings['baiyin_vip']) ) . '%', $ppddmoney);
                            } elseif (($settings['max_user_level'] - $i) == 2)
                            {
                                $this_node = $uname['ue_accname'];
                            } elseif (($settings['max_user_level'] - $i) == 3)
                            {
                                $this_node = masses_j($this_node, $ppddmoney * floatval($settings['huangjin_vip']/100),  '三代推荐奖' . ( floatval($settings['huangjin_vip']) ) . '%', $ppddmoney);
                            } elseif (($settings['max_user_level'] - $i) == 4)
                            {
                                $this_node = $uname['ue_accname'];
                            }elseif ( ($settings['max_user_level'] - $i) == 5)
                            {
                                $this_node = masses_j($this_node, $ppddmoney * floatval($settings['zuanshi_vip']/100),  '五代推荐奖' . ( $settings['zuanshi_vip'] ) . '%', $ppddmoney);
                            }else
                            {
                                $this_node = $uname['ue_accname'];
                            }
                            //------------------动态奖金发放结束------------//

                        } else
                        {
                            break;
                        }

                    }
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
                
            }
        }

            if($userData['cold'] == 1){
                 session_unset();
                 session_destroy();
                $this->error("账户已被冻结！","/Home/Login/index");
             }
	}
	
	public function checkAdminSession() {
		//设置超时为10分
		$nowtime = time();
		$s_time = $_SESSION['logintime'];
		if (($nowtime - $s_time) > 3600000) {
		session_unset();
    	session_destroy();
			$this->error('当前用户登录超时，请重新登录', U('/Home/Login/index'));
		} else {
			$_SESSION['logintime'] = $nowtime;
		}
	}
	
	function check_verify($code) {
		$verify = new \Think\Verify ();
		return $verify->check ( $code );
	}
	
	public function getTreeBaseInfo($id) {
		if (! $id)
			return;
		$r = M ( "user" )->where ( array (
				'UE_account' => $id 
		) )->find ();
		$arr = 0;
		xiajirenshu($id,$arr);
		xiajiyeji($id,$yeji);
		$arr++;
		$yeji+= M('ppdd')->where(['p_user'=>$id,'zt'=>2])->sum('jb');
		if ($r)
			return array (
					"id" => $r ['ue_account'],
					"pId" => $r ['ue_accname'],
					"name" => $r ['ue_account'] . "[" .sfjhff($r['ue_status']).",". $r ['ue_truename'] . "," . $r ['ue_activetime'] . "] 团队人数：" .$arr."团队业绩".$yeji
			);
		return;
	}

	
	public function getTreeInfo($id) {
		static $trees = array ();
		$ids = self::get_childs ( $id );
		if (! $ids){
			return $trees;
		}

		$_SESSION['user_jb']++;
		//echo $_SESSION['user_jb'].'<br>';
		foreach ( $ids as $v ) {
			
			$trees [] = $this->getTreeBaseInfo ( $v );
			$this->getTreeInfo ( $v );
		
		}
		//if($_SESSION['user_jb']<'10'){
		
		
		//

		return $trees;
	}
	public static function get_childs($id) {

		if (! $id)
			return null;
		
		$childs_id = array ();
		$childs = M ( "user" )->field ( "UE_account" )->where ( array (
				'UE_accName' => $id 
		) )->select ();
		
		foreach ( $childs as $v ) {
			$childs_id [] = $v ['ue_account'];
		}
		
		if ($childs_id)
			return $childs_id;
		return 0;
	}
	public function getTree() {
		// if (!$this->uid) {
		// echo json_encode(array("status" => 1));
		// return ;
		// }
		$base = $this->getTreeBaseInfo ( $_SESSION ['uname'] );
		$znote = $this->getTreeInfo ( $_SESSION ['uname'] );
		$znote [] = $base;
		// dump($znote);die;
		/*
		 * $znote = array(array("id" => 1, "pId" => 0, "name"=>"1000001"), array("id" => 2, "pId" => 1, "name"=>"1000002"), array("id" => 3, "pId" => 2, "name"=>"1000003"), array("id" => 5, "pId" => 2, "name"=>"1000003"), array("id" => 4, "pId" => 1, "name"=>"1000004") );
		 */
		
		echo json_encode ( array ("status" => 0,"data" => $znote ) );
	}
	
	public function getTreeso() {
		
		if(I('post.user')<>''){
		
		if(! preg_match ( '/^[a-zA-Z0-9]{6,12}$/', I('post.user') )){
			
			echo json_encode ( array ("status" => 1,"data" => '用戶名格式不對!' ) );
			
		}else{
		
		if(!M('user')->where(array('UE_account'=>I('post.user')))->find()){
			echo json_encode ( array ("status" => 1,"data" => '用戶不存在!' ) );
		}elseif(I('post.user')==$_SESSION ['uname']){
			echo json_encode ( array ("status" => 1,"data" => '用戶名不能填自己!' ) );
		}else{
			 $account = M('user')->where(array('UE_account'=>I('post.user')))->find();
			 $accname = $account['ue_accname'];
			for ($i=1;$i<=30;$i++){
				if($accname== $_SESSION ['uname']){$quanxian = 1;$daishu=$i;break;}
				if($accname== ''){$quanxian = 0;break;}
				$account = M('user')->where(array('UE_account'=>$accname))->find();
				$accname = $account['ue_accname'];
			}
			if($quanxian == 1){
				//echo json_encode ( array ("status" => 2 );
						$base = $this->getTreeBaseInfo ( I('post.user') );
		$znote = $this->getTreeInfo ( I('post.user') );
		$znote [] = $base;
		echo json_encode ( array ("status" => 0,"data" => $znote ,"ds" =>$daishu ) );
			}elseif($quanxian == 0){
				echo json_encode ( array ("status" => 1,"data" => '此會員不在您的線下!' ) );
			}
		
		}
		}
		}else{
			
			//echo json_encode ( array ("status" => 0,'nr'=>I('post.user')) );die;
			// if (!$this->uid) {
			// echo json_encode(array("status" => 1));
			// return ;
			// }
			//die;
			$base = $this->getTreeBaseInfo ( $_SESSION ['uname'] );
			$znote = $this->getTreeInfo ($_SESSION ['uname'] );
			$znote [] = $base;
			// dump($znote);die;
			/*
			 * $znote = array(array("id" => 1, "pId" => 0, "name"=>"1000001"), array("id" => 2, "pId" => 1, "name"=>"1000002"), array("id" => 3, "pId" => 2, "name"=>"1000003"), array("id" => 5, "pId" => 2, "name"=>"1000003"), array("id" => 4, "pId" => 1, "name"=>"1000004") );
			*/
			
			echo json_encode ( array ("status" => 0,"data" => $znote ) );
			
		}
	}
	
	
	public function uploadFace() {
	
		//if (!$this->isPost()) {
		//	$this->error('页面不存在');
		//}
		//echo 'asdfsaf';die;
		$upload = $this->_upload('Pic');
		$this->ajaxReturn($upload);
	}
	
	
	
	
	
	Public function _upload ($path) {
		import('ORG.Net.UploadFile');	//引入ThinkPHP文件上传类
		$obj = new \Think\Upload();	//实例化上传类
		$obj->maxSize = 2000000;	//图片最大上传大小
		$obj->savePath =  $path . '/';	//图片保存路径
		$obj->saveRule = 'uniqid';	//保存文件名
		$obj->uploadReplace = true;	//覆盖同名文件
		$obj->exts = array('jpg','jpeg','png','gif');	//允许上传文件的后缀名
	
		$obj->autoSub = true;	//使用子目录保存文件
		$obj->subType = 'date';	//使用日期为子目录名称
		$obj->dateFormat = 'Y_m';	//使用 年_月 形式
		//$obj->upload();die;
		$info   =   $obj->upload();
		if (!$info) {
			die("<script>alert('上传图片错误');history.back(-1);</script>");
		} else {
			foreach($info as $file){
				$pic = $file['savepath'].$file['savename'];
			}
			return $pic;
			//$pic =  $info[0][savename];
			//echo $pic;die;
			/* return array(
					'status' => 1,
					'path' => $pic
			); */
		}
	}
	
	
	
}