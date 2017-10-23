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
.accept_help{width:100%;height: auto;overflow: hidden;margin-top: 20px;}
.accept_help .form_group{width:100%;height: auto;overflow: hidden;margin-bottom: 10px;}
.accept_help .form_group label{width:100%;text-align: right;font-size: 14px;line-height:40px;height:40px;color:#333; }
.accept_help .form_group select{width:50%;float: right;border:1px solid #ddd;background:#eee;height:34px;line-height: 34px;padding:0px;margin:0px;}
.accept_help .form_group input{width:50%;float: right;border:1px solid #ddd;line-height: 34px;height:34px;padding:0px;margin:0px;}

	</style>
	</head>
	<body style="background: #fff;">
		<header class="mui-bar mui-bar-nav" style="background: #4096ee;">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color:#fff;"></a>
			<h1 class="mui-title" style="color:#fff;">接受帮助</h1>
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
 	     
 	    <div class="content_con" style="padding:20px;padding-top: 44px;">
 	    	  <div class="accept_help">
 	    	  	 <form action="<?php echo U("Home/Index/jsbzcl");?>" method="post">
 	    	  	 	<div class="form_group">
 	    	  	 		<label>钱包类型：</label>
 	    	  	 		<div class="form_li">
 	    	  	 			<input type="radio" name="moneytype" checked="" value='1' style="width:15px;height: 15px;float: none;margin-left: 10px;margin-right: 10px;margin-top: 3px;">静态钱包
 	    	  	 			<input type="radio" name="moneytype" value="2"style="width:15px;height: 15px;float: none;margin-left: 10px;margin-right: 10px;margin-top: 3px;">动态钱包
 	    	  	 		</div>
 	    	  	 	</div>
 	    	  	 	<div class="form_group">
			 		 <label>支付方式：</label>
			 		 <div class="radio" align="left">

                                <input type="checkbox" value="1" class="ckbox" name="zffs1" checked="" style="width:20px;height:20px;float:left;margin-right:15px;">银行支付<br>
                                <input type="checkbox" value="1" class="ckbox" name="zffs2" checked="" style="width:20px;height:20px;float:left;margin-right:15px;">支付宝支付<br>
                                <input type="checkbox" value="1" class="ckbox" name="zffs3" checked="" style="width:20px;height:20px;float:left;margin-right:15px;">微信支付<br>
                            </div>
			 		</div>
 	    	  	 	<div class="form_group">
 	    	  	 		<label>接受帮助金额：</label>
 	    	  	 		<div class="form_li">
 	    	  	 			<input type="text" name="get_amount" style="width:100%;">
 	    	  	 		</div>
 	    	  	 	</div>
 	    	  	 	<div class="form_group">
 	    	  	 		<label>确认二级密码：</label>
 	    	  	 		<div class="form_li">
 	    	  	 			<input type="password" name="" style="width:100%;">
 	    	  	 		</div>
 	    	  	 	</div>
 	    	  	 	<div class="form-group" style="text-align: center;margin-top: 20px;">
                            
 						<button style="background:#4096ee;border:0px;margin:0 auto;color:#fff;">确认接受</button>

                    </div>
 	    	  	   
 	    	  	 </form>
 	    	  </div>
 	    	  
		</div>
		 
		<nav class="mui-bar mui-bar-tab" style="border:none;">
			<a class="mui-tab-item" href="<?php echo U('/Home/Index/index');?>" style="padding:0px;margin: 0px;">
				<span class="mui-icon home_icon"><img src="/wap_img/home.png"></span>
				<span class="mui-tab-label" style="font-size:14px;line-height: 20px;">首页</span>
			</a>
			<a class="mui-tab-item" href="<?php echo U('/Home/Index/news');?>" style="padding:0px;margin: 0px;">
				<span class="mui-icon home_icon"><img src="/wap_img/news.png"></span>
				<span class="mui-tab-label" style="font-size:14px;line-height: 20px;">公告</span>
			</a> 
			<a class="mui-tab-item" href="<?php echo U('/Home/Myuser/Index');?>" style="padding:0px;margin: 0px;">
				<span class="mui-icon home_icon"><img src="/wap_img/mine.png"></span>
				<span class="mui-tab-label" style="font-size:14px;line-height: 20px;">我的</span>
			</a>
			<a class="mui-tab-item" href="<?php echo U('/Home/Login/logout');?>" style="padding:0px;margin: 0px;">
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
                                        $(function () {
                                            $('#aac').change(function () {

                                                $("#shouyi_x").hide();
                                                $("#shoukuan_s").hide();
                                                $("#aishan_x").hide();

                                                switch ($('#aac').val())
                                                {
                                                    case '1':
                                                        $('#cca').val('1000');
                                                        $('#pinmin').show();
                                                        $('#zhongchan').hide();
                                                        $('#furen').hide();
                                                        $('#tuhao').hide();
                                                        $("#date_s").removeAttr("disabled");
                                                        $('#xuanqu').val('1')
                                                        $('#date_s').val('')
                                                        $('#aishan_s').val('')
                                                        break;
                                                    case '2':
                                                        $('#cca').val('2000~5000');
                                                        $('#zhongchan').show();
                                                        $('#pinmin').hide();
                                                        $('#furen').hide();
                                                        $('#tuhao').hide();
                                                        $("#date_s").removeAttr("disabled");
                                                        $('#xuanqu').val('2')
                                                        $('#date_s').val('')
                                                        $('#aishan_s').val('')
                                                        break;
                                                    case '3':
                                                        $('#cca').val('6000~10000');
                                                        $('#furen').show();
                                                        $('#pinmin').hide();
                                                        $('#zhongchan').hide();
                                                        $('#tuhao').hide();
                                                        $("#date_s").removeAttr("disabled");
                                                        $('#xuanqu').val('3')
                                                        $('#date_s').val('')
                                                        $('#aishan_s').val('')
                                                        break;
                                                    case '4':
                                                        $('#cca').val('11000~20000');
                                                        $('#tuhao').show();
                                                        $('#pinmin').hide();
                                                        $('#zhongchan').hide();
                                                        $('#furen').hide();
                                                        $("#date_s").attr("disabled","disabled");
                                                        $('#date_s').val('3')
                                                        $("#shouyi_x").show();
                                                        $("#shoukuan_s").show();
                                                        $('#shouyi_s').val('6%')
                                                        $('#bili').val('6%')
                                                        $('#shijian').val('15天')
                                                        $("#shoukuan_x").val('19天后')
                                                        $('#aishan_s').val('500')
                                                        $("#aishan_x").show();
                                                        $('#xuanqu').val('4')
                                                        break;

                                                }
                                            })
                                        })
                                    </script>
	</body>
</html>