<?php

namespace Shop\Controller;

use Think\Controller;

class IndexController extends CommonController
{
    // 首页
    public function index(){
        $model = M('shop_project');
        $count = $model->where('zt>0')->count();

        $page = new \Think\Page($count,6);
        $show = $page->show();

       
		$shop_hot = M("shop_project")->where(array('zt'=>'2'))->order("addtime desc")->page(I('get.p'),6)->select();

		$title = M("shop_leibie")->select();
		$this->assign('title',$title);
		$this->assign('shop_hot',$shop_hot);
        $this->assign('show',$show);
        //$this->assign('list',$array);

        $this->display();
    }

	public function listProject(){
		$model = M('shop_project');
		$data = I('get.');
		//dump($data);die;
		$map = array();
		if($data['pid']){
			$map['pid'] = $data['pid'];
		}else{
			$map['pid'] = '1';
		}
		$map['zt'] = array('in','1,2');
		/*if($data['name']){
			$map['name'] = array("like","%{$data['name']}%");
		}*/
		$count = $model->where($map)->count();

		$page = new \Think\Page($count,12);
		foreach($map as $key=>$val) { 
			$page->parameter   .=   "$key=".urlencode($val).'&';
		}
		$show = $page->show();

		$array = $model->where($map)->order("price")->page(I('get.p'),12)->select();
		
		
		$title = M("shop_leibie")->limit(10)->select();
		$this->assign('title',$title);
		//$list = $model->where($map)->select();
		$this->assign('show',$show);
		$this->assign('list',$array);
		//var_export($show);die;
		$this->display('listProject');

	}
	public function project(){
		$id = I('get.id');
		$arr = M('shop_project')->where(array('id'=>$id))->find();
		
		$title = M("shop_leibie")->select();
		$this->assign('title',$title);
		
		$this->assign('arr',$arr);
		$this->display('project');				
	}
	//购物车商品确认
	public function confirm(){
		$id=I('post.');
		$arr=explode("|",$id['ids']);		
		$num=count($arr);
		$sumprice=0;
		for($i=0;$i<$num;$i++){
			$cart=M('shop_cart')->where(array('id'=>$arr[$i]))->find();			
			$sumprice +=$cart['price']*$cart['count'];
		}
		$tgid['id'] = array('in', $arr);
		$list=M('shop_cart')->where($tgid)->select();
		$this->assign('list',$list);		
		$this->assign('sumprice',$sumprice);
		$this->display('confirm');
	}
	
	public function doconfirm(){
		$address=I('get.address');
		$sum=I('get.sum');
		$UE_money = M('user')->where(array('UE_account'=>session('uname')))->getField('UE_integral');
		if($sum>$UE_money){
			die("<script>alert('商城积分不足！');history.back()</script>");
		}
		$list=M('shop_cart')->select();
		if(empty($list)){
			die("<script>alert('暂无商品！！');history.back()</script>");
		}
		foreach($list as $k=>$v){
			$cart=M('shop_cart')->where(array('id'=>$v['id']))->find();
			$map = array();
			$map['user'] = session('uname');
			$map['project'] = $cart['project'];
			$map['count'] = $cart['count'];
			$map['sumprice'] = $cart['price']*$cart['count'];
			$map['addtime'] = date('Y-m-d H:i:s');
			$map['address'] = $address;
			if(M('shop_orderform')->add($map)){
				//删除订单
				M('shop_cart')->where(array('id'=>$v['id']))->delete();
				//减钱
				M('user')->where(['UE_account'=>session('uname')])->setDec('UE_integral',$map['sumprice']);
				
			}
			
		}
		die("<script>alert('商品提交成功');history.go(-2)</script>");
		
	}
	
	public function shoppingList(){
		$list=M('shop_orderform')->where(array('user'=>session('uname')))->select();
		$this->assign('list',$list);
		$this->display();
	}
	
