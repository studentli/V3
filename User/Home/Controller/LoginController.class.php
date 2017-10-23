<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
	public function __construct(){
		parent::__construct();
		if(isMobile()){
			C("DEFAULT_THEME",'wap');
		} 
		
		if(isMobile() && $_SERVER['SERVER_NAME']=='3a.zzjunyi.cn'){
			echo "<script>alert('请访问手机域名:wap3a.zzjunyi.cn');location.href='http://wap3a.zzjunyi.cn'</script>";
		} 
	}
    public function index(){
        $this->display('login');
    }
    function check_phone1(){
		$phone = I("post.phone");
        $smsnum = rand(1000,9999);
        $_SESSION['smsnum'] = $smsnum;
        vendor("Sendsms.sendsms");
        $send = new \Sendsms();
        if ($phone) $mes = $send->my_send($phone, "您登录的验证码为:" . $smsnum . ",请尽快登录！【V3财富】");
        $aa = substr($mes,7,1);
        $this->ajaxReturn($aa);
	}
    
	function check_phone(){
		$phone = I("post.phone");
		$token = I("post.token");

		if($token <> $_SESSION['token']){
		    $aa = 110;
		    unset($_SESSION['token']);
        $this->ajaxReturn($aa);die;
    }else{
        $smsnum = rand(1000,9999);
        $_SESSION['smsnum'] = $smsnum;
        
        vendor("Sendsms.sendsms");
        $send = new \Sendsms();
        if ($phone)
            $mes = $send->my_send($phone, "您注册的验证码为:" . $smsnum . ",请尽快完成注册！【V3财富】");
                
        unset($_SESSION['token']);
        $aa = substr($mes,7,1);
        $this->ajaxReturn($aa);
        }
	}

	public function retrieve_password(){
		if( IS_POST ){
			$user_data = M( 'user' )->where( array( 'UE_account' => I( 'post.user' ) ) )->find();
			if( $user_data === NULL ){
			 	$this->error( '用户不存在！' );
				return;
			}
			//
			$yzm=I('post.smsnum');
      if($_SESSION['smsnum']!=$yzm||$yzm==''){
				die("<script>alert('验证码错误!');history.go(-1);</script>");
			}
			$password = I('post.password');
			$repassword = I('post.repassword');
			if($password  && $repassword && (md5($password)==md5($repassword)))
           $send_result=M('user')->where(array('UE_account'=>I('post.user')))->save(array('UE_password'=>md5($password)));
			if( $send_result !==false){
				$this->error( '修改成功，请重新登录！', '/Home/Login/index', 2 );
			} else {
				$this->error( '修改失败！请与管理员联系', '/Home/Login/index', 2 );
			}
		} else {
			$this->display('retrieve_password');
		}
	}

	public function retrieve( $check_param_only = false ){
		$user_id = I( 'get.user_id' );
		if( !$user_id ) $user_id = I( 'post.user_id' );
		$token   = I( 'get.token' );
		if( !$token ) $token = I( 'post.token' );

		$user_id = base64_decode( urldecode( $user_id ) );
		$model = M( 'retrieve_token' );

		$retrieve_info = $model->where( array(
			'user_email' => $user_id,
			'token'      => $token,
			'expire_at'  => array( 'gt', time() ),
		) )->find();

		if( !$retrieve_info ){
		 	$this->error( '无效的链接，或已经过期！' );

		 	return false;
		}

		if( $check_param_only ){
			return true;
		}

		$this->assign( 'user_id', base64_encode( $user_id ) );
		$this->assign( 'token', $token );

		$this->display( 'reset_password' );
	}

	public function reset_passwd(){
		$param_check = $this->retrieve( true );

		if( !$param_check ){
			return;
		}

		$user_id = I( 'post.user_id' );
		$token = I( 'post.token' );

		$user_model = M( 'user' );
		$save_result = $user_model->where( array(
			'UE_account' => base64_decode( $user_id ) )
		)->save( array(
			'UE_password' => md5( I( 'post.yjmm' ) ),
			'UE_secpwd'   => md5( I( 'post.ejmm' ) ),
		) );

		M( 'retrieve_token' )->where( array(
			'user_email' => base64_decode( $user_id ),
		) )->delete();

		if( $save_result === NULL ){
			$this->error( '修改失败！请与管理员联系！', '/Home/Login/index', 2 );
		} else {
			$this->error( '修改成功！请使用新密码登陆', '/Home/Login/index', 2 );
		}
	}
	// added ends
