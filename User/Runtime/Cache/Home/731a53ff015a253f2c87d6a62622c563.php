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
.count_num{margin:10px;background:#4096ee;padding:11px 15px;}
.count_num p{color:#fff;font-size: 14px;line-height: 23px;}
.give_con{margin:10px;height:auto;overflow:hidden;}
.give_con label{width:100%;font-size: 16px;line-height: 26px;color:#ccc;}
.give_con label span{width:100%;font-size: 14px;line-height:30px;color:#8f8f94;display: block;    font-weight: 400;}
.give_con label input{border:1px solid #ddd;background: #fff;line-height: 40px;height:40px;width:100%;border-radius: 3px;}
.give_con label .submit{width:90%;margin:0 auto;background:#4096ee;margin-top: 20px;border-radius: 3px;
color:#fff;font-size: 15px;line-height: 40px;font-weight:400;height:40px;border:none;outline: none;display:block;}
.give_con label .give_list{width:90%;margin:0 auto;background:#fff;margin-top:10px;border-radius: 3px;
color:#333;font-size: 15px;line-height: 40px;font-weight:400;height:40px;text-align:center;border:1px solid #ccc;outline: none;display:block;}



		</style>
	</head>
	<body style="background: #fff;">
		<header class="mui-bar mui-bar-nav" style="background: #4096ee;">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color:#fff;"></a>
			<h1 class="mui-title" style="color:#fff;">排单币</h1>
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
 	    <div class="content_con" style="padding:0px;padding-top: 44px;">
			 <div class="count_num">
			 	<p>可用排单币：<?php echo ($userData["ue_pdb"]); ?></p>
			 </div>
			 <div class="give_con">
			 	<form name="form1" class="form01" method="post" action="/Home/Reghub/pdb_zr/">
					<label>
                        <span>排单币转让,数量:</span>
                        <input name="sh" type="text" id="sh">
                    </label>
					<label>
                       <span> 对方用户名:</span>
                        <input name="user" type="text" id="user"><font id="alert_pemail"></font>
                        <!-- <input type="button" id="jhwjjc" name="Submit2" value="检查"> -->
                    </label>
					<label>
                        <span>二级密码:</span>
                        <input name="ejmm" type="password" id="ejmm">
                    </label>
					<!--<label>
                            <input type="submit" name="Submit" value="确认转让">
                        </label>
                        <label>
                            <input type="submit" name="Submit" value="确认转让">
                        </label>-->
					<label>
                    	<button class="submit" type="submit" name="Submit" value="确认赠送" style="padding:0px;">确认转让</button>
                    </label>
					<label>
                    	<a href="pdb_list.html" type="button" class="give_list">转让记录</a>
                    </label>
</form>
			 </div>
			 
    
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