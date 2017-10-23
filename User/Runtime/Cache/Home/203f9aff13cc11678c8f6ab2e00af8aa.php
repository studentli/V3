<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="/css/mui.min.css" rel="stylesheet" />
		<link href="/css/style.css" rel="stylesheet" />	 
		<link href="/css/ind.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="/zTree_v3/css/zTreeStyle/zTreeStyle.css" type="text/css" />
	<link rel="stylesheet" href="/assets/vendor/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="/assets/styles/style.css">
		<title>V3财富</title>
		<style>
.top_list{display:none;background:#4096ee;min-height:200px;width:150px;z-index:99;border-radius:0;position:fixed;top:45px;right:1px} 
#menu{width:44px}
.menu_active{display:block;}
.mui-table-view-cell{text-align: center;color:#fff;}
.list_header{width:100%;height:auto;overflow: hidden;margin-top: 10px;background: #fff;margin-bottom: 10px;}
.list_header p{color:#0261aa;font-size: 15px;line-height:29px;margin:0px;padding-left: 10px;}
.list_li{padding:11px 15px;height:auto;overflow:hidden;background: #fff;border-top:1px solid #ddd;
margin:0px;border-bottom:1px solid #ddd;margin-bottom: 2px;}
.list_li li{color:#8f8f94;font-size: 14px;line-height: 24px;padding-left: 10px;margin:0px;}
.list_li li span{padding-left: 10px;}
		</style>
	
	
</head>


<body style="position: relative;min-width: 320px;max-width: 650px;margin: auto;background: #fff!important;">
		<header class="mui-bar mui-bar-nav" style="background: #4096ee;">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color:#fff;"></a>
			<h1 class="mui-title" style="color:#fff;">我的团队</h1>
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
	
	<div class="formbody" style="margin-top:50px;">
		<!-- <div style="padding:0 10px;">
			<h5 style="line-height:30px;font-size:1.2em;">我推荐的用户</h5>
			<table id="example" cellpadding="1" cellspacing="1" class="table table-bordered table-striped cus_datatable dataTable no-footer"
			 role="grid" aria-describedby="example_info" style="width: 100%;">
				<thead>
					<tr role="row" style="background: #AC1818;color: #fff;">
						<th class="sorting_asc" rowspan="1" colspan="1" aria-label="用户ID">ID</th>
						<th class="sorting_disabled" rowspan="1" colspan="1" aria-label="昵称">昵称</th>
						<th class="sorting_disabled" rowspan="1" colspan="1" aria-label="级别">级别</th>
						<th class="sorting_disabled" rowspan="1" colspan="1" aria-label="邮箱">邮箱</th>
						<th class="sorting_disabled" rowspan="1" colspan="1" aria-label="推荐人">推荐人</th>
						<th class="sorting_disabled" rowspan="1" colspan="1" aria-label="注册经理">注册人</th>
						<th class="sorting_disabled" rowspan="1" colspan="1" aria-label="加入时间">加入时间</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr role="row" class="odd">
							<td class="sorting_1"><?php echo ($v["ue_id"]); ?></td>
							<td><?php echo ($v["ue_theme"]); ?></td>
							<td>VIP会员</td>
							<td><?php echo ($v["ue_account"]); ?></td>
							<td><?php echo ($v["ue_accname"]); ?></td>
							<td><?php echo ($v["zcr"]); ?></td>
							<td><?php echo ($v["ue_regtime"]); ?></td>
						</tr><?php endforeach; endif; ?>


				</tbody>
			</table>
		</div> -->
		<div class="core_con" style="padding-top: 40px;">
			<!-- <div style="font-size:9pt;">
				<form action="" method="get" style="padding: 0 20px;">
					<p style="font-size:1.2em;line-height:30px;">会员账号 :</p>
					<input name="user" id="user" type="hidden" value="<?php echo ($user); ?>" />
					<input id="user" name="user" type="text" style="padding: 4px 10px;border: 1px solid #ccc;">
					<input name="" type="button" id="btn" value="搜索" style="padding: 4px 10px;color: #fff;background: #AC1818;">
					<span id="daishu"></span>
				</form>
			</div> -->
			<div class="content_wrap">
				<div class="zTreeDemoBackground ">
					<ul id="treeDemo" class="ztree"></ul>
				</div>
			</div>
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
		
<script type=text/javascript src="/zTree_v3/js/jquery.min.js"></script>
	<script type="text/javascript" src="/zTree_v3/js/jquery.ztree.core-3.5.js"></script>
  <script src="/js/mui.js"></script>
	<!-- <script src="/js/jquery-1.11.3.min.js"></script>  -->
	<script>
			$(".menu").click(function(){
				 
				$(".top_list").toggleClass("menu_active");
				 
			});
			 
		</script>
	<script type=text/javascript>
		var setting = { 
	view: { 
		showLine: true 
	}, 
	data: { 
		simpleData: { 
			enable: true 
		} 
	} 
}; 

var zNodes =[
	{ id:1, pId:0, name:"父節點1 - 展開", open:true},
	{ id:11, pId:1, name:"父節點11 - 摺疊"},
	{ id:111, pId:11, name:"葉子節點111"},
	{ id:112, pId:11, name:"葉子節點112"},
	{ id:113, pId:11, name:"葉子節點113"},
	{ id:114, pId:11, name:"葉子節點114"},
	{ id:12, pId:1, name:"父節點12 - 摺疊"},
	{ id:121, pId:12, name:"葉子節點121"},
	{ id:122, pId:12, name:"葉子節點122"},
	{ id:123, pId:12, name:"葉子節點123"},
	{ id:124, pId:12, name:"葉子節點124"},
	{ id:13, pId:1, name:"父節點13 - 沒有子節點", isParent:true},
	{ id:2, pId:0, name:"父節點2 - 摺疊"},
	{ id:21, pId:2, name:"父節點21 - 展開", open:true},
	{ id:211, pId:21, name:"葉子節點211"},
	{ id:212, pId:21, name:"葉子節點212"},
	{ id:213, pId:21, name:"葉子節點213"},
	{ id:214, pId:21, name:"葉子節點214"},
	{ id:22, pId:2, name:"父節點22 - 摺疊"},
	{ id:221, pId:22, name:"葉子節點221"},
	{ id:222, pId:22, name:"葉子節點222"},
	{ id:223, pId:22, name:"葉子節點223"},
	{ id:224, pId:22, name:"葉子節點224"},
	{ id:23, pId:2, name:"父節點23 - 摺疊"},
	{ id:231, pId:23, name:"葉子節點231"},
	{ id:232, pId:23, name:"葉子節點232"},
	{ id:233, pId:23, name:"葉子節點233"},
	{ id:234, pId:23, name:"葉子節點234"},
	{ id:3, pId:0, name:"父節點3 - 沒有子節點", isParent:true}
];


$(document).ready(function(){
var $user1 = $('#user1').val();
	$.ajax({
		type: "post",
		dataType : "json",
		global : false,
		url : "/index.php/Home/Common/getTree",
		data : {
		user1 : $user1
		},
		success : function(data, textStatus) {
			if (data.status == 0)
			{
				zNodes1 = data.data;
				$.fn.zTree.init($("#treeDemo"), setting, zNodes1);
			} else {
				alert("您還沒有");
			}
			
			return ;
		}
		
	});
	
	//$.fn.zTree.init($("#treeDemo"), setting, zNodes);
});



$(function(){



$('#btn').click(function(){

var $user = $('#user').val();
$.ajax({
		type: "post",
		dataType : "json",
		global : false,

		url : "/index.php/Home/Common/getTreeso",
		data : {
		user : $user
		},
		success : function(data, textStatus) {
			if (data.status == 0)
			{
			//alert(data.nr);
			
				zNodes1 = data.data;
				$.fn.zTree.init($("#treeDemo"), setting, zNodes1);
			} else {
				alert(data.data);
			}
			
			return ;
		}
		
	});



})


})
	</script>
</body>

</html>