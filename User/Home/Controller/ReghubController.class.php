<?php

namespace Home\Controller;

use Think\Controller;

class ReghubController extends CommonController {
	public function censor() {
		$map1['user']=$_SESSION['uname'];
		$count1 = M('pin')->where ( $map1 )->count (); // 查詢滿足要求的總記錄數
		$p1 = getpage($count1,10);
		$list1 = M('pin')->where ( $map1 )->order ( 'id DESC' )->limit ( $p1->firstRow, $p1->listRows )->select ();
		$this->assign ( 'list1', $list1 ); // 賦值數據集
		$this->assign ( 'page1', $p1->show() ); // 賦值分頁輸出

		$users = M( 'user' )
			->join( 'LEFT JOIN ' . C('DB_PREFIX') . 'pin ON ' . C('DB_PREFIX') . 'pin.sy_user=' . C('DB_PREFIX') . 'user.UE_account' )
			->order( C('DB_PREFIX') . 'user.UE_status desc' )
			->where( array( C('DB_PREFIX') . 'user.zcr' => $_SESSION ['uname'] ) )
			->select();
		$userData = M( 'user' )->where( array( 'UE_ID' => $_SESSION ['uid']) )->find ();
		$this->userData = $userData;
		$this->assign( 'users', $users );
		$this->display();

	}
	public	function  censor_ddx(){
	   $list=M('pin')->where(array('user'=>session('uname'),'zt'=>0))->count();
	   $this->assign('list',$list);
	   $this->display();
   }	
	
	public function confirm_censor() {
		$id = I('get.id');
		//$pin = I('get.pin');
		$pin=M('pin')->where(array('user'=>session('uname'),'zt'=>0))->getField('pin');
		$user_info = M( 'user' )->where( array( 'UE_ID' => $id ) )->find ();
		$pin_info = M( 'pin' )->where( array( 'pin' => $pin ) )->find ();
		$time=date( 'Y-m-d H:i:s' );
		if( !$user_info || !$pin_info ){
			$this->error( '非法操作！' );
		} else {
			M( 'user' )->where( array( 'UE_ID' => $id ) )->save( array(
				'UE_status' => 0,
				'UE_regTime'=>$time,
			));
			$user_data = M( 'user' )->where( array( 'UE_ID' => $_SESSION ['uid'] ) )->find ();
			$settings = include( APP_PATH . 'Home/Conf/settings.php' );

			$xiaxianmen = M( 'user' )->where( array( 'zcr' => $_SESSION ['uname'] ) )->select();
			if( count( $xiaxianmen ) >= $settings['up_to_jl_threshold'] && $user_data['sfjl'] == 0 ){
				M( 'user' )->where( array( 'UE_ID' => $_SESSION ['uid'] ) )->save( [
					'sfjl' => 1,
				] );
			}
			
			//added ends
			$result = M( 'pin' )->where( array( 'pin' => $pin ) )->save( [
				'zt' => 1,
				'sy_user' => $user_info['ue_account'],
				'sy_date' => date( 'Y-m-d H:i:s' ),
			] );
			

			
			if( $result ){
				$this->error( '修改成功！', U('Home/Reghub/censor') );
			} else {
				$this->error( '修改失败！' );
			}
		}
	}
	public function pdb_list(){
	    // 转账记录
	    $map2['UG_account'] = $_SESSION['uname'];
	    $map2['UG_othraccount'] = $_SESSION['uname'];
	    $map2['_logic'] = 'or';
	    $where['_complex'] = $map2;
	    $where['UG_dataType'] = array('in', array('pdbzc','pdbzr'));
	     
	    $count2 = M('userget')->where($where)->count();
	    $p2 = getpage($count2, 10);
	    $list2 = M('userget')->where($where)->order('UG_getTime desc')->limit($p2->firstRow, $p2->listRows)->select();
	    $this->assign ( 'list', $list2 );
	    $this->assign ( 'page', $p2->show() );
	    $this->display('pdb_list');
	}
	
	
	public function pdb_zr(){
        if (IS_POST) {
            $data_P = I('post.');
            $user_df = M('user')->where(array(UE_account => $data_P['user']))->find();
            $userxx = M('user')->where(array('UE_account' => $_SESSION['uname']))->find();
            if ($userxx['ue_secpwd']<>md5($data_P['ejmm'])){
                die("<script>alert('二级密码输入有误！');history.back(-1);</script>");
            } else {


                $jbhe = $data_P ['sh'];
                if (!preg_match('/^[0-9]{1,10}$/', $data_P ['sh']) || !$data_P ['sh'] > 0) {
                    die("<script>alert('数量输入有勿！');history.back(-1);</script>");
                } elseif ($userxx['ue_pdb'] < $jbhe) {
                    die("<script>alert('激活币不足！');history.back(-1);</script>");
                } elseif (!$user_df) {
                    die("<script>alert('对方账号不存在！');history.back(-1);</script>");
                }else {
                   $model = M('user');
        					 $model->startTrans();
        					 $r1 = $model->where(array('UE_account' => $_SESSION['uname']))->setDec("ue_pdb",$jbhe);
        					
        					 $r2 = $model->where(array(UE_account => $data_P['user']))->setInc("ue_pdb",$jbhe);
        					 //记录
        					 $note3 = "排单币转出";
        					 $record3 ["UG_account"] = $_SESSION['uname']; // 登入转出账户
        					 $record3 ["UG_type"] = 'pd';
        					 $record3 ["UG_allGet"] = $userxx['ue_pdb']; // 金币
        					 $record3 ["UG_money"] = '-'.$jbhe; //
        					 $record3 ["UG_balance"] = $userxx['ue_pdb']-$jbhe; // 当前推荐人的金币馀额
        					 $record3 ["UG_dataType"] = 'pdbzc'; // 金币转出
        					 $record3 ["UG_note"] = $note3; // 推荐奖说明
        					 $record3["UG_getTime"]		= date ( 'Y-m-d H:i:s', time () ); //操作时间
        					 $record3['UG_othraccount'] = $data_P['user'];
        					 $reg4 = M ( 'userget' )->add ( $record3 );
        					 
        					 $note3 = "排单币转入";
        					 $record3 ["UG_account"] = $data_P['user']; // 登入转出账户
        					 $record3 ["UG_type"] = 'pd';
        					 $record3 ["UG_allGet"] = $user_df['ue_pdb']; // 金币
        					 $record3 ["UG_money"] = '+'.$jbhe; //
        					 $record3 ["UG_balance"] = $user_df['ue_pdb']+$jbhe; // 当前推荐人的金币馀额
        					 $record3 ["UG_dataType"] = 'pdbzr'; // 金币转出
        					 $record3 ["UG_note"] = $note3; // 推荐奖说明
        					 $record3["UG_getTime"]		= date ( 'Y-m-d H:i:s', time () ); //操作时间
        					 $record3['UG_othraccount'] = $_SESSION['uname'];
        					 $reg4 = M ( 'userget' )->add ( $record3 );
                   if($r1 && $r2){                
        						  $model->commit();
        						   $this->success('转让成功!');
        					}else{
        						$model->rollback();
        						$this->error('操作失败!');
        					}


                    
                }
            }
        }
    }
	
