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
		</style>
	</head>
	<body style="background: #fff;">
		<header class="mui-bar mui-bar-nav" style="background: #4096ee;">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color:#fff;"></a>
			<h1 class="mui-title" style="color:#fff;">会员注册</h1>
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
 	    	   	<form class="reg_list" action="<?php echo U('Home/Index/regadd');?>"  method="post">
				 
				<div class="reg_li">
					<label>手机号：</label>
					<input type="text" value="" placeholder="请输入手机号" name="phone" id="user"  required>	
				</div>
				<div class="reg_li">
					<label>验证码：</label>
					<input name="smsnum" type="text" value="" placeholder="验证码" maxlength="4" required style="width:30%;float: left;">
					<button style="margin-top: 5px;" type="button" id="phone-check" class="sumbtn">获取验证码</button>
				</div>
				<div class="reg_li">
					<label>密码：</label>
					<input type="password" value="" placeholder="请输入密码" name="password" required>
				</div>
				<div class="reg_li">
					<label>二级密码：</label>
					<input type="password" value="" placeholder="请输入二级密码" name="ejmm" required>
				</div>
				<div class="reg_li">
					<label>真实姓名：</label>
					<input type="text" value="" placeholder="真实姓名" name="username" required>
				</div>
				<div class="reg_li">
					<label>性别：</label>
					<div style="width:63%;float: left;">
						<div style="width:70px;float: left;line-height: 40px;">
							<input type="radio" name="sex" value="男" checked style="width:15px;height: 15px;float: left;margin-top: 12px;">男</div>
 						<div style="width:70px;float: left;line-height: 40px;">
 							<input type="radio" name="sex" value="女" style="width:15px;height: 15px;float: left;margin-top: 12px;">女</div>
					</div>
				</div>
				<div class="reg_li">
					<label>推荐人帐号：</label>
					<input type="text" value="<?php echo ($tjr); ?>" readonly placeholder="推荐人帐号" name="pemail" id="phone" >	
				</div>
				 

			 <div class="submit_con">

				<input type="submit" class="submit" value="提交">

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
		 <script>
			$("#phone-check").click(function(){
				var ob = $(this);
				ob.attr("disabled",true);
				var phone = $('#user').val();
				var reg = /^1[3|4|5|8|7][0-9]\d{8}$/;
				if(phone == "" || !reg.test(phone)){
					alert("请正确填写手机号码");
					ob.removeAttr("disabled");
					return;
				}
				$.post("/Home/login/check_phone",{phone:phone},function(data){
					if(data>0){
						alert("发送失败");
						ob.removeAttr("disabled");
						return false;
					}else{
						alert("发送成功");
						var i=120;
						var intval = setInterval(function(){
							ob.html(i);
							i--;
							if(i<0){
								ob.removeAttr("disabled");
								ob.html("重新获取");
								clearInterval(intval);
							}
						},1000);
					}
				});
			});
		</script>
	</body>
</html>