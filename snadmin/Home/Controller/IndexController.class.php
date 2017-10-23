<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
  
    public function index(){
        
        $this->display('index/main');
    }
    
    public function admin_add(){
         
        $this->display('index/admin_add');
    }
    
    public function admin_right(){
        
       // var_dump(I('post.'));
      if(IS_POST){
            $data['MB_rights'] = json_encode(I('post.right'));

            $username=I('post.MB_username');

            $re=M('member')->where(array('MB_username'=>$username))->save($data);

            if($re){
                $this->success('权限赋予成功！');
            }
        }

        $this->display();

    }
	//解封
    public function cutcold()
    {
        $username = I('get.user',0);
        $res = M('user')->where(['UE_account'=>$username])->find();
        if($res['cold_type'] == 2){
            M('user')->where(['UE_account'=>$username])->setField('UE_regTime',date('Y-m-d H:i:s'));
        }elseif($res['cold_type'] == 3){
            $tgbz = M('tgbz')->where(['user'=>$username])->order('id desc')->find();
            M('tgbz')->where(['id'=>$tgbz['id']])->order('id desc')->setField('date',date('Y-m-d H:i:s'));
        }
        M('user')->where(['UE_account'=>$username])->save(['cold'=>0,'cold_type'=>0]);
        $this->success('解封成功');
    }
	function onekey_set(){
		if(IS_POST){
			$data = I("post.");
			
			$res = M('match')->find();
			
			if($data && !$res){
				$r = M('match')->add($data);
			}else{
				$r = M('match')->where(array('id'=>$res['id']))->save($data);
			}
			if($r){
				$this->success('操作成功');
			}else{
				$this->error('操作失败');
			}
		}
	}
	
	function onekey_match(){
		$res = M('match')->find();
		if(IS_POST){
			
			$num = auto_match(array(),true);
			$this->success("成功匹配{$num}单");
		}
		
		$this->assign('res',$res);
		$this->display('index/onekey_match');
	}
	
    function  bigz(){
        $list = M('turn_log')->select();
        foreach($list as $k=>$v){
            $aaaaa = date("Y-m-d H:i:s",$v['addtime']);
            $list[$k]['addtime'] =  $aaaaa;
        }
         $list1 = M('user')->select();
         $a = 1;
         $this->assign('z',$a);
        $this->assign('list1',$list1);
        $this->assign('list',$list);
        $this->display("index/bigz");
    }

    function user_detail(){
        $gid = I('ue_id');
        $model = M("user");
        $result = $model->where('UE_ID="'.$gid.'"')->find();
        
        if(IS_POST){
            
            $data = I();
            
            $id = $data['ue_id'];
            unset($data['ue_id']);
            //var_dump($data);
            $res = $model->where("UE_ID='".$id."'")->save($data);
                
            if($res){
                $result = M('user')->where('UE_ID="'.$gid.'"')->find();
                echo "<script>alert('操作成功');</script>";
            }else if($res == 0){
                echo "<script>alert('无任何修改');</script>";
            }else{
                echo "<script>alert('修改失败');</script>";
            }
        }
        
        $this->assign("result",$result);
        
        $this->display("user_detail");
    }
    
    function font_mess(){
        $result = M('font')->find();
        if(IS_POST){
            $data = I();
            if(!$result){
                $res = M('font')->add($data);
            }else{
                $res = M('font')->where("id='".$result['id']."'")->save($data);
            }
            if($res){
                $result = M('font')->find();
                echo "<script>alert('操作成功');</script>";
            }
        }
        
        $this->assign("result",$result);
        $this->display("mess");
    }
    
    
    
    
    
	
	
	function counts(){
		if(!empty($_GET)){
			$today = $_GET['dir'];
			$today = date('Y-m-d',$today);
			//dump($today);die;
		}else{
			$today = (date('Y-m-d', time()));
		}
		$mo = date('Y-m-d',strtotime("$today +1 day"));
		//dump($mo);
		$aa = M('user')->where(array("UNIX_TIMESTAMP('$today 00:00')<UNIX_TIMESTAMP(UE_regTime) and UNIX_TIMESTAMP(UE_regTime)<UNIX_TIMESTAMP('$mo 00:00')"))->count();
		$coun = M('user')->count();
		
		$tgbz_jb = M('tgbz')->SUM('jb');
		$jsbz_jb = M('jsbz')->SUM('jb');
		
		$jl = M('userget')->where(array('UG_dataType'=>'jlj'))->sum('UG_money');
		$tj = M('userget')->where(array('UG_dataType'=>'tjj'))->sum('UG_money');
		
		$away_in = M('ppdd')->where(array('zt'=>'2'))->sum('jb');
		
		$come_in = M('userget')->where(array('UG_dataType'=>'tgbz'))->sum('UG_money');
		/* dump($tgbz_jb);
		dump($jl) */;
		//$times = (date('Y-m-d H:i:s', time()));
		
		$ab = tgzb_jd_jb($i);
		$lx = tgzb_jd_jb1($i);
		$this->assign("today",$today);
		$this->assign("ab",$ab);
		$this->assign("lx",$lx);
		$this->assign("aa",$aa);
		$this->assign("coun",$coun);
		$this->assign("tgbz_jb",$tgbz_jb);
		$this->assign("jsbz_jb",$jsbz_jb);
		$this->assign("jl",$jl);
		$this->assign("tj",$tj);
		$this->assign("come_in",$come_in);
		$this->assign("away_in",$away_in);
		
		
		$this->display("counts");
	}
	
	

    function my_initialize(){
        if(IS_POST){
           $user = M("user")->where("UE_ID>1 and UE_account<>'V3财富'")->delete();
		   $user = M("pin")->where("user<>'V3财富'")->delete();
           $user = M("tgbz")->where("1=1")->delete();
           $user = M("jsbz")->where("1=1")->delete();
           $user = M("ppdd")->where("1=1")->delete();
           $user = M("user_jj")->where("1=1")->delete();
           $user = M("userget")->where("1=1")->delete();
           if($user){
                $this->success("操作成功！");
            }else{
                $this->success("操作失败！");
            }
        }
        
        $this->display("initialize");
    }

    public function df1(){
        
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $dayed = date("d")-1;
        $dayBegin = mktime(0,0,0,$month,$day,$year);//当天开始时间戳
        $dayEnd = mktime(23,59,59,$month,$day,$year);//当天结束时间戳
         
        $dayBegined = mktime(0,0,0,$month,$dayed,$year);//当天开始时间戳
        $dayEnded = mktime(23,59,59,$month,$dayed,$year);//当天结束时间戳
         
        $startTime = date('Y-m-d H:i:s',$dayBegin);
        $endTime=date('Y-m-d H:i:s',$dayEnd);
         
        $startTimed = date('Y-m-d H:i:s',$dayBegined);
        $endTimed=date('Y-m-d H:i:s',$dayEnded);
         //echo $endTimed;die;
        //今天註冊會員
        $zt=M('system')->where(array('SYS_ID'=>1))->find();
        //      $time2 = date('H');
        $this->zt=$zt;
        
        
        $ip=M ( 'drrz' )->where ( array ('user' => $_SESSION ['adminuser'],'leixin'=>1) )->order ( 'id DESC' )->limit ( 2 )->select();
        
        $this->bcip=$ip[0];
        $this->scip=$ip[1];
        $this->jtzchy = M('user')->where("`UE_regTime`> '".$startTime."' AND `UE_regTime` < '".$endTime."'")->count("UE_ID");
         
        //今天激活會員
        $this->jtjhhy = M('user')->where("`UE_activeTime`> '".$startTime."' AND `UE_activeTime` < '".$endTime."'")->count("UE_ID");
         
        //昨天註冊會員
        $this->ztzchy = M('user')->where("`UE_regTime`> '".$startTimed."' AND `UE_regTime` < '".$endTimed."'")->count("UE_ID");
        
        //昨天激活會員
        $this->ztjhhy = M('user')->where("`UE_activeTime`> '".$startTimed."' AND `UE_activeTime` < '".$endTimed."'")->count("UE_ID");
         

        //總會員
        $this->zuser = M('user')->where("`UE_ID`> '0'")->count("UE_ID");
        
        //總激活會員
        $this->zjhuser = M('user')->where("`UE_ID`> '0' AND `UE_check` = '1'")->count("UE_ID");
        
        //總出局會員
        $this->zcjuser = M('user')->where("`UE_ID`> '0' AND `UE_check` = '1' AND `UE_stop` = '0'")->count("UE_ID");
        
        //總金幣
        $this->zjb = M('user')->sum('UE_money');
        
        //總銀幣
        $this->zyb = M('user')->sum('ybhe');
        
        //總鑽石幣
        $this->zzsb = M('user')->sum('zsbhe');
        
        $this->display('index/index');
    }
    
    public function gb(){
         

        M('system')->where(array('SYS_ID'=>1))->save(array('zt'=>1));
        //      $time2 = date('H');
        $this->success('关闭成功!');
         

    }
    
    public function kq(){
    
    
        M('system')->where(array('SYS_ID'=>1))->save(array('zt'=>0));
        //      $time2 = date('H');
        $this->success('开启成功!');
    
    
    }
    
    public function top(){
        $this->display('index/top');
    }
    
    public function team(){
        //var_dump(I('get.user'));die;
        $this->user=I('get.user','0');
        $this->display('index/team');
    }
    
    public function left(){
        $this->display('index/left');
    }
    
    public function user_xg(){
        
        if(I('get.user')<>''){
            $this->userdata = M ( 'user' )->where ( array (
                    'UE_account' => I('get.user')
            ) )->find ();
            $this->display('index/user_xg');
        }else {
            $this->error('非法操作!');
        }
    }
    
    
    public function admin_xg(){
         
        if(I('get.user')<>''){
            $this->userdata = M ( 'member' )->where ( array (
                    'MB_username' => I('get.user')
            ) )->find ();
            $this->display('index/admin_xg');
        }else {
            $this->error('非法操作!');
        }
    }

    public function usercl(){
         
         $data['UE_check']=I('post.UE_check');
         $data['sfjl']=I('post.UE_stop');
         $data['UE_status']=I('post.UE_status');
         if(I('post.UE_password')<>''){$data['UE_password']=md5(I('post.UE_password'));}
         if(I('post.UE_secpwd')<>''){$data['UE_secpwd']=md5(I('post.UE_secpwd'));}
         $data['UE_truename']=I('post.UE_truename');
         $data['weixin']=I('post.weixin');
         $data['zfb']=I('post.zfb');
         $data['yhmc']=I('post.yhmc');
         $data['UE_phone']=I('post.UE_phone');
         $data['UE_money']=I('post.UE_money');
         $data['tj_he']=I('post.tj_he');
        $data['shop_money']=I('post.shop_money');
          $data['yhzh']=I('post.yhzh');
         $data['UE_theme']=I('post.UE_theme');
         $data['cold']=I('post.cold');
         $username=I('post.UE_account');
         $ob=M('user')->where(array('UE_account'=>$username))->find();
		 if($ob['cold']==1){
         if($ob['cold_type']==2){
		 //M('tgbz')->where(array('user'=>$username))->order('date1 desc')->save(array('date1'=>date('Y-m-d H:i:s',time())));
		 M('user')->where(array('UE_account'=>$username))->save(array('cold'=>0,'cold_type'=>0,'UE_regTime1'=>date('Y-m-d H:i:s',time())));
		 $a=1;
		 $b=1;
        }elseif($ob['cold_type']==1){
          M('user')->where(array('UE_account'=>$username))->save(array('cold'=>0,'cold_type'=>0));
//           $a=M('ppdd')->where(array('p_user'=>$username,'cold_status'=>1,))->save($data);
          $a=1;
		  $b=1;
        }elseif($ob['cold_type']==3){
         M('user')->where(array('UE_account'=>$username))->save(array('cold'=>0,'cold_type'=>0));
		 M('tgbz')->where(array('user'=>$username))->order('date desc')->save(array('date1'=>date('Y-m-d H:i:s',time())));
		  $a=1;$b=1;
        }elseif($ob['cold_type']==0){
			M('user')->where(array('UE_account'=>$username))->save(array('cold'=>0));
            $a=1;
            $b=1;
        }elseif($ob['cold_type']==4){
            M('user')->where(array('UE_account'=>$username))->save(array('cold'=>0,'cold_type'=>0,'UE_regTime1'=>date('Y-m-d H:i:s',time())));
			$a=1;
            $b=1;
        }
		}else{
			$a=1;
			$b=1;
		}
        // dump(I('post.UE_account'));die;
         if(M('user')->where(array('UE_account'=>I('post.UE_account')))->save($data) ||( $a && $b)){
            $this->success('修改成功!');
         }else{
            $this->success('修改成功!');
         }
    }
    
    public function admincl(){

    
        $data['MB_right']=I('post.MB_right');
        if(I('post.MB_userpwd')<>''){
            $data['MB_userpwd']=md5(I('post.MB_userpwd'));
            $data['MB_right'] = 1;
        }

        if(M('member')->where(array('MB_username'=>I('post.MB_username')))->save($data)){
            $this->success('修改成功!','/admdgjmin.php/Home/Index/adminlist');
        }else{
            $this->success('修改失败!');
        }
    }
    
    public function adminadd(){
    
         
        $data['MB_username']=I('post.MB_username');
        $data['MB_right']=I('post.MB_right');
        $data['MB_userpwd']=md5(I('post.MB_userpwd'));
        if(I('post.MB_username')<>''&&I('post.MB_right')<>''&&I('post.MB_userpwd')<>''){
        //dump($data);die;
        if(M('member')->add($data)){
            $this->success('添加成功!','/admdgjmin.php/Home/Index/adminlist');
        }else{
            $this->success('添加失败!');
        }
        }else{
            $this->success('数据不能为空!');
        }
    }
    
    public function userlist(){
        
        $User = M ( 'user' ); // 實例化User對象
        $data = I ( 'post.user' );
        
        
        //$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));
        
        if($data<>''){
            $map['UE_account']=$data;
        }
        if(I ( 'get.ip' )<>''){
            $map['UE_regIP']=I ( 'get.ip' );
        }
        $count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
        
        $p = getpage($count,20);
        
        $list = $User->where ( $map )->order ( 'UE_ID' )->limit ( $p->firstRow, $p->listRows )->select ();
        $this->assign ( 'list', $list ); // 賦值數據集
        $this->assign ( 'page', $p->show() ); // 賦值分頁輸出
        
        $this->display('index/userlist');
    }
    
    function cold(){
        $id = I("id");
        $cold = I("cold");
        if($id){
            $User = M ( 'user' );
            if($cold == '0'){
                $data['cold'] = 1;
            }else{
                $data['cold'] = 0;
                $data['thaw_start_time'] = null;
            }
            
            $re = $User->where("UE_ID='".$id."'")->save($data);
            //清除cold3 状态时间

        }
        if($re){
            $this->success('操作成功!');
        }else{
            $this->success('操作失败!');
        }
    }
    
    public function adminlist(){
         
        $User = M ( 'member' ); // 實例化User對象
        $data = I ( 'post.user' );
         
         
        //$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));
         
        if($data<>''){
            $map['MB_username']=$data;
        }
        
        $count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
         
        $p = getpage($count,20);
         
        $list = $User->where ( $map )->order ( 'MB_ID' )->limit ( $p->firstRow, $p->listRows )->select ();
        $this->assign ( 'list', $list ); // 賦值數據集
        $this->assign ( 'page', $p->show() ); // 賦值分頁輸出
         
        $this->display('index/adminlist');
    }
    
    
    
    public function userdel(){
         
        $User = M ( 'user' ); // 實例化User對象
        $data = I ( 'get.id' );
         
        $userxx = M('user')->where(array('UE_ID'=>$data,'UE_check'=>'0'))->find();
         
        if($data<>''&& $userxx['ue_account']<>''){
            M('user')->where(array('UE_ID'=>$data,'UE_check'=>'0'))->delete();

             M('user_jj')->where(array('user'=>$userxx['ue_account']))->delete();

             M('user_jl')->where(array('user'=>$userxx['ue_account']))->delete();

             M('userget')->where(array('UG_account'=>$userxx['ue_account']))->delete();

             M('tgbz')->where(array('user'=>$userxx['ue_account']))->delete();

             M('jsbz')->where(array('user'=>$userxx['ue_account']))->delete();

             M('ppdd')->where(array('p_user'=>$userxx['ue_account']))->delete();

             M('ppdd')->where(array('g_user'=>$userxx['ue_account']))->delete();


             M('pdb')->where(array('UE_account'=>$userxx['ue_account']))->delete();

             M('pin')->where(array('user'=>$userxx['ue_account']))->delete();
       
            $this->success('删除成功!');
        }else{
            $this->success('删除失败!');
        }
    }
    
    public function ppdd_list_del(){
    
        $User = M ( 'user' ); // 實例化User對象
        $data = I ( 'get.id' );
    
        $userxx = M('ppdd')->where(array('id'=>$data))->find();
    
        if($data<>''&& $userxx['id']<>''){
            M('ppdd')->where(array('id'=>$data))->delete();
            M('tgbz')->where(array('id'=>$userxx['p_id']))->delete();
            M('jsbz')->where(array('id'=>$userxx['g_id']))->delete();
            $this->success('删除成功!');
        }else{
            $this->success('订单不存在!');
        }
    }
    
    public function tgbz_list_del(){
    
        $User = M ( 'user' ); // 實例化User對象
        $data = I ( 'get.id' );
    
        $userxx = M('tgbz')->where(array('id'=>$data))->find();
    
        if($data<>''&& $userxx['id']<>''){
            
            M('tgbz')->where(array('id'=>$userxx['id']))->delete();
            
            $this->success('删除成功!');
        }else{
            $this->success('订单不存在!');
        }
    }
    
    public function jsbz_list_del(){
    
        $User = M ( 'user' ); // 實例化User對象
        $data = I ( 'get.id' );
    
        $userxx = M('jsbz')->where(array('id'=>$data))->find();
    
        if($data<>''&& $userxx['id']<>''){
    
            M('jsbz')->where(array('id'=>$userxx['id']))->delete();
    
            $this->success('删除成功!');
        }else{
            $this->success('订单不存在!');
        }
    }
    
    public function admindel(){
    
        $User = M ( 'member' ); // 實例化User對象
        $data = I ( 'get.id' );
        
        $userxx = M('member')->where(array('MB_ID'=>$data))->find();
    
        if($data<>''&& $userxx['mb_username']<>''){
            M('member')->where(array('MB_ID'=>$data))->delete();
            $this->success('删除成功!','/admdgjmin.php/Home/Index/adminlist');
        }else{
            $this->success('不能删除!');
        }
    }
    
    public function usermb(){
    
        $User = M ( 'user' ); // 實例化User對象
        $data = I ( 'get.id' );
    
        $userxx = M('user')->where(array('UE_ID'=>$data))->find();
    
        if($data<>''&& $userxx['ue_account']<>''){
            if(M('user')->where(array('UE_ID'=>$data))->save(array('UE_question'=>'','UE_question2'=>'','UE_question3'=>'','UE_answer'=>'','UE_answer2'=>'','UE_answer3'=>'')))
            {
                $this->success('成功!');
            }else{
                $this->success('失败!');
            }
        }else{
            $this->success('用户不存在!');
        }
    }
    
    
    public function userbtc(){
        
        $User = M ( 'user' ); // 實例化User對象
        $data = I ( 'get.cz' );
    
        if ($data=='n') {
            $map['btbdz']= '0';
        }elseif($data=='y'){
            $map['btbdz']= array('neq','0');
        }
        $count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
        
        $p = getpage($count,20);
        
        $list = $User->where ( $map )->order ( 'UE_ID' )->limit ( $p->firstRow, $p->listRows )->select ();
        $this->assign ( 'list', $list ); // 賦值數據集
        $this->assign ( 'page', $p->show() ); // 賦值分頁輸出
        
        $this->display('index/userbtc');
    }
    
    public function rggl(){
         
        $User = M ( 'userjyinfo' ); // 實例化User對象
        $data = I ( 'get.cz' );
    
        if ($data=='n') {
            $map['UJ_jbmcStage']= '0';
        }elseif($data=='y'){
            $map['UJ_jbmcStage']= '1';
        }
        $map['UJ_dataType']= 'rg';
        
        $count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
         
        $p = getpage($count,20);
         
        $list = $User->where ( $map )->order ( 'UJ_ID' )->limit ( $p->firstRow, $p->listRows )->select ();
        $this->assign ( 'list', $list ); // 賦值數據集
        $this->assign ( 'page', $p->show() ); // 賦值分頁輸出
         
        $this->display('index/rggl');
    }
    
    public function rggldel(){
    
        $data = I ( 'get.id' );
    
        if($data<>''){
            if(M('userjyinfo')->where(array('UJ_ID'=>$data))->delete() ){
            $this->success('删除成功');
            }else{
            $this->success('删除失败');
            }
        }
    }
    
    
    public function rgglsh(){
    
        $data = I ( 'get.id' );
    
        if($data<>''){
            
            $ddxx = M('userjyinfo')->where(array('UJ_ID'=>$data))->find();
            
            if($ddxx['uj_style']=='rgzsb'){
                
                M('user')->where(array('UE_account'=>$ddxx['uj_usercount']))->setInc('zsbhe',$ddxx['uj_jbcount']);
                $userxx=M('user')->where(array('UE_account'=>$ddxx['uj_usercount']))->find();
                $note3 = "原始鑽石幣購買";
                $record3 ["UG_account"] = $ddxx['uj_usercount']; // 登入轉出賬戶
                $record3 ["UG_type"] = 'zsb';
                $record3 ["zsb"] = $ddxx['uj_jbcount']; // 金幣
                $record3 ["zsb1"] = $ddxx['uj_jbcount']; //
                $record3 ["zsbhe"] = $userxx['zsbhe']; // 當前推薦人的金幣餘額
                $record3 ["UG_dataType"] = 'rg'; // 金幣轉出
                $record3 ["UG_note"] = $note3; // 推薦獎說明
                $record3["UG_getTime"]      = date ( 'Y-m-d H:i:s', time () ); //操作時間
                $reg4 = M ( 'userget' )->add ( $record3 );
                M('userjyinfo')->where(array('UJ_ID'=>$data))->save(array('UJ_jbmcStage'=>'1'));
                $this->success('处理成功');
                
            }elseif($ddxx['uj_style']=='rgyb'){
                
                
                M('user')->where(array('UE_account'=>$ddxx['uj_usercount']))->setInc('ybhe',$ddxx['uj_jbcount']);
                $userxx=M('user')->where(array('UE_account'=>$ddxx['uj_usercount']))->find();
                $note3 = "原始银幣購買";
                $record3 ["UG_account"] = $ddxx['uj_usercount']; // 登入轉出賬戶
                $record3 ["UG_type"] = 'yb';
                $record3 ["yb"] = $ddxx['uj_jbcount']; // 金幣
                $record3 ["yb1"] = $ddxx['uj_jbcount']; //
                $record3 ["ybhe"] = $userxx['ybhe']; // 當前推薦人的金幣餘額
                $record3 ["UG_dataType"] = 'rg'; // 金幣轉出
                $record3 ["UG_note"] = $note3; // 推薦獎說明
                $record3["UG_getTime"]      = date ( 'Y-m-d H:i:s', time () ); //操作時間
                $reg4 = M ( 'userget' )->add ( $record3 );
                M('userjyinfo')->where(array('UJ_ID'=>$data))->save(array('UJ_jbmcStage'=>'1'));
                $this->success('处理成功');
                
                
            }       
        }
    }
    public function pdbadd(){
        if(IS_POST){
            $user = I("post.user");
            $num = I("post.num");
        
            $model = M("pdb");
            $user1=M('user');
            
            $re = $user1->where(array('UE_account'=>$user))->setInc("ue_pdb",$num);
            $ob=$user1->where(array('UE_account'=>$user))->find();
            $time=date('Y-m-d H:i:s',time());
            $array=array('UE_id'=>$ob['ue_id'],
                          'UE_account'=>$user,
                          'give_time'=>$time,
                          'UE_pdb'=>$num,
                          'UE_theme'=>$ob['ue_theme'],);
            if($re){$ree=$model->data($array)->add();}            
            
            if($re && $ree){
                    $this->success('添加成功!');
                }else{
                    $this->success('添加失败!');
                }
        }
        
        //$this->display('pdb');
    }
    public function pdb(){
          $User = M ( 'pdb' );
        // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
          $count1 = $User->count (); 
          
        
        $p1= getpage($count1,15);
         
       
        $list1= $User->limit ( $p1->firstRow, $p1->listRows )->select ();
        //dump($list1);
         // 賦值數據集
        $this->assign ( 'list1', $list1);
        // 賦值分頁輸出
         $this->assign ( 'page1', $p1->show() ); // 賦值分頁輸出
         
         
        $this->display('pdb');
    }
    
    
    public function jbzs(){
         
        $User = M ( 'userget' ); // 實例化User對象
        
        $map['UG_dataType']= 'xtzs';
        
        $count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
         
        $p = getpage($count,20);
         
        $list = $User->where ( $map )->order ( 'UG_ID DESC' )->limit ( $p->firstRow, $p->listRows )->select ();
        $this->assign ( 'list', $list ); // 賦值數據集
        $this->assign ( 'page', $p->show() ); // 賦值分頁輸出
        $this->display('index/jbzs');
    }
      public function djye(){
         
        $User = M ( 'userget' ); // 實例化User對象
        
        $map['UG_dataType']= 'djye';
        
        $count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
         
        $p = getpage($count,20);
         
        $list = $User->where ( $map )->order ( 'UG_ID DESC' )->limit ( $p->firstRow, $p->listRows )->select ();
        $this->assign ( 'list', $list ); // 賦值數據集
        $this->assign ( 'page', $p->show() ); // 賦值分頁輸出
        $this->display('index/djye');
    }
    
    public function userbtccl(){
         
        $User = M ( 'user' ); // 實例化User對象
        //dump(I('post.UE_ID'));die;
        if(I('post.UE_ID')<>''&&I('post.btbdz')<>'0'){
            if($User->where(array('UE_ID'=>I('post.UE_ID')))->save(array('btbdz'=>I('post.btbdz')))){
                $this->success('修改成功!');
            }else{
                $this->success('修改失败!');
            }
        }else{
            $this->success('您没修改内容!');
        }
    }
    /*public function pdb(){
        if(IS_POST){
            $user = I("post.user");
            $num = I("post.num");
        
            $model = M("user");
            $re = $model->where(array('UE_account'=>$user))->setInc("ue_pdb",$num);
            
            if($re){
                    $this->success('添加成功!');
                }else{
                    $this->success('添加失败!');
                }
        }
        
        $this->display('pdb');
    }
    */
    
    
    public function jbzscl(){
    
        $User = M ( 'user' ); // 實例化User對象
        //dump(I('post.UE_ID'));die;
        if(I('post.lx')=='jb'){
            if(I('post.sl')<>''&& $User->where(array('UE_account'=>I('post.user')))->find()<>0 && preg_match ( '/^[0-9-]{1,20}$/', I('post.sl') )){
                $user_zq=M('user')->where(array('UE_account'=>I('post.user')))->find();
                if($User->where(array('UE_account'=>I('post.user')))-> setInc('UE_money',I('post.sl'))){
                
                
                $userxx=M('user')->where(array('UE_account'=>I('post.user')))->find();
                $note3 = "系统操作";
                $record3 ["UG_account"] = I('post.user'); // 登入轉出賬戶
                $record3 ["UG_type"] = 'jb';
                $record3 ["UG_money"] = I('post.sl'); // 金幣
                $record3 ["UG_allGet"] = $user_zq['ue_money']; //
                $record3 ["UG_balance"] = $userxx['ue_money']; // 當前推薦人的金幣餘額
                $record3 ["UG_dataType"] = 'xtzs'; // 金幣轉出
                $record3 ["UG_note"] = $note3; // 推薦獎說明
                $record3["UG_getTime"]      = date ( 'Y-m-d H:i:s', time () ); //操作時間
                $reg4 = M ( 'userget' )->add ( $record3 );
                
                
                $this->success('金币赠送成功!');
            }else{
                $this->success('金币赠送失败!');
            }
            }else{
                $this->success('用户 名不存在或填写有误!');
            }
        }elseif(I('post.lx')=='yb'){
            if(I('post.sl')<>''&& $User->where(array('UE_account'=>I('post.user')))->find()<>0 && preg_match ( '/^[0-9-]{1,20}$/', I('post.sl') )){
                if($User->where(array('UE_account'=>I('post.user')))-> setInc('ybhe',I('post.sl'))){
                    $userxx=M('user')->where(array('UE_account'=>I('post.user')))->find();
                    $note3 = "系统赠送";
                    $record3 ["UG_account"] = I('post.user'); // 登入轉出賬戶
                    $record3 ["UG_type"] = 'yb';
                    $record3 ["yb"] = I('post.sl'); // 金幣
                    $record3 ["yb1"] = I('post.sl'); //
                    $record3 ["ybhe"] = $userxx['ybhe']; // 當前推薦人的金幣餘額
                    $record3 ["UG_dataType"] = 'xtzs'; // 金幣轉出
                    $record3 ["UG_note"] = $note3; // 推薦獎說明
                    $record3["UG_getTime"]      = date ( 'Y-m-d H:i:s', time () ); //操作時間
                    $reg4 = M ( 'userget' )->add ( $record3 );
                    
                    
                    $this->success('银币赠送成功!');
                }else{
                    $this->success('银币赠送失败!');
                }
            }else{
                $this->success('用户 名不存在或填写有误!');
            }
        }elseif(I('post.lx')=='zsb'){
        if(I('post.sl')<>''&& $User->where(array('UE_account'=>I('post.user')))->find()<>0 && preg_match ( '/^[0-9-]{1,20}$/', I('post.sl') )){
            if($User->where(array('UE_account'=>I('post.user')))-> setInc('zsbhe',I('post.sl'))){
                $userxx=M('user')->where(array('UE_account'=>I('post.user')))->find();
                $note3 = "系统赠送";
                $record3 ["UG_account"] = I('post.user'); // 登入轉出賬戶
                $record3 ["UG_type"] = 'zsb';
                $record3 ["zsb"] = I('post.sl'); // 金幣
                $record3 ["zsb1"] = I('post.sl'); //
                $record3 ["zsbhe"] = $userxx['zsbhe']; // 當前推薦人的金幣餘額
                $record3 ["UG_dataType"] = 'xtzs'; // 金幣轉出
                $record3 ["UG_note"] = $note3; // 推薦獎說明
                $record3["UG_getTime"]      = date ( 'Y-m-d H:i:s', time () ); //操作時間
                $reg4 = M ( 'userget' )->add ( $record3 );
                
                
                $this->success('钻石币赠送成功!');
            }else{
                $this->success('钻石币赠送失败!');
            }
            }else{
                $this->success('用户 名不存在或填写有误!');
            }
        }
    
    }
    
     public function djyecl(){
    
        $User = M ( 'user' ); // 實例化User對象
        //dump(I('post.UE_ID'));die;
       
            if(I('post.sl')<>''&& $User->where(array('UE_account'=>I('post.user')))->find()<>0 && preg_match ( '/^[0-9-]{1,20}$/', I('post.sl') )){
        
                $note3 = "系统操作";
                $record3 ["UG_account"] = I('post.user'); // 登入轉出賬戶
                $record3 ["UG_type"] = 'jb';
                $record3 ["UG_money"] = I('post.sl'); // 金幣
                $record3 ["UG_dataType"] = 'djye'; // 金幣轉出
                $record3 ["UG_note"] = $note3; // 推薦獎說明
                $record3["UG_getTime"]      = date ( 'Y-m-d H:i:s', time () ); //操作時間
                $reg4 = M ( 'userget' )->add ( $record3 );
                
               if($reg4){ 
                $this->success('冻结余额成功!');
                }else{
                $this->success('冻结余额失败!');
                }
            }else{
                $this->success('用户 名不存在或填写有误!');
            }
    
    }
      public function djyexg(){
    
    $id = $_GET['id'];
    $user = $_POST['money'];
    $aa = M("userget")->where(array("UG_ID"=>$id))->data(array('UG_money'=>$user))->save();
    if($aa){
        $this->success('记录修改成功');
    }else{
        $this->error('记录修改失败');
    }

    }
    public function djyedel(){
    
    $id = $_GET['id'];
    $aa = M("userget")->where(array("UG_ID"=>$id))->delete();
    if($aa){
        $this->success('删除记录成功');
    }else{
        $this->error('删除记录失败');
    }

    }
    

    public function tj_zrjj_cl(){
        header("Content-Type:text/html; charset=utf-8");
    
        if(IS_POST){

            
            
            //时间
            $NowTime = date('Y-m-d H:i:s',time());
            
            $gxTime = $NowTime;//每日分紅的時間
            //echo $gxTime;
            
            $year = date("Y");
            $month = date("m");
            $day = date("d");
            
            $dayBegin = mktime(0,0,0,$month,$day,$year);//當天開始時間戳
            $dayEnd = mktime(23,59,59,$month,$day,$year);//當天結束時間戳
            
            $startTime = date('Y-m-d H:i:s',$dayBegin);
            $endTime=date('Y-m-d H:i:s',$dayEnd);
            
            $startTimed = date('Y-m-d H:i:s',$dayBegin);
            $endTimed=date('Y-m-d H:i:s',$dayEnd);
            

            
            //时间
            
            
            //昨天开始
            
            $year = date("Y");
            $month = date("m");
            $day = date("d");
            
            $dayBegin = mktime(0,0,0,$month,$day,$year)-86400;//當天開始時間戳
            $dayEnd = mktime(23,59,59,$month,$day,$year)-86400;//當天結束時間戳
            
            $startTime = date('Y-m-d H:i:s',$dayBegin);
            $endTime=date('Y-m-d H:i:s',$dayEnd);
            
            $startTimed = date('Y-m-d H:i:s',$dayBegin);
            $endTimed=date('Y-m-d H:i:s',$dayEnd);
            
            //echo $startTimed."<br>";
            //echo $endTimed."<br>";die;
            
            
            //昨天结束
            $otsystem=M('system')->where("SYS_ID ='1'")->find();
            
            $res=M('user')->where("UE_check ='1' and UE_activeTime > '".$startTimed."' and UE_activeTime < '".$endTimed."'")->select();
            
            //dump($otsystem);die; echo $val['ue_accname'];
            $tjj_tj = 0;
            $tjj1_tj = 0;
            $tjj2_tj = 0;
            $bdj_tj = 0;
            foreach($res as $val){
                if($val['ue_accname']<>''){
                    $tjr_1 =M('user')->where("UE_account='".$val['ue_accname']."'")->find();
                    $tjr_1_he=$tjr_1['ue_money']+$otsystem['a_kd_zsb']*2*$otsystem['a_ztj'];
                    M('user')->where("UE_account='".$tjr_1['ue_account']."'")->save(array('UE_money'=>$tjr_1_he));
                    
                    

                    $record3 ["UG_account"] = $tjr_1['ue_account']; 
                    $record3 ["UG_type"] = 'jb';
                    $record3 ["UG_money"] = $otsystem['a_kd_zsb']*2*$otsystem['a_ztj']; 
                    $record3 ["UG_allGet"] = $otsystem['a_kd_zsb']*2*$otsystem['a_ztj']; 
                    $record3 ["UG_balance"] = $tjr_1_he; 
                    $record3 ["UG_dataType"] = 'tjj1'; 
                    $record3 ["UG_note"] = '推荐奖'; 
                    $record3["UG_getTime"]      = date ( 'Y-m-d H:i:s', time () ); 
                    M ( 'userget' )->add ( $record3 );
                    
                    $tjj_tj = $tjj_tj+ 1;
                    
                    
                    if($tjr_1['ue_accname']<>''){
                        
                        $tjr_2 =M('user')->where("UE_account='".$tjr_1['ue_accname']."'")->find();
                        $tjr_2_he=$tjr_2['ybhe']+$otsystem['a_kd_zsb']*2*$otsystem['a_ztj2'];
                        M('user')->where("UE_account='".$tjr_2['ue_account']."'")->save(array('ybhe'=>$tjr_2_he));
                        
                        
                        
                        $record3 ["UG_account"] = $tjr_2['ue_account'];
                        $record3 ["UG_type"] = 'yb';
                        $record3 ["yb"] = $otsystem['a_kd_zsb']*2*$otsystem['a_ztj2'];
                        $record3 ["yb1"] = $otsystem['a_kd_zsb']*2*$otsystem['a_ztj2'];
                        $record3 ["ybhe"] = $tjr_2_he;
                        $record3 ["UG_dataType"] = 'tjj2';
                        $record3 ["UG_note"] = '间推奖';
                        $record3["UG_getTime"]      = date ( 'Y-m-d H:i:s', time () );
                        M ( 'userget' )->add ( $record3 );
                        
                        $tjj1_tj = $tjj1_tj+1;
                        
                        if($tjr_2['ue_accname']<>''){
                                
                            $tjr_3 =M('user')->where("UE_account='".$tjr_2['ue_accname']."'")->find();
                            $tjr_3_he=$tjr_3['ybhe']+$otsystem['a_kd_zsb']*2*$otsystem['a_ztj3'];
                            M('user')->where("UE_account='".$tjr_3['ue_account']."'")->save(array('ybhe'=>$tjr_3_he));
                                
                                
                                
                            $record3 ["UG_account"] = $tjr_3['ue_account'];
                            $record3 ["UG_type"] = 'yb';
                            $record3 ["yb"] = $otsystem['a_kd_zsb']*2*$otsystem['a_ztj3'];
                            $record3 ["yb1"] = $otsystem['a_kd_zsb']*2*$otsystem['a_ztj3'];
                            $record3 ["ybhe"] = $tjr_3_he;
                            $record3 ["UG_dataType"] = 'tjj3';
                            $record3 ["UG_note"] = '间间推奖';
                            $record3["UG_getTime"]      = date ( 'Y-m-d H:i:s', time () );
                            M ( 'userget' )->add ( $record3 );
                                
                            $tjj2_tj = $tjj2_tj+1;
                                
                        }
                        
                        
                    }
                    
                    
                    
                    dump($tjr_1_he);die;
                }
                
            }
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

//      set_time_limit(10);    
//  ob_end_clean();     //在循环输出前，要关闭输出缓冲区   

//  echo str_pad('',1024);   
//  //浏览器在接受输出一定长度内容之前不会显示缓冲输出，这个长度值 IE是256，火狐是1024   
//  for($i=1;$i<=100;$i++){    
//   echo $i.'<br/>';    
//   flush();    //刷新输出缓冲   
   
//  }    
            

        
        }
    
    }
    
    
    
    
    public function pin_add(){
    
    
        $this->display('index/pin_add');
    }
    
    
    public function pin_add_cl() {
    
        if (IS_POST) {
            $data_P = I ( 'post.' );
            //dump($data_P);die;

            $user = M ( 'user' )->where ( array(UE_account => $data_P['user']) )->find ();
            
            if (! $user) {
                $this->error('用户 不存在！');
            }elseif (! preg_match ( '/^[0-9.]{1,10}$/', $data_P ['sl'] )) {
                $this->error('请填生成数量！');
            } else {
             $cgsl=0;
            for ($i=0;$i<$data_P ['sl'];$i++){
                $pin=md5(sprintf("%0".strlen(9)."d", mt_rand(0,99999999999)));
                if(!M('pin')->where(array('pin'=>$pin))->find()){
                    $data['user']=$data_P['user'];
                    $data['pin']=$pin;
                    $data['zt']=0;
                    $data['sc_date']=date ( 'Y-m-d H:i:s', time () );
                    if(M('pin')->add($data)){
                        $cgsl++;
                    }
                }
            }
            $this->success('成功添加激活码'.$cgsl.'个');
            }
        }
    }
    
    
    public function pin_list(){
         
         
        $User = M ( 'pin' ); // 實例化User對象
        $data = I ( 'post.user' );
         
         
        //$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));
         if(I ( 'get.cz' )==0){
            $map['zt']=0;
         }
         if(I ( 'get.cz' )==1){
            $map['zt']=1;
         }
        if($data<>''){
            $map['user']=$data;
        }
        $count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
         
        $p = getpage($count,20);
         
        $list = $User->where ( $map )->order ( 'id DESC' )->limit ( $p->firstRow, $p->listRows )->select ();
        $this->assign ( 'list', $list ); // 賦值數據集
        $this->assign ( 'page', $p->show() ); // 賦值分頁輸出
         
         
         
        $this->display('index/pin_list');
    }
    public function pin_del(){
    
    
        $User = M ( 'user' ); // 實例化User對象
        $data = I ( 'get.id' );
    
    
        
            if(M('pin')->where(array('id'=>$data))->delete()){
                $this->success('删除成功!');
            }else{
                $this->success('删除失败!');
            }
            
         
    
    }
    
    
    
    
    
    /* NOTED BY SKYRIM: 提供帮助、列表 */
    public function tgbz_list(){
    
        
        
        $User = M ( 'tgbz' ); // 實例化User對象
        $data = I ( 'post.user' );
    
        $this->z_jgbz=$User->sum('jb');
        $this->z_jgbz2=$User->where(array('zt'=>'1'))->sum('jb');
        $this->z_jgbz3=$User->where(array('zt'=>array('neq',1)))->sum('jb');
        //$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));

            $map['zt']=0;

        if(I ( 'get.cz' )==1){
            $map['zt']=1;
        }
        if($data<>''){
            $map['user']=$data;
        }
        $count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
        
        $p = getpage($count,20);
    
        $list = $User->where ( $map )->order ( 'date ' )->limit ( $p->firstRow, $p->listRows )->select ();
        //dump($list);die;
        $this->assign ( 'list', $list ); // 賦值數據集
        $this->assign ( 'page', $p->show() ); // 賦值分頁輸出
    
    
    
        $this->display('index/tgbz_list');
        }
    
    
    /* NOTED BY SKYRIM: 接受帮助、列表 */
    public function jsbz_list(){
    
    
        
        $User = M ( 'jsbz' ); // 實例化User對象
        $data = I ( 'post.user' );
    
        $this->z_jgbz=$User->sum('jb');
        $this->z_jgbz2=$User->where(array('zt'=>'1'))->sum('jb');
        $this->z_jgbz3=$User->where(array('zt'=>array('neq','1')))->sum('jb');
        //$map ['UG_dataType'] = array('IN',array('mrfh','tjj','kdj','mrldj','glj'));

            $map['zt']=0;

        if(I ( 'get.cz' )==1){
            $map['zt']=1;
        }
        if($data<>''){
            $map['user']=$data;
        }
        $count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
    
        $p = getpage($count,20);
    
        $list = $User->where ( $map )->order ( 'date ' )->limit ( $p->firstRow, $p->listRows )->select ();
		
        //dump($list);die;
        $this->assign ( 'list', $list ); // 賦值數據集
        $this->assign ( 'page', $p->show() ); // 賦值分頁輸出
    
    
    
        $this->display('index/jsbz_list');
    }
    
    
    
    public function ppdd_list(){
    
    
         
        $User = M ( 'ppdd' ); // 實例化User對象
        $data = I ( 'post.user' );
    
        if($data<>''){
            $map['id']=$data;
        }else{
    
        $map['zt']=array('neq',2);
    
        if(I ( 'get.cz' )==1){
            $map['zt']=array('eq',2);;
        }
        }
        $count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
    
        $p = getpage($count,20);
    
        $list = $User->where ( $map )->order ( 'date ' )->limit ( $p->firstRow, $p->listRows )->select ();
       
        $this->assign ( 'list', $list ); // 賦值數據集
        $this->assign ( 'page', $p->show() ); // 賦值分頁輸出
    
    
    
        $this->display('index/ppdd_list');
    }
    
    
    
    
    public function ts1_list(){
    
    
    
        $User = M ( 'ppdd' ); // 實例化User對象
        $data = I ( 'post.user' );
    
        
        $map['zt']=array('neq',2);
        $map['ts_zt']=array('eq',1);
        
        
        $count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
    
        $p = getpage($count,20);
    
        $list = $User->where ( $map )->order ( 'id DESC' )->limit ( $p->firstRow, $p->listRows )->select ();
        //dump($list);die;
        $this->assign ( 'list', $list ); // 賦值數據集
        $this->assign ( 'page', $p->show() ); // 賦值分頁輸出
    
    
    
        $this->display('index/ts1_list');
    }
    
    
    
    
    
        
    public function ts3_list(){
    
    
    
        $User = M ( 'ppdd' ); // 實例化User對象
        $data = I ( 'post.user' );
    
         
        $map['zt']=array('neq',2);
        $map['ts_zt']=array('eq',2);;
         
         
        $count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
    
        $p = getpage($count,20);
    
        $list = $User->where ( $map )->order ( 'id DESC' )->limit ( $p->firstRow, $p->listRows )->select ();
        //dump($list);die;
        $this->assign ( 'list', $list ); // 賦值數據集
        $this->assign ( 'page', $p->show() ); // 賦值分頁輸出
    
    
    
        $this->display('index/ts3_list');
    }
    
    public function ts2_list(){
    
    
    
        $User = M ( 'ppdd' ); // 實例化User對象
        $data = I ( 'post.user' );
    
         
        $map['zt']=array('neq',2);
        $map['ts_zt']=array('eq',3);;
         
         
        $count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
    
        $p = getpage($count,20);
    
        $list = $User->where ( $map )->order ( 'id DESC' )->limit ( $p->firstRow, $p->listRows )->select ();
        //dump($list);die;
        $this->assign ( 'list', $list ); // 賦值數據集
        $this->assign ( 'page', $p->show() ); // 賦值分頁輸出
    
    
    
        $this->display('index/ts2_list');
    }
    
    
    
    
    
    
    public function ts1_list_cl(){
    
    $ppddxx=M('ppdd')->where(array('id'=>I('get.id')))->find();
    M('tgbz')->where(array('id'=>$ppddxx['p_id']))->save(array('zt'=>0,'qr_zt'=>0));
    M('jsbz')->where(array('id'=>$ppddxx['g_id']))->save(array('zt'=>0,'qr_zt'=>0));
    M('ppdd')->where(array('id'=>I('get.id')))->delete();
    $this->success('重新匹配成功');
    }
    
    
    public function ts3_list_cl(){
    
        $ppddxx=M('ppdd')->where(array('id'=>I('get.id')))->find();
        M('tgbz')->where(array('id'=>$ppddxx['p_id']))->save(array('zt'=>0,'qr_zt'=>0));
        M('jsbz')->where(array('id'=>$ppddxx['g_id']))->save(array('zt'=>0,'qr_zt'=>0));
        M('ppdd')->where(array('id'=>I('get.id')))->delete();
        M('user_jj')->where(array('r_id'=>$ppddxx['id']))->delete();
        M('user_jl')->where(array('r_id'=>$ppddxx['id']))->delete();
        $this->success('重新匹配成功');
    }
    
    
    
    
    public function ts2_list_cl(){
    
        $ppddxx=M('ppdd')->where(array('id'=>I('get.id')))->find();
        M('tgbz')->where(array('id'=>$ppddxx['p_id']))->save(array('zt'=>0,'qr_zt'=>0));
        M('jsbz')->where(array('id'=>$ppddxx['g_id']))->save(array('zt'=>0,'qr_zt'=>0));
        M('ppdd')->where(array('id'=>I('get.id')))->delete();
        $this->success('重新匹配成功');
    }
    
    
    
    
    
    
    