	public function confirmProject(){
		$id = I('get.id');
		$count = I('get.count');
		if($count<1){
			die("<script>alert('请选择正确数量');history.back()</script>");
		}

		$arr = M('shop_project')->where(array('id'=>$id))->find();
		$array = M('shop_project')->where(array('pid'=>$arr['pid']))->select();
		$list = M('shop_project')->where(array('pid'=>$arr['pid'],'zt'=>'2'))->order('id desc')->limit('2')->select();
		
		$sumPrice = $arr['price']*$count;
        
		$UE_money = M('user')->where(array('UE_account'=>session('uname')))->getField('UE_integral');
		if($sumPrice>$UE_money){
			die("<script>alert('商城积分不足！');history.back()</script>");
		}
		$this->assign('list',$list);
		$this->assign('array',$array);

		$map['sumPrice'] = $sumPrice;
		$map['name'] = $arr['name'];
		$map['user'] = session('uname');
		$map['count'] = $count;
		$map['time'] = date('Y-m-d H:i:s'); 
		$this->assign('sumPrice',$sumPrice);
		$this->assign('arr',$arr); 
		$this->assign('map',$map); 
		$this->display();
	}
	public function confirmProject1(){
		$id = I('get.id');
		$count = I('get.count');
		if($count<1){
			die("<script>alert('请选择正确数量');history.back()</script>");
		}
		$arr = M('shop_project')->where(array('id'=>$id))->find();
		$array = M('shop_project')->where(array('pid'=>$arr['pid']))->select();
		$list = M('shop_project')->where(array('pid'=>$arr['pid'],'zt'=>'2'))->order('id desc')->limit('2')->select();
		

		$sumPrice = $arr['old_price']*$count;
		$this->assign('user',$user);
		$this->assign('array',$array);
		$map['sumPrice'] = $sumPrice;
		$map['name'] = $arr['name'];
		$map['user'] = session('uname');
		$map['count'] = $count;
		$map['time'] = date('Y-m-d H:i:s');
		$user = M('user')->where(array("UE_account" => session('uname')))->find();

		
		$this->assign('sumPrice',$sumPrice);
		$this->assign('arr',$arr); 
		$this->assign('map',$map); 
		$this->assign('user',$user);
		$img = M('member')->where(array('MB_right'=>1))->order('MB_ID')->find();
		$this->assign('img',$img);
		$this->display();
	}
	
	public function addcart(){
		$id = I('post.id');
		$arr = M('shop_cart')->where(array('tid'=>$id))->find();
		
		if($arr){
			//$this->ajaxReturn(2);
			$data['status']=2;
			$this->ajaxReturn($data);die;
		}
		$order= M('shop_project')->where(array('id'=>$id))->find();
		$orderform = M('shop_cart');
		$map = array();
		$map['user'] = session('uname');
		$map['project'] = $order['name'];
		$map['count'] = 1;
		$map['price'] = $order['price'];
		$map['addtime'] = date('Y-m-d H:i:s');
		$map['address'] = 'aa';
		$map['zt'] = '0';
		$map['tid'] = $id;
		if($orderform->add($map)){
			$data['status']=1;
		}else{
			//$this->ajaxReturn(0);
			$data['status']=0;
		}
		$this->ajaxReturn($data);
		
	}
	//删除商品订单
	public function delete_Cart(){
		$id = I('post.id');
		$arr = M('shop_cart')->where(array('id'=>$id))->find();
		if(empty($arr)){			
			$data['status']=0;
			$this->ajaxReturn($data);die;
		}
		$t=M('shop_cart')->where(array('id'=>$id))->delete();
		if($t){
			$data['status']=1;
			$this->ajaxReturn($data);die;
		}else{
			$data['status']=0;
			$this->ajaxReturn($data);die;
		}
		
	}
	//删除产品订单
	public function delete_shop(){
		$id = I('post.id');
		$arr = M('shop_orderform')->where(array('id'=>$id))->find();
		if(empty($arr)){
			$data['status']=0;
			$this->ajaxReturn($data);die;
		}
		$t=M('shop_orderform')->where(array('id'=>$id))->delete();
		if($t){
			$data['status']=1;
			$this->ajaxReturn($data);die;
		}else{
			$data['status']=0;
			$this->ajaxReturn($data);die;
		}
	
	}
	//收货产品订单
	public function doshop(){
		$id = I('post.id');
		$arr = M('shop_orderform')->where(array('id'=>$id,'zt'=>1))->find();
		if(empty($arr)){
			$data['status']=0;
			$this->ajaxReturn($data);die;
		}
		$d['zt']=2;
		$t=M('shop_orderform')->where(array('id'=>$id))->save($d);
		if($t){
			$data['status']=1;
			$this->ajaxReturn($data);die;
		}else{
			$data['status']=0;
			$this->ajaxReturn($data);die;
		}
	
	}
	//计算总价格
	public function changeAmount_Cart(){
		$data = I('post.');		
		//购物车ID号
		$id=$data['id'];
		//数量
		$num=$data['amount'];
		$shopcart=M('shop_cart')->where(array('id'=>$id))->find();
		if(empty($shopcart)){
			$data['code']=0;
			$this->ajaxReturn($data);die;
		}
		$d['count']=$num;
		$cart=M('shop_cart')->where(array('id'=>$id))->save($d);
		if(empty($cart)){
			$data['code']=0;
			$this->ajaxReturn($data);die;
		}
		$data['success']=1;
		$this->ajaxReturn($data);die;
	}
	
	
	
