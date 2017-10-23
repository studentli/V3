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
.offer_help{width:100%;height: auto;overflow: hidden;margin-top: 20px;}
.offer_help .form_group{width:100%;height: auto;overflow: hidden;margin-bottom: 10px;}
.offer_help .form_group label{width:100%;text-align: right;font-size: 14px;line-height:40px;color:#333; }
.offer_help .form_group select{width:50%;float: right;border:1px solid #ddd;background:#eee;height:34px;line-height: 34px;padding:0px;margin:0px;}
.offer_help .form_group input{width:50%;float: right;border:1px solid #ddd;line-height: 34px;height:34px;padding:0px;margin:0px;}

	</style>
	</head>
	<body style="background: #fff;">
		<header class="mui-bar mui-bar-nav" style="background: #4096ee;">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color:#fff;"></a>
			<h1 class="mui-title" style="color:#fff;">申请帮助</h1>
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
 	    	 <!--<h3>申请帮助</h3>-->
			 <div class="offer_help"> 
			 	<form action="<?php echo U('Index/tgbzcl');?>" method="post">
			 		<div class="form_group">
			 			<label>申请提供帮助区域：</label>
			 	    	<div class="form_li">
			 	    		<select id="aac" name="qy" class="form-control " style="width: 50%;float: left;border-radius: 4px 0 0 4px;">
                                        <option value="1">体验区</option>
                                        <option value="2">白银区</option>
                                        <option value="3">黄金区</option>
                                        <option value="4">钻石区</option> 
	                        </select>
	                        <input type="text" class="form-control" placeholder="" value="1000" id="cca" name="amount" autocomplete="off" required="" readonly="" style="width:50%;border-radius:0 4px 4px 0;float: right">
	                           
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
                        <label style="line-height: 40px;">申请提供帮助金额：</label>    
 						<div class="form_li">
                        	<input type="text" class="get_amount" placeholder="提携申请金额" name="amount" id="amount" autocomplete="off" required="" style="border-radius: 4px;width:100%;">		
 						</div>

                    </div>
                    <div class="form_group">
                        <label style="line-height: 40px;">二级密码：</label>    
 						<div class="form_li">
                        	<input type="password" name="secpwd"  placeholder="请输入二级密码" id="pwd" required="true" style="border-radius: 4px;width:100%;">		
 						</div>

                    </div>
                    <div class="form_group" style="text-align: center;margin-top: 10px;">
                            
 						<button style="background:#4096ee;border:0px;margin:0 auto;color:#fff;">确认申请</button>

                    </div>
			 		 
			 	</form>
			 </div>
		</div>
		 
		<nav class="mui-bar mui-bar-tab" style="border:none;">
			<a class="mui-tab-item" href="home.html" style="padding:0px;margin: 0px;">
				<span class="mui-icon home_icon"><img src="/wap_img/home.png"></span>
				<span class="mui-tab-label" style="font-size:14px;line-height: 20px;">首页</span>
			</a>
			<a class="mui-tab-item" href="news.html" style="padding:0px;margin: 0px;">
				<span class="mui-icon home_icon"><img src="/wap_img/news.png"></span>
				<span class="mui-tab-label" style="font-size:14px;line-height: 20px;">公告</span>
			</a> 
			<a class="mui-tab-item" href="person.html" style="padding:0px;margin: 0px;">
				<span class="mui-icon home_icon"><img src="/wap_img/mine.png"></span>
				<span class="mui-tab-label" style="font-size:14px;line-height: 20px;">我的</span>
			</a>
			<a class="mui-tab-item" href="#tabbar-with-contact" style="padding:0px;margin: 0px;">
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
                                                        $('#cca').val('<?php echo ($settings['ty_tz_min']); ?>');
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
                                                        $('#cca').val('<?php echo ($settings['baiyin_tz_min']); ?>~<?php echo ($settings['baiyin_tz_max']); ?>');
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
                                                        $('#cca').val('<?php echo ($settings['huangjin_tz_min']); ?>~<?php echo ($settings['huangjin_tz_max']); ?>');
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
                                                        $('#cca').val('<?php echo ($settings['zuanshi_tz_min']); ?>~<?php echo ($settings['zuanshi_tz_max']); ?>');
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