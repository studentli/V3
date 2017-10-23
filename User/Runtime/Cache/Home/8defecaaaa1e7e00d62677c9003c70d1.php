<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php echo ($usertitle); ?></title>
	</head>
	<style>
		*{padding:0;margin:0;}
		 
input::-webkit-input-placeholder{color:#fff!important;}
input::-moz-input-placeholder{color:#fff!important;}
input::-ms-input-placeholder{color:#fff!important;}
		a{text-decoration: none;display:block;}
		li{list-style: none;}
		input{border:none;}
		img{display:block;margin:0 auto;}
		.container{width:35%;height:100%;padding:0 20px; margin:0px auto;margin-top:40px;padding-bottom:20px;
		background:#fff;border-radius:10px;}
		.container .lg{margin-top: 20px;}
		.container .form-group{width:96%;margin:20px auto; }
		.fix{clear:both;}
		.form-group input{display: block;
        width: 74%;
        height: 44px;
        padding: 0px 2%;
        font-size: 16px;
        color: #fff;
        background: none;
        border: none;
        float: left;}
	body:before {
	  content: ' ';
	  position: fixed;
	  z-index: -1;
	  top: 0;
	  right: 0;
	  bottom: 0;
	  left: 0;
	  background: url(/wap_img/bg.png) center 0 no-repeat;
	  background-size: cover;
	}
	 .form-group {
        /*background: #fff;*/
       background: rgba(255,255,255,0.2);
        border: 1px solid #fff;
        border-radius: 25px;
    }

    .clr {
        clear: both;
    }

    .form-group p {
        margin: 0;
        height: 30px;
        margin-top: 7px;
        float: left;
        width: 20%;
        text-align: center;
        border-right: 1px solid #ccc;
    }

    .form-group p img {
        height: 100%;
    }
	@media only screen and (min-width: 320px) and (max-width: 374px) {
		
	}
	</style>
	<body style="background:url(/wap_img/bg.png) no-repeat center center;background-attachment:fixed;background-size:cover;width:100%;height:100%;">
	<h1 style="text-align: center;line-height: 60px;font-size: 20px;font-weight: normal;color: #fff;">登 录</h1>
	  <div class="container" style="width:90%;margin-top:12%; background: none;">
	  	<!--<div class="lg" style="margin-bottom: 15px;">
	  		<img src="/wap_img/wap_logo.png" width="180">
	  	</div>-->
	  	<form action="/Home/login/logincl" method="post" style="margin-top:25%;">
			<div class="form-group">
				<p><img src="/wap_img/user.png" alt=""></p>
				<input type="text" name="account" placeholder="请输入用户名" style="padding-left: 2%;" required="true">
				<div class="fix"></div>
			</div>
			<div class="form-group">
				<p><img src="/wap_img/password.png" alt=""></p>
				<input type="password" name="password" placeholder="请输入密码" style="padding-left: 2%;" required="true">
				<div class="fix"></div>
			</div>
			<div class="form-group" style="background:none;border:none;">
				<input type="text" name="verCode" placeholder="请输入验证码" style="float:left;width:45%;padding-left: 4%;background:none;border-radius: 25px;border: 1px solid #fff;" required="true">
				<img src="/index.php/Home/login/verify" name="" height="44" id="" style="float:right;width:45%;border-radius: 25px;" onclick="this.src='/index.php/Home/login/verify?'+Math.random();">
				<div class="fix"></div>
			</div>
			<div class="form-group" style="border:none;">
				<input type="submit" name="" value="登&nbsp;录" style="color:#fff;background:#4096ee;border:0px;width: 100%;padding: 0;border-radius: 25px;font-size:18px;">
				<div class="fix"></div>
			</div>
			<div class="form-group" style="background:none;border:none;">
				<a href="register.html" style="float:left;font-size:14px;width:120px;line-height:30px;color:#fff;background:#4096ee;border-radius: 25px;text-align: center;">注册会员</a>
				<a href="retrieve_password.html" style="float:right;font-size:14px;width:120px;line-height:30px;color:#fff;background:#4096ee;border-radius: 25px;text-align: center;">忘记密码</a>
				<div class="fix"></div>
			</div>
		
		</form>
	  </div>
	</body>
</html>