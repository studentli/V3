<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link href="/css/mui.min.css" rel="stylesheet" />
		<link href="/css/style.css" rel="stylesheet" />
		 
		<title>V3财富</title>
		<style>
			.top_list{display:none;background:#4096ee;min-height:200px;width:150px;z-index:99;border-radius:0;position:fixed;top:45px;right:1px} 
			.menu_active{display:block;}
			.mui-table-view-cell{text-align: center;color:#fff;}
			.content_con{width:90%;padding-top:50px;height:auto;overflow: hidden;margin:0 auto;margin-bottom: 70px;}
			.form_list{width:100%;height:auto;overflow: hidden;}
			.form_list label{width:100%;font-size: 14px;line-height: 34px;color:#8f8f94;font-weight:400;}
			.form_list input{width:100%;border:1px solid  #e4e5e7;display: block;
			    width: 100%;
			    height: 34px;
			    padding: 6px 12px;
			    font-size: 14px;
			    line-height: 1.42857143;
			    color: #555;
			    background-color: #fff;
			    background-image: none;
			    border: 1px solid #ccc;
			    border-radius: 4px;margin-bottom: 10px;}
		</style>
	</head>
	<body style="background: #fff;">
		<header class="mui-bar mui-bar-nav" style="background: #4096ee;">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color:#fff;"></a>
			<h1 class="mui-title" style="color:#fff;">更改密码</h1>
			<a id="menu" class="mui-action-menu mui-icon mui-icon-bars mui-pull-right menu" style="color:#fff;font-weight: bold;"></a>
		</header>
		
		<!--右上角弹出菜单-->
		<div id="topPopover" class="top_list" >
			 
			 
					<ul class="mui-table-view" style="background: none;">
						<li class="mui-table-view-cell">
							<a href="<?php echo U('/Home/Index/jsbzjl');?>">接受帮助匹配记录</a>
						</li>
					
						<li class="mui-table-view-cell">
							<a href="<?php echo U('/Home/Index/sqbzjl');?>">申请帮助匹配记录</a>
						</li>
						<li class="mui-table-view-cell">
							<a href="<?php echo U('/Home/Index/sell_record');?>">接受帮助等待记录</a>
						</li>
						<li class="mui-table-view-cell">
							<a href="<?php echo U('/Home/Index/buy_record');?>">申请帮助等待记录</a>
						</li>
						<li class="mui-table-view-cell">
							<a href="javascript:alert('暂时未开放！')">游戏互动</a>
						</li>
					
					</ul>
				 

		</div> 
 	     
 	    <div class="content_con">
 	    	 <form action="<?php echo U('Home/Info/xgyjmmcl');?>" name="xgmm" id="xgmm" method="post" class="form_list">
                            <div class="row">
                             <div class="form-group col-md-12">
                                <label>原一级密码</label>
                                <input type="password" value="" id="ymm" class="form-control" name="ymm" required>
                            </div>
                             <div class="form-group col-md-12">
                                <label>新一级密码</label>
                                <input type="password" value="" id="xmm" class="form-control" name="xmm" required>
                            </div>
                             <div class="form-group col-md-12">
                                <label>确认新一级密码</label>
                                <input type="password" value="" id="xmmqr" class="form-control" name="xmmqr" required>
                            </div>
                            </div>
                            
                            <div class="text-center">
                               
                                <input name="" type="submit" class="btn btn-success" value="确认修改" id="btn" style="width:150px;margin:0 auto;background:#4096ee;color:#fff;">
                               
                            </div>
                        </form> 
                        
                        <form action="<?php echo U('Home/Info/xgejmmcl');?>" name="xgmmej" id="xgmmej" method="post" class="form_list">
                            <div class="row">
                            
                             <div class="form-group col-md-12">
                                <label>原二级密码</label>
                                <input type="password" value="" id="yejmm" class="form-control" name="yejmm" required>
                            </div>
                             <div class="form-group col-md-12">
                                <label>新二级密码</label>
                                <input type="password" value="" id="xejmm" class="form-control" name="xejmm" required>
                            </div>
                             <div class="form-group col-md-12">
                                <label>确认新二级密码</label>
                                <input type="password" value="" id="xejmmqr" class="form-control" name="xejmmqr" required>
                            </div>
                            </div>
                           
                            <div class="text-center">
                               
                                <input name="" type="submit" class="btn btn-success" value="确认修改" style="width:150px;margin:0 auto;background:#4096ee;color:#fff;">
                               
                            </div>
                        </form>
                        
 	    </div>
		 
		<nav class="mui-bar mui-bar-tab" style="border:none;">
			<a class="mui-tab-item" href="<?php echo U('Home/Index/index');?>" style="padding:0px;margin: 0px;">
				<span class="mui-icon home_icon"><img src="/wap_img/home.png"></span>
				<span class="mui-tab-label" style="font-size:14px;line-height: 20px;">首页</span>
			</a>
			<a class="mui-tab-item" href="<?php echo U('/Home/Index/news');?>" style="padding:0px;margin: 0px;">
				<span class="mui-icon home_icon"><img src="/wap_img/news.png"></span>
				<span class="mui-tab-label" style="font-size:14px;line-height: 20px;">公告</span>
			</a> 
			<a class="mui-tab-item" href="<?php echo U('Myuser/Index');?>" style="padding:0px;margin: 0px;">
				<span class="mui-icon home_icon"><img src="/wap_img/mine.png"></span>
				<span class="mui-tab-label" style="font-size:14px;line-height: 20px;">我的</span>
			</a>
			<a class="mui-tab-item" href="<?php echo U('Login/logout');?>" style="padding:0px;margin: 0px;">
				<span class="mui-icon home_icon"><img src="/wap_img/exit.png"></span>
				<span class="mui-tab-label" style="font-size:14px;line-height: 20px;">退出</span>
			</a>
			 
		</nav>
		<script src="/js/mui.js"></script>
	<script src="/js/jquery-1.11.3.min.js"></script>
	<script>
			$(".menu").click(function(){
				 
				$(".top_list").toggleClass("menu_active");
				 
			});
			 
		</script>
	</body>
</html>