	public function addOrderform(){
		$settings = include( APP_PATH . 'Home/Conf/settings.php' );
		$UE_money = M('user')->where(array('UE_account'=>session('uname')))->getField('UE_integral');
		
		$id = I('get.id');
		$count = I('get.count');
		$count2 = I('get.address');
		$count = $count+0;
		if(!is_int($count)){
			die("<script>alert('请输入整数');history.back()</script>");
		}
		if(empty($count2)){
			die("<script>alert('请填写地址');history.back()</script>");
		}
		if(!$id || !$count){
			die("<script>alert('请选择商品');history.back()</script>");
		}else{

			$user=M('user')->where(array('UE_account'=>session('uname')))->find();
			$arr = M('shop_project')->where(array('id'=>$id))->find();
			if(($arr['stock']*1) < $count){
				die("<script>alert('商品库存不足');history.back()</script>");
			}
			$orderform = M('shop_orderform');
			$map = array();
			$map['user'] = session('uname');
			$map['project'] = $arr['name'];
			$map['count'] = $count;
			$map['tel'] = $user['ue_phone'];
			$map['type'] = 1;
			$map['price'] = $arr['price']*1;
			$map['sumprice'] = $arr['price']*$count; 
			$map['addtime'] = date('Y-m-d H:i:s');
			$map['address'] = $count2;
			$UE_money = M('user')->where(array('UE_account'=>session('uname')))->getField('UE_integral');
			
		if($map['sumprice']>$UE_money){
			die("<script>alert('商城积分不足！');history.back()</script>");
		}	
			if($orderform->add($map)){
				//扣除商城金币
				M('user')->where(['UE_account'=>session('uname')])->setDec('UE_integral',$map['sumprice']);
				M('shop_project')->where(['name'=>$map['project'],'price'=>$map['price']])->setDec('stock',$map['count']);
				die("<script>alert('商品提交成功');history.go(-2)</script>");
			}else{
				$this->success('请重新提交订单','project');
			}
		}

	}
	//现金购买
	public function addOrderform1(){
		$settings = include( APP_PATH . 'Home/Conf/settings.php' );
		$data_P = I('post.');
		if(!is_int($data_P['num']*1)){
			die("<script>alert('请输入整数');history.back()</script>");
		}
		if(empty($data_P['address'])){
			die("<script>alert('请填写地址');history.back()</script>");
		}else{

			$uploads = new \Think\Upload();// 实例化上传类    
			$uploads->maxSize   =     3145728000 ;// 设置附件上传大小    
			$uploads->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
			$uploads->savePath  =      '/Pic/'; // 设置附件上传目录    
			// 上传文件     
			$info   =   $uploads->uploadOne($_FILES['img']);
			
			if(!$info) {// 上传错误提示错误信息
				die("<script>alert('请上传打款截图');history.back()</script>");    
				$this->error($upload->getError());
			}
			$img['img'] = '/Uploads'.$info['savepath'].$info['savename'];
			$user=M('user')->where(array('UE_account'=>session('uname')))->find();
			$arr = M('shop_project')->where(array('id'=>$data_P['id']))->find();
			if(($arr['stock']*1) < ($data_P['num']*1)){
				die("<script>alert('商品库存不足');history.back()</script>");
			}
			$orderform = M('shop_orderform');
			$map = array();
			$map['user'] = session('uname');
			$map['project'] = $data_P['title'];
			$map['img'] = $img['img'];
			$map['price'] = $data_P['price'];
			$map['tel'] = $data_P['phone']*1;
			$map['type'] = 2;
			$map['count'] = $data_P['num']*1;
			$map['sumprice'] = $data_P['sumPrice']*1; 
			$map['addtime'] = date('Y-m-d H:i:s');
			$map['address'] = $data_P['address'];
			if($orderform->add($map)){
				//扣除商城金币
				// M('user')->where(['UE_account'=>session('uname')])->setDec('UE_integral',$map['sumprice']);
				M('shop_project')->where(array('id'=>$data_P['id']))->setDec('stock',$map['count']);
				die("<script>alert('商品提交成功');history.go(-2)</script>");
			}else{
				$this->success('请重新提交订单','project');
			}
		}

	}
	public function shoppingCart(){
		$list = M('shop_cart')->where(array('user'=>session('uname')))->select();
		$this->assign('list',$list);
		$this->display();
	}
	
	
	public function historyOrderform(){
        $title = M("shop_leibie")->select();
        $this->assign('title',$title);
		$list = M('shop_orderform')->where(array('user'=>session('uname')))->select();
		$this->assign('list',$list);
		//dump($list);die;
		$this->display();
	}
	public function saveOrderform(){
		$id = I('post.id');
		$re = M('shop_orderform')->where(array('user'=>session('uname'),'id'=>$id))->save(['zt'=>'2']);
		if($re){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(0);
		}
	}
	public function delOrderform(){
		$id = I('post.id');
		$re = M('shop_orderform')->where(array('user'=>session('uname'),'id'=>$id))->delete();
		if($re){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(0);
		}
	}

}