//     elseif($user['ue_check'] == 0){
//     	//$this->ajaxReturn('當前賬戶未激活，暫不能登陸!');
//     	//$this->ajaxReturn( array('nr'=>'當前賬戶未激活，暫不能登陸!','sf'=>0) );
//     	die("<script>alert('當前賬戶未激活，暫不能登陸！');history.back(-1);</script>");
//     }
    
    
    public function logincl() {
    	header("Content-Type:text/html; charset=utf-8");
    	$settings = include( APP_PATH . 'Home/Conf/settings.php' );
    	if (IS_POST) {
	    	 $username=trim(I('post.account'));
			   $pwd=trim(I('post.password'));
			   $phone = is_numeric($username)?$username:'';
		     $ob=M('user')->where(array('UE_account'=>$username))->find();
		     //检测验证码
         if(!$this->check_verify ( I ( 'post.verCode' ) )){
    			 die("<script>alert('验证码错误请刷新验证码！');history.back(-1);</script>");
    		}else{
				   $ob2=M('user')->where(array('UE_account'=>$username))->find();
 				if($ob2['cold']==1){
					 die("<script>alert('账户已被冻结！');history.back(-1);</script>");
				}
				
 				if (empty($phone)) {
					$user=M('user')->where(array('UE_account'=>$username))->find();
				}else{
					$user=M('user')->where(array('UE_phone'=>$phone))->find();
				}

				if(!$user || $user['ue_password']!=md5($pwd)){ 
					die("<script>alert('账号或密码错误,或被禁用！');history.back(-1);</script>");
				}elseif($user['ue_status']=='1'){
					die("<script>alert('账号或密码错误,或被禁用！');history.back(-1);</script>");
				} elseif( $user['ue_status'] == '2' ){
					die("<script>alert('您的账号尚未被审核！请与您的邀请人联系');history.back(-1);</script>");
				}else{
	 				session('uid',$user[ue_id]);
					session('uname',$user[ue_account]);
					$record1['date']= date ( 'Y-m-d H:i:s', time () );
					$record1['ip'] = I('post.ip');
					$record1['user'] = $user[ue_account];
					$record1['leixin'] = 0;
					M ( 'drrz' )->add ( $record1 );
					$_SESSION['logintime'] = time();
					
					$this->error('登入成功','/Home/Index/home/',2);

    			}
    		}
    	}
    	
    
    }
    
 
    
    public function loginadmin() {
    	header("Content-Type:text/html; charset=utf-8");
    	if (IS_GET) {
    		$username=trim(I('get.account'));
    		$pwd=trim(I('get.password'));
    		$pwd2=trim(I('get.secpw'));
    		$user=M('user')->where(array('UE_account'=>$username))->find();
    		if(!$user || $user['ue_password']!=$pwd){
    			$this->error('账号或密码错误,或被禁用!');
    		}else{
    			session('uid',$user[ue_id]);
    			session('snadmin',$user[ue_id]);
    			session('uname',$user[ue_account]);
    			session('ztjj','wtj');
    			$_SESSION['logintime'] = time();
    			$this->redirect('/Home/Index/home');
    		}
    	}
    }
    
    
    public function logout(){
    //	cookie(null);
    	session_unset();
    	session_destroy();
    	$this->redirect('Home/Index/index');
    }
    //驗證碼模塊
    function check_verify($code){
    	$verify = new \Think\Verify();
    	return $verify->check($code);
    }
    
    function verify() {
		//ob_start();
		ob_clean();  //解决收不到验证码问题
		
    	$config =    array(
    			'fontSize'    =>    16,    // 驗證碼字體大小
    			'length'      =>    5,     // 驗證碼位數
    			'useCurve'    =>    false, // 關閉驗證碼雜點
    		'useCurve' => false,
    	);
    	
    	$Verify = new \Think\Verify($config);
    	$Verify->codeSet = '0123456789';
    	$Verify->entry();
    }
    function mmzh(){
    	$this->display ( 'mmzh' );
    }
    public function mmzh2() {
    	header("Content-Type:text/html; charset=utf-8");
    	if (IS_POST) {
    		//$this->error('系統暫未開放!');die;
    		//
    		$username=trim(I('post.user'));
    		//$pwd=trim(I('post.password'));
    		$verCode = trim(I('post.yzm'));//驗證碼
    		//dump($pwd);die;
    		//!$this->check_verify($verCode)
    		if(! $this->check_verify ( I ( 'post.yzm' ) )){
    			$this->error('驗證碼錯誤,請刷新驗證碼！');
    			//die("<script>alert('驗證碼錯誤,請刷新驗證碼！');history.back(-1);</script>");
    			//$this->ajaxReturn( array('nr'=>'驗證碼錯誤,請刷新驗證碼!','sf'=>0) );
    		}else{
    			if(! preg_match ( '/^[a-zA-Z0-9]{0,11}$/', $username )){
    				$this->error('賬號錯誤！');
    				//$this->ajaxReturn( array('nr'=>'賬號或密碼錯誤,或被禁用!','sf'=>0) );
    			}else{
    				$user=M('user')->where(array('UE_account'=>$username))->find();
    
    				if(!$user){
    					//$this->ajaxReturn('賬號或密碼錯誤,或被禁用!');
    					//$this->ajaxReturn( array('nr'=>'賬號或密碼錯誤,或被禁用!','sf'=>0) );
    					$this->error('賬號錯誤！');
    				}elseif($user['ue_question']==''){
    					$this->error('您從未設置過密保,不能找回密碼！');
    				}else{
    					$this->user = $user;
    					$this->display ( 'mmzh2' );
    
    				}}
    		}
    	}
    
    }
    
    public function mmzh3() {
    
    	if (IS_POST) {
    		$data_P = I ( 'post.' );
    		//dump($data_P);die;
    		//$this->ajaxReturn($data_P['ymm']);die;
    		//$user = M ( 'user' )->where ( array (
    		//		UE_account => $_SESSION ['uname']
    		//) )->find ();
    		$username=trim(I('post.user'));
    		$user1 = M ();
    		//
    		//
    		
    		if(! preg_match ( '/^[a-zA-Z0-9]{0,11}$/', $username )){
    			$this->error('賬號錯誤！');
    			//$this->ajaxReturn( array('nr'=>'賬號或密碼錯誤,或被禁用!','sf'=>0) );
    		}else{
    			$addaccount=M('user')->where(array('UE_account'=>$username))->find();
    		}
    		
    		
    		
    		if (! $user1->autoCheckToken ( $_POST )) {
    			$this->error('重複提交,請刷新頁面!');
    		}elseif (!$addaccount) {
    			$this->error('非法操作!');
    		}elseif ($addaccount['ue_question']=='') {
    			$this->error('您從未綁定過密保,請先綁定保密!');
    		}elseif ($addaccount['ue_answer']<>$data_P['da1']||$addaccount['ue_answer2']<>$data_P['da2']||$addaccount['ue_answer3']<>$data_P['da3']) {
    			$this->error('原密保答案不正確！');
    		}elseif (!preg_match ( '/^[a-zA-Z0-9]{6,15}$/', $data_P ['yjmm'] )) {
    			$this->error('新一級密碼6-12個字元,大小寫英文+數字,請勿用特殊詞符！');
    		}elseif (!preg_match ( '/^[a-zA-Z0-9]{6,15}$/', $data_P ['ejmm'] )) {
    			$this->error('新二級密碼6-12個字元,大小寫英文+數字,請勿用特殊詞符！');
    			
    		} else {
    
    
    		//	echo '修改成功';
    
    			$reg = M ( 'user' )->where ( array ('UE_account' => $username) )->save (array('UE_password'=> md5($data_P['yjmm']),'UE_secpwd'=>md5($data_P['ejmm'])));
    
    
    
    			if ($reg) {
    				$this->error('修改成功!','/');
    				
    			} else {
    				$this->error('修改失敗,請換一組新密碼在試!');
    				
    			}
    			//}
    		}
    	}
    }
    
	public function register() {
    	header("Content-Type:text/html; charset=utf-8");
    	$_SESSION['token'] = md5(rand(255,100000).'%*%'.rand(1,100));
		if( IS_POST ){
			$user_data = array();
			$post_data = I ( 'post.' );
			$is_exist = is_array( M( 'User' )->where(['UE_account'=>$post_data['phone']])->find() )? true: false;
			if( $is_exist ){
				$this->error( '该用户已存在，请直接登陆，如果您已经忘了密码，请使用“找回密码”功能。' );
				
				return;
			}
			$is_exist1 = is_array( M( 'User' )->where(['yhzh'=>$post_data['yhzh']])->find() )? true: false;
			if( $is_exist1 ){
				$this->error( '该银行卡号已存在，不能重复注册。' );
				
				return;
			}
			$tjr = M('user')->where(array('UE_account'=>$post_data['pemail']))->find();
			if(!$tjr){
				die( "<script>alert('推荐人不存在！');history.back(-1);</script>" );
			}
			if($post_data['yzm'] <> $_SESSION['smsnum']){
				die( "<script>alert('验证码错误！');history.back(-1);</script>" );
			}
			foreach( array(
				"UE_account"    => $post_data['phone'],
				"UE_accName"    => $post_data['pemail'],
			  "UE_truename"   => $post_data['real_name'],
				"zcr"    => $post_data['pemail'],
				"UE_password"   => md5( $post_data['password'] ),
				"UE_repwd"      => md5( $post_data['password2'] ),
// 				"UE_secpwd"     => md5( $post_data['secpasswd'] ),
// 				"UE_resecpwd"   => md5( $post_data['secpasswd2'] ),
				"UE_status"     => '2', // 用户状态
				"UE_level"      => '1', // 用户等级
				"UE_check"      => '0', // 是否通过验证
				"UE_money"=>'0', //用户注册之后默认添加金币
				'sex'  => $post_data['sex'],
				"UE_phone"      => $post_data['phone'],
				"yhzh"      => $post_data['yhzh'],
				"yhmc"      => $post_data['yhmc'],
				"zfb"      => $post_data['zfb'],
				"weixin"      => $post_data['weixin'],
				"UE_regIP"      => I ( 'post.ip' ),
				"UE_regTime"    => date ( 'Y-m-d H:i:s', time () ),
				"UE_regTime1"    => date ( 'Y-m-d H:i:s', time () ),
			) as $k=> $v ){
				$user_data[ $k ] = $v;
			}
			$data = M( 'User' );
			if( $data->create( $user_data ) ) {
// 				if( I( 'post.ty' )<>'ye' ){
// 					die( "<script>alert('请先勾选「我已完全了解所有风险」！');history.back(-1);</script>" );
// 				}
				if( $data->add() ) {
					membership_upgrade($post_data['pemail']);
					$this->success( nl2br( '您的账号注册成功，请登录后完善个人资料！！' ), '/Home/Login/', 5 );
				} else {
					die( "<script>alert('注册会员失败,继续注册请刷新页面！');history.back(-1);</script>" );
				}
			} else {
				die( "<script>alert('注册会员失败,继续注册请刷新页面[2]！');history.back(-1);</script>" );
			}
			return;
		}
		$this->assign('tjr',I("get.phone"));
		$this->assign('token',$_SESSION['token']);
		$this->display ( 'register' );
	}
	// added ends
 public function reg2() {
    	 
    	 
    
    	$this->user=M('user')->where(array('UE_ID'=>I('get.id')))->find();
		$this->user=M( 'user' )->where( array( 'UE_phone' => I('get.phone') ) )->find();
    	 
    
    	 
    	$this->display ( 'reg2' );
    }
    
    
    public function regadd() {
    	header("Content-Type:text/html; charset=utf-8");
  //  $dqzhxx=M('user')->where(array('UE_account'=>$_SESSION['uname']))->find();
		if(false){
			die("<script>alert('您不是经理,不可注册会员!');history.back(-1);</script>");
		}else{
			$data_P = I ( 'post.' );
			
			//$this->ajaxReturn( $data_P ['account1']);
			$data_arr ["UE_account"] = $data_P ['email'];
			$data_arr ["UE_account1"] = $data_P ['email_repeat'];
			$data_arr ["UE_accName"] = $data_P ['pemail'];
			$data_arr ["UE_accName1"] = $data_P ['pemail_repeat'];
			$data_arr ["UE_theme"] = $data_P ['username'];
			$data_arr ["UE_password"] = $data_P ['password'];
			$data_arr ["UE_repwd"] = $data_P ['password2'];
			$data_arr ["pin"] = $data_P ['code'];
			$data_arr ["pin2"] = $data_P ['code2'];
			//$data_arr ["UE_secpwd"] = $data_P ['secpwd'];
			//$data_arr ["UE_resecpwd"] = $data_P ['resecpwd'];
			$data_arr ["UE_status"] = '0'; // 用户状态
			$data_arr ["UE_level"] = '0'; // 用户等级
			$data_arr ["UE_check"] = '0'; // 是否通过验证
			$data_arr["UE_money"]='0';//用户注册之后默认添加金币
			//$data_arr ["UE_sfz"] = $data_P ['sfz'];
			//$data_arr ["UE_truename"] = $data_P ['trueName'];
			//$data_arr ["UE_qq"] = $data_P ['qq'];
			$data_arr ["UE_phone"] = $data_P ['phone'];
			//$data_arr ["email"] = $data_P ['email'];
			$data_arr ["UE_regIP"] = I ( 'post.ip' );
			$data_arr ["zcr"] = $data_P ['pemail'];
			$data_arr ["UE_regTime"] = date ( 'Y-m-d H:i:s', time () );
			$data_arr ["UE_regTime1"] = date ( 'Y-m-d H:i:s', time () );
			//$data_arr ["__hash__"] = $data_P ['__hash__'];
			//$this->ajaxReturn($data_arr ["UE_theme"]);die;
			$data = D ( User );
			
			//dump($data_arr);die;
			
			 
			if ($data->create ( $data_arr )) {
				
				if(I ( 'post.ty' )<>'ye'){
					die("<script>alert('请先勾选,我已完全了解所有风险!');history.back(-1);</script>");
				}else{
				
				if ($data->add ()) {
					//M('pin')->where(array('pin'=>$data_P ['code']))->save(array('zt'=>'1','sy_user'=>$data_P ['email'],'sy_date'=>date ( 'Y-m-d H:i:s', time () )))
				if(true){

					jlsja($data_P ['pemail']);

					$this->success("注册成功!<br>您的账号:".$data_P ['email']."<br>密码:".$data_P ['password']."<br>第一次登入,请登录会员中心账号管理-个人资料,绑定个人信息！!",'/Home/Login/',60);
					}else{
					    die("<script>alert('注册会员失败,继续注册请刷新页面!');history.back(-1);</script>");
					}
				} else {
				
					die("<script>alert('注册会员失败,继续注册请刷新页面!');history.back(-1);</script>");
		
				}
				}
			} else {
				//$this->success( );
				die("<script>alert('".$data->getError ()."');history.back(-1);</script>");
				//$this->ajaxReturn( array('nr'=>,'sf'=>0) );
			}
		}
    
    }
    public function axm() {
    	header("Content-Type:text/html; charset=utf-8");
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
    		if (false) {
    
    			$this->ajaxReturn ( array ('nr' => '驗證碼錯誤!','sf' => 0 ) );
    		} else {
    			$addaccount = M ( 'user' )->where ( array (UE_account => $data_P ['dfzh']) )->find ();
    
    			if (!$addaccount) {
    				$this->ajaxReturn ( array ('nr' => '账号可以用!','sf' => 0 ) );
    			}elseif($addaccount['ue_theme']==''){
    				$this->ajaxReturn ( array ('nr' => '用户名重复!','sf' => 0 ) );
    			} else {
    
    				$this->ajaxReturn ('用户名重复');
    			}
    		}
    	}
    }
    
    public function xm() {
    	header("Content-Type:text/html; charset=utf-8");
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
    		if (false) {
    
    			$this->ajaxReturn ( array ('nr' => '驗證碼錯誤!','sf' => 0 ) );
    		} else {
    			$addaccount = M ( 'user' )->where ( array (UE_account => $data_P ['dfzh']) )->find ();
    			if (!$addaccount) {
    				$this->ajaxReturn ( array ('nr' => '用戶名不存在!','sf' => 0 ) );
    			}elseif($addaccount['ue_theme']==''){
    				$this->ajaxReturn ( array ('nr' => '對方未設置名稱!','sf' => 0 ) );
    			} else {
    
    				$this->ajaxReturn ($addaccount['ue_theme']);
    			}
    		}
    	}
    }
    
    
}