public function tgbz_list_sd(){
     
    $settings = include(APP_PATH . 'Home/Conf/settings.php');
     
    $pd = M('tgbz')->where(array('id' => I ('get.id'),'zt' => '0'))->find();

    $NowTime = $pd['date'];
    $aab=strtotime($NowTime);
    $NowTime=date('Y-m-d',$aab);
    $NowTime2=date('Y-m-d',time());
     
     
     
    $day1 = $NowTime;
    $day2 = $NowTime2;
    $diff = diffBetweenTwoDays($day1, $day2);
        if(I ( 'get.id' )<>''){
            if(!stristr($_SERVER['HTTP_REFERER'],ACTION_NAME))//初始化选中值
            {
                $_SESSION['check_p']['check_id']=",";
                $_SESSION['check_p']['check_money']=0;
            }
            $tgbzuser=M('tgbz')->where(array('id'=>I ( 'get.id' )))->find();
            $this->tgbzuser=$tgbzuser;
            if($tgbzuser['zffs1']=='1'){$zffs1='1';}else{$zffs1='5';}
            if($tgbzuser['zffs2']=='1'){$zffs2='1';}else{$zffs2='5';}
            if($tgbzuser['zffs3']=='1'){$zffs3='1';}else{$zffs3='5';}
            $User = M ( 'jsbz' ); // 實例化User對象
            $data = I ( 'post.user' );
                
                
           /*  $where['zffs1']  = $zffs1;
            $where['zffs2']  = $zffs2;
            $where['zffs3']  = $zffs3;
            $where['_logic'] = 'or';
            $map['_complex'] = $where; */
            $map['zt']=0;

            $count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數
            //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)

            $p = getpage($count,20);

            $list = $User->where ( $map )->order ( 'date ' )->limit ( $p->firstRow, $p->listRows )->select ();
            $this->assign ( 'list', $list ); // 賦值數據集
            $this->assign ( 'page', $p->show() ); // 賦值分頁輸出
                
            //已选择的数据
            if(!empty($_SESSION['check_p']['check_money']))
            {
                $this->assign ('check_array', explode(",",$_SESSION['check_p']['check_id']));
            }
            $this->assign ( 'check_id', $_SESSION['check_p']['check_id']);
            $this->assign ( 'check_money', $_SESSION['check_p']['check_money']);
                
            //var_dump(session());die;
            $this->display('index/tgbz_list_sd');
        }
   /*  }else{
        die("<script>alert('不足48小时，无法匹配');history.back(-1);;</script>");
    } */
}
    //记录选中的_SESSION
    public function tgbz_list_sd_cookie()
    {
        $_SESSION['check_p']['check_id']=I('get.id');
        $_SESSION['check_p']['check_money']=I('get.money');
    }
    