	// 用户激活
	public function activation(){
		$id = I('get.id');
		$user = M('user')->where(array('UE_accName' => $_SESSION ['uname'],'zcr'=> $_SESSION ['uname'],'UE_ID'=> $id))->find();
		if(!$user){
			 die("<script>alert('您激活的用户不存在，请重新核对信息');history.back(-1);</script>");
		}
		if($user['ue_status'] == 0){
			 die("<script>alert('该用户已激活');history.back(-1);</script>");
		}
		$pin = M('pin')->where(array('user'=>$_SESSION ['uname'],'zt'=>0))->find();
		if(!$pin){
			die("<script>alert('激活码不足');history.back(-1);</script>");
		}
		M('user')->where(array('UE_accName' => $_SESSION ['uname'],'zcr'=> $_SESSION ['uname'],'UE_ID'=> $id))->setField('UE_status',0);
        M('pin')->where(['id'=>$pin['id']])->save(['zt'=>1,'sy_user'=>$user['ue_account'],'sy_date'=>date('Y-m-d H:i:s')]);
		$this->success('激活成功！',U('Reghub/censor'));

	}
	
	public function get_pin() {
		if( !IS_AJAX ){
			echo json_encode( [ 'id' => -2 ] );
			
			return;
		} 
		
		$pin = M( 'pin' )->where( array(
			'zt' => 0,
			'user' => $_SESSION['uname']
		) )->find();
		
		if( !$pin ){
			echo json_encode( [ 'id' => -1 ] );
		} else {
			echo json_encode( $pin );
		}
	}
	
	public function disable_user() {
		$id = I('get.id');
		
		$this->set_user_status( $id, 1 );
	}
	public function enable_user() {
		$id = I('get.id');
		
		$this->set_user_status( $id, 0 );
	}
	
	public function set_user_status( $id, $status ) {
		//$_SESSION ['uname']
		$user_data = M( 'user' )->where( array(
			'UE_accName' => $_SESSION ['uname'],
			'zcr'        => $_SESSION ['uname'],
			'id'         => $id,
		) )->find ();
		
		if( !$user_data ){
			$this->error( '非法操作！请重新登录后再试' );
			
			return;
		}
		
		$model = M( 'user' );
		$save_result = $user_data = $model->where( array(
			'UE_accName' => $_SESSION ['uname'],
			'zcr'        => $_SESSION ['uname'],
			'UE_ID'      => $id,
		) )->save( [
			'UE_status'  => $status,
		] );
		
		//var_dump( $model->getLastSql() );die;
		
		if( $save_result ){
			$this->error( '修改成功' );
			
			return;
		} else {
			$this->error( '修改失败！请重新登录后再试' );
			
			return;
		}
	}
}