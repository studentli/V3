<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>
			无标题文档
		</title>
		<link href="/sncss/css/style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div class="place">
			<span>
				位置：
			</span>
			<ul class="placeul">
				<li>
					<a href="#">
						首页
					</a>
				</li>
				<li>
					<a href="#">
						初始化
					</a>
				</li>
			</ul>
		</div>
		<div class="formbody">
			<div class="formtitle">
				<span >
					初始化
				</span>
				
			</div>
			<form id="form1" name="form1" method="post" onsubmit="return confirm('此操作将删除所有前台用户及数据(admin.@qq.com除外)');" action="/admdgjmin.php/Home/Index/my_initialize">
				<input name="init" type="hidden" class="dfinput" value="1"
				/>
				<ul class="forminfo">
					
					
					<li>
						<label>
							&nbsp;
						</label>
						<input name="" type="submit" class="btn" value="初始化" />
					</li>
				</ul>
			</form>
			
			<style>
				.pages a,.pages span { display:inline-block; padding:2px 5px; margin:0
				1px; border:1px solid #f0f0f0; -webkit-border-radius:3px; -moz-border-radius:3px;
				border-radius:3px; } .pages a,.pages li { display:inline-block; list-style:
				none; text-decoration:none; color:#58A0D3; } .pages a.first,.pages a.prev,.pages
				a.next,.pages a.end{ margin:0; } .pages a:hover{ border-color:#50A8E6;
				} .pages span.current{ background:#50A8E6; color:#FFF; font-weight:700;
				border-color:#50A8E6; }
			</style>
			<div class="pages">
				<br />
				<div align="right">
					<?php echo ($page); ?>
				</div>
			</div>
		</div>
	</body>

</html>