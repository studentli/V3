<?php 
	namespace Home\Controller;
	use Think\Controller;
	class UploadController extends Controller{
		
		public function uploadFace() {
		
			$upload = $this->_upload('Pic');
			$this->ajaxReturn($upload);
		}
		
		Private function _upload ($path) {
			
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
				return array('status' => 0, 'msg' => $obj->getError());
			} else {
				foreach($info as $file){
					$pic = $file['savepath'].$file['savename'];
				}
				//$pic =  $info[0][savename];
				//echo $pic;die;
				return array(
						'status' => 1,
						'path' => $pic
				);
			}
		}
	}
	