public function jsbz_list_sd(){
     
    $settings = include(APP_PATH . 'Home/Conf/settings.php');

    $pd = M('jsbz')->where(array('id' => I ('get.id'),'zt' => '0'))->find();
     
    $NowTime = $pd['date'];
    $aab=strtotime($NowTime);
    $NowTime=date('Y-m-d',$aab);
    $NowTime2=date('Y-m-d',time());


    $day1 = $NowTime;
    $day2 = $NowTime2;
    $diff = diffBetweenTwoDays($day1, $day2);
     
    /* if ($diff >= $settings['tgbz_time']) { */
         
         
        if(I ( 'get.id' )<>''){
            if(!stristr($_SERVER['HTTP_REFERER'],ACTION_NAME))//初始化选中值
            {
                $_SESSION['check_p']['check_id']=",";
                $_SESSION['check_p']['check_money']=0;
            }
            $tgbzuser=M('jsbz')->where(array('id'=>I ( 'get.id' )))->find();
            $this->tgbzuser=$tgbzuser;
            if($tgbzuser['zffs1']=='1'){$zffs1='1';}else{$zffs1='5';}
            if($tgbzuser['zffs2']=='1'){$zffs2='1';}else{$zffs2='5';}
            if($tgbzuser['zffs3']=='1'){$zffs3='1';}else{$zffs3='5';}
            $User = M ( 'tgbz' ); // 實例化User對象
            $data = I ( 'post.user' );
             
             
            $where['zffs1']  = $zffs1;
            $where['zffs2']  = $zffs2;
            $where['zffs3']  = $zffs3;
            $where['_logic'] = 'or';
            $map['_complex'] = $where;
            $map['zt']=0;

            $count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數
            //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)

            $p = getpage($count,20);

            $list = $User->where ( $map )->order ( 'date ' )->limit ( $p->firstRow, $p->listRows )->select ();
            //dump($list);die;
            $this->assign ( 'list', $list ); // 賦值數據集
            $this->assign ( 'page', $p->show() ); // 賦值分頁輸出
            //已选择的数据
            if(!empty($_SESSION['check_p']['check_money']))
            {
                $this->assign ('check_array', explode(",",$_SESSION['check_p']['check_id']));
            }

            $this->assign ( 'check_id', $_SESSION['check_p']['check_id']);
            $this->assign ( 'check_money', $_SESSION['check_p']['check_money']);

            //var_dump(session());die;
            $this->display('index/jsbz_list_sd');
        }
   /*  }else{
        die("<script>alert('不足48小时，无法匹配');history.back(-1);;</script>");
    } */
}
    
    
    

 
 public function tgbz_list_sd_cl(){
        $data=I('post.');
        $arr = explode(',',I('post.arrid'));
        $p_user=M('tgbz')->where(array('id'=>$data['pid']))->find();
        global $p_id2;
        $p_id2=$data['pid'];
        if($data['arrzs']<>$data['jb']){
            $this->success('匹配金额不等!');
        }else{
            $pipeits = 0;
            foreach($arr as $val){
                $g_user=M('jsbz')->where(array('id'=>$val))->find();
                if($g_user['user']==$p_user['user']){
                    $sfxd = '1';break;
                }else{
                    $gg_user[] = $g_user['user'];
                    $gg_userjb[] = $g_user['jb'];
                    $sfxd = '0';
                }
            }
            if($sfxd == '0'){
                foreach($arr as $val){
                    if($val<>''){
                        //$p_id2充值ID ,$val提现ID
                        if(ppdd_add($p_id2,$val,$p_user['qy'])){
                            $pipeits++;
                            M('tgbz')->where(array('id'=>$data['pid']))->setInc('cf_ds',1);
                        }
                    }
                }
            }else{
                $usercf='用户名重复';
            }
            if($pipeits<>'0'){
                $p_user1=M('tgbz')->where(array('id'=>$data['pid']))->find();
                //提供帮助id 对应的所有匹配订单信息
                $tj_ppdd=M('ppdd')->where(array('p_id'=>$p_user1['id']))->select();
                M('tgbz')->where(array('id'=>$data['pid']))->delete();
                foreach($tj_ppdd as $value){
                
                    $data2['zffs1']=$p_user1['zffs1'];
                    $data2['zffs2']=$p_user1['zffs2'];
                    $data2['zffs3']=$p_user1['zffs3'];
                    $data2['user']=$p_user1['user'];
                    $data2['jb']=$value['jb'];
                    $data2['yid']=$p_user['yid'] ? $p_user['yid'] : $p_user1['jb'];
                    $data2['yjb']=$p_user1['yjb'];
            				$data2['date1']=$p_user1['date1'];
            				$data2['date2']=$p_user1['date2'];
                    $data2['user_nc']=$p_user1['user_nc'];
                    $data2['user_tjr']=$p_user1['user_tjr'];
                    $data2['date']=$p_user1['date'];
                    $data2['zt']=$p_user1['zt'];
                    $data2['qr_zt']=$p_user1['qr_zt'];
                    $data2['qy'] = $p_user1['qy'];
                    //根据拆分的订单，录入tgbz信息
                    $ppddxx1 = $value['chaifen'];
                    if($ppddxx1 == 1){
                        $data2['chaifen']=1;
                    }elseif($ppddxx2 == 2){
                        $data2['chaifen']=2;
                    }else{
                        $data2['chaifen']=0;
                    }
                    //根据拆分的订单，录入tgbz信息
                    $varid = M('tgbz')->add($data2);

                    
                    M('ppdd')->where(array('id'=>$value['id']))->save(array('p_id'=>$varid));
                
                }
                
                
                M('user_jj')->where(array('tgbz_id'=>$data['pid']))->save(array('zt'=>3));
            
            
            }
            
            
            $_SESSION['check_p']['check_id']=",";
            $_SESSION['check_p']['check_money']=0;
            
            $this->success('匹配成功!拆分成'.$pipeits.'条订单,'.$usercf.'!');
        }
        

    }
    
    
    /* NOTED BY SKYRIM: 接受帮助、手动处理*/
    public function jsbz_list_sd_cl(){
        
        $data=I('post.');
        $arr = explode(',',I('post.arrid'));//充值IP
        $p_user=M('jsbz')->where(array('id'=>$data['pid']))->find();//提现订单
        global $p_id2;
        $p_id2=$data['pid'];//提现ID
        if($data['arrzs']<>$data['jb']){
            $this->success('匹配金额不等!');
        }else{
            $pipeits = 0;
    
    
            foreach($arr as $val){
                $g_user=M('tgbz')->where(array('id'=>$val))->find();
                if($g_user['user']==$p_user['user']){
                    $sfxd = '1';break;
                }else{
                    $gg_user[] = $g_user['user'];
                    $jb_user[] = $g_user['jb'];
                    $sfxd = '0';
                }
                
            }
            if($sfxd == '0'){
    
                foreach($arr as $val){
                    
                    if($val<>''){
                         //$val充值人  ,$p_id2提现人
                        if(ppdd_add2($val,$p_id2)){
                            $pipeits++;
                            //M('jsbz')->where(array('id'=>$data['pid']))->setInc('cf_ds',1);
                        }
                    }
                }
            }else{
                $usercf='用户名重复';
            }
            
            
            
            //拆分充值
            if($pipeits<>'0'){
            
            $p_user1=M('jsbz')->where(array('id'=>$data['pid']))->find();
            $tj_ppdd=M('ppdd')->where(array('g_id'=>$p_user1['id']))->select();
            
            foreach($tj_ppdd as $value){
            
                $data2['zffs1']=$p_user1['zffs1'];
                $data2['zffs2']=$p_user1['zffs2'];
                $data2['zffs3']=$p_user1['zffs3'];
                $data2['user']=$p_user1['user'];
                $data2['jb']=$value['jb'];
				$data2['date1']=$p_user1['date1'];
                $data2['user_nc']=$p_user1['user_nc'];
                $data2['user_tjr']=$p_user1['user_tjr'];
                $data2['date']=$p_user1['date'];
                $data2['zt']=$p_user1['zt'];
                $data2['qr_zt']=$p_user1['qr_zt'];
                    //根据拆分的订单，录入tgbz信息
                    $ppddxx1 = $value['chaifen'];
                    if($ppddxx1 == 1){
                        $data2['chaifen']=1;
                    }elseif($ppddxx2 == 2){
                        $data2['chaifen']=2;
                    }else{
                        $data2['chaifen']=0;
                    }
                    //根据拆分的订单，录入tgbz信息
                $varid = M('jsbz')->add($data2);
            
                M('ppdd')->where(array('id'=>$value['id']))->save(array('g_id'=>$varid));
                
            }
            
            M('jsbz')->where(array('id'=>$data['pid']))->delete();    
            }
            
            //拆分充值
            $_SESSION['check_p']['check_id']=",";
            $_SESSION['check_p']['check_money']=0;
            
            
            $this->success('匹配成功!拆分成'.$pipeits.'条订单,'.$usercf.'!');
        }

    }
    
    
    
    public function zdpp_cl(){
        

        $tgbz_user = M('tgbz')->where (array('zt'=>'0'))->select();
        $pipeits = 0;
        foreach($tgbz_user as $val){
            
        //dump();die;
        $jsbz_list=tgbz_zd_cl($val['id']);
        foreach($jsbz_list as $key1=>$val1){
            //echo $val['jb'].'--<br>';
            //echo $val1['jb'].'<br>';
            
            if($val['jb']==$val1['jb']&&$val['user']<>$val1['user']){//如果匹配成功处理
                if(ppdd_add($val['id'],$val1['id'],$tgbz_user['qy'])){
                    $pipeits++;
					
                    M('tgbz')->where(array('id'=>$val['id']))->save(array('cf_ds'=>'1'));
                        $jsbzid = M('ppdd')->where(array('p_id'=>$val['id']))->getField('g_id'); 
                    M('jsbz')->where(array('id'=>$jsbzid))->save(array('qr_zt'=>'1'));
                    M('tgbz')->where(array('id'=>$val['id']))->save(array('qr_zt'=>'1'));
					unset($jsbz_list[$key1]);
                    break;
                }
            }
            
        }

        }
        echo('成功匹配订单'.$pipeits.'条');
        
        
    }
    
    public function zdpp_cl2(){
         
    
        $tgbz_user = M('tgbz')->where (array('zt'=>'0'))->select();
        $pipeits = 0;
        foreach($tgbz_user as $val){
    
            //dump();die;
            $jsbz_list=tgbz_zd_cl($val['id']);
            $i='0';
            foreach($jsbz_list as $val1){
                if($val['user']<>$val1['user']){
                $jsbz_list2[$i]=$val1['id'];
                $i++;
                }
            }
            //echo $val['jb'];die;
            //dump($jsbz_list2);die;
            
            $xypipeije=$val['jb'];
            $data=$jsbz_list2;
            $tj=count($data);
            //echo $tj;die;
            $sf_tcpp='0';
            for ($b=0;$b<$tj;$b++){
                if($sf_tcpp=='1'){break;}
                $tj_j=$tj-1;
                //echo '===========<br>';
                for ($i=0;$i<$tj;$i++){
                    if($b<$i){
                        $pipeihe=jsbz_jb($data[$b])+jsbz_jb($data[$tj_j]);
                        if($pipeihe==$xypipeije){
                            $g_a =$data[$b];
                            $g_b =$data[$tj_j];
                            $sf_tcpp='1';break;
                        }
            
                            
                            
                        $tj_j--;
                    }
                }
            }
            //echo $val['id'].'主<br>';
            //echo $g_a.'<br>';
            //echo $g_b.'<br>';
            if($g_a<>''&&$g_b<>''){
                
            if(ppdd_add($val['id'],$g_a)&&ppdd_add($val['id'],$g_b)){
                $pipeits++;
                M('tgbz')->where(array('id'=>$val['id']))->save(array('cf_ds'=>'1'));
                echo '主ID:'.$val['id'].'金币:'.$val['jb'].'=副A:'.$g_a.'金币:'.jsbz_jb($g_a).'+副B:'.$g_b.'金币:'.jsbz_jb($g_b).'<br>';
            }
            }
            
              //拆分充值
        if($sf_tcpp=='1'){
            $p_user1=M('tgbz')->where(array('id'=>$val['id']))->find();
            $tj_ppdd=M('ppdd')->where(array('p_id'=>$p_user1['id']))->select();
            
            foreach($tj_ppdd as $value){
            
                $data2['zffs1']=$p_user1['zffs1'];
                $data2['zffs2']=$p_user1['zffs2'];
                $data2['zffs3']=$p_user1['zffs3'];
                $data2['user']=$p_user1['user'];
                $data2['jb']=$value['jb'];
                $data2['user_nc']=$p_user1['user_nc'];
                $data2['user_tjr']=$p_user1['user_tjr'];
                $data2['date']=$p_user1['date'];
                $data2['zt']=$p_user1['zt'];
                $data2['qr_zt']=$p_user1['qr_zt'];
                $varid = M('tgbz')->add($data2);
            
                M('ppdd')->where(array('id'=>$value['id']))->save(array('p_id'=>$varid));
            
            }
            
            M('tgbz')->where(array('id'=>$val['id']))->delete();
            
            }
              //拆分充值
    
        }
        echo('成功匹配订单'.$pipeits.'条');
         
         
    }
    public function tgbz_list_cf(){
    
    
        $User = M ( 'tgbz' ); // 實例化User對象
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
        $count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
    
        $p = getpage($count,20);
    
        $list = $User->where ( $map )->order ( 'id' )->limit ( $p->firstRow, $p->listRows )->select ();
        //dump($list);die;
        $this->assign ( 'list', $list ); // 賦值數據集
        $this->assign ( 'page', $p->show() ); // 賦值分頁輸出
    
    
    
        $this->display('index/tgbz_list_cf');
    }
    
    public function jsbz_list_cf(){
    
    
    
        $User = M ( 'jsbz' ); // 實例化User對象
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
        $count = $User->where ( $map )->count (); // 查詢滿足要求的總記錄數
        //$page = new \Think\Page ( $count, 3 ); // 實例化分頁類 傳入總記錄數和每頁顯示的記錄數(25)
    
        $p = getpage($count,20);
    
        $list = $User->where ( $map )->order ( 'id' )->limit ( $p->firstRow, $p->listRows )->select ();
        //dump($list);die;
        $this->assign ( 'list', $list ); // 賦值數據集
        $this->assign ( 'page', $p->show() ); // 賦值分頁輸出
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
        $settings = include( dirname( APP_PATH ) . '/User/Home/Conf/settings.php' );
        $p_user1=M('tgbz')->where(array('id'=>$data['pid']))->find();
        $pipeits=0;
        foreach($arr as $value){
            if($value<>''){
                $data2['zffs1']=$p_user1['zffs1'];
                $data2['zffs2']=$p_user1['zffs2'];
                $data2['zffs3']=$p_user1['zffs3'];
                $data2['user']=$p_user1['user'];
                $data2['jb']=$value;
                $data2['yid']=$p_user1['id'];
                $data2['yjb']=$p_user1['yjb'];
			         	$data2['date1']=$p_user1['date1'];
			         	$data2['date2']=$p_user1['date2'];
                $data2['user_nc']=$p_user1['user_nc'];
                $data2['user_tjr']=$p_user1['user_tjr'];
                $data2['date']=$p_user1['date'];
			         	$data2['date1']=$p_user1['date1'];
			     	    $data2['date2']=$p_user1['date2'];
                $data2['zt']=$p_user1['zt'];
                $data2['qr_zt']=$p_user1['qr_zt'];
                $data2['qy'] = $p_user1['qy'];
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
         
        $p_user1=M('jsbz')->where(array('id'=>$data['pid']))->find();
         
        $pipeits=0;
        foreach($arr as $value){
            if($value<>''){
                $data2['zffs1']=$p_user1['zffs1'];
                $data2['zffs2']=$p_user1['zffs2'];
                $data2['zffs3']=$p_user1['zffs3'];
                $data2['user']=$p_user1['user'];
                $data2['jb']=$value;
				        $data2['date1']=$p_user1['date1'];
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
     
    // added by skrim
    // purpose: custom settings
    // version: 4.0
   public function settings( $templ = '' ){
        $settings = include( dirname( APP_PATH ) . '/User/Home/Conf/settings.php' );
        
        if( IS_POST ){
            foreach( $_POST['jl_share'] as $k=>$v ){
                $_POST['jl_share'][$k] = floatval( $v / 100.0);
            }
            foreach( $_POST['masses_share'] as $k=>$v ){
                $_POST['masses_share'][$k] = floatval( $v /100);
            }
            foreach( $_POST['shangcheng'] as $k=>$v ){
                $_POST['shangcheng'][$k] = floatval( $v /100);
            }
            // added ends
            
            foreach( $settings as $k=>$v ){
                if( isset( $_POST[$k] ) ){
                    $settings[$k] = $_POST[$k];
                }
            }
            
            $file_length = file_put_contents( dirname( APP_PATH ) . '/User/Home/Conf/settings.php', '<?php return ' . var_export( $settings, true ) . '; ?>' );
            
            if( $file_length ){
                $this->success('保存成功！');
            } else {
                $this->error('保存失败！请检查文件权限');
            }
            return;
        }

        foreach( $settings as $k=>$v ){
            if( $k == 'jl_share' || $k == 'masses_share' || $k == 'shangcheng' ){
                foreach( $v as $kk=>$vv ){
                    $v[$kk] = floatval( $vv ) * 100;
                }
            }
            $this->assign( $k, $v );
        }
        $this->assign( 'settings', $settings );

        $this->display( $templ );
    }
    public function pre_deposit(){
        $this->settings( 'pre_deposit' );
    }

}