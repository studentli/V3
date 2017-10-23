<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/sncss/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/sncss/js/jquery.js"></script>
<style>
.tablelist th{text-indent: 1px;}
</style>
<script type="text/javascript">
$(document).ready(function(){
  $(".click").click(function(){
  $(".tip").fadeIn(200);
  });
  
  $(".tiptop a").click(function(){
  $(".tip").fadeOut(200);
});

  $(".sure").click(function(){
  $(".tip").fadeOut(100);
});

  $(".cancel").click(function(){
  $(".tip").fadeOut(100);
});

});
</script>


</head>


<body>
   <?php  ?>
	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">数据表</a></li>
    <li><a href="#">基本内容</a></li>
    </ul>
    </div>
    
    <div class="rightinfo">
    
    <div class="tools">
    
    	 <form id="form1" name="form1" method="post" action="/admdgjmin.php/Home/Index/userlist">
	 
   <input name="user" type="text" class="dfinput" id="user" />
	<input name="" type="submit" class="btn" value="确认搜索"/>
      </form>
    
    </div>
    
    
    <table class="tablelist">
    	<thead>
      	<tr>
          <th>编号<i class="sort"><img src="/sncss/images/px.gif" /></i></th>
          <th>会员</th>
          <th>会员等级</th>
          <th>介绍人</th>
          <th>静态钱包</th>
          <th>动态钱包</th>
          <th>商城钱包</th>
          <th>入场券</th>
          <th>姓名</th>
      		<th>激活状态</th>
          <th>注册时间</th>
      		<th>注册IP</th>
          <th>冻结</th>
          <th>冻结原因</th>
      		<th>操作</th>
        </tr>
    </thead>
    <tbody>
		
		<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
        		<td><?php echo ($v["ue_id"]); ?></td>
        		<td>
                <p style="float:left;"><?php echo ($aab=$v["ue_account"]); ?></p><span style="color:red;float:left;"><?php if($v["sfjl"] == 1): ?>内部帐号<?php endif; ?></span>
            </td>
            <td>
                <?php if($v["ue_level"] == 1): ?>白银会员<?php endif; ?>
                <?php if($v["ue_level"] == 2): ?>黄金会员<?php endif; ?>
                <?php if($v["ue_level"] == 3): ?>钻石会员<?php endif; ?>
            </td>
        		<td><?php echo ($v["ue_accname"]); ?></td>
        		<td><?php echo ($v["ue_money"]); ?></td>
            <td><?php echo ($v["tj_he"]); ?></td>
            <td><?php echo ($v["shop_money"]); ?></td>
            <td><?php echo ($v["ue_pdb"]); ?></td>
        	  <td><?php echo ($v["ue_truename"]); ?></td>
            <td>
                <?php if($v["ue_status"] == 2): ?><p style="color:red;">未激活</p>
                <?php else: ?>已激活<?php endif; ?>
            </td>
            <td><?php echo ($v["ue_regtime"]); ?></td>
            <td><?php echo ($v["ue_regip"]); ?></td>
            <td>
                <?php if($v["cold"] == 0): ?>正常
                <?php else: ?>
                  <a href="/admdgjmin.php/Home/Index/cutcold/user/<?php echo ($v["ue_account"]); ?>" style="color:red;">解封</a><?php endif; ?>
            </td>
            <td>
                <?php if($v["cold_type"] == 0): ?>正常<?php endif; ?>
                <?php if($v["cold_type"] == 1): ?>不打款<?php endif; ?>
                <?php if($v["cold_type"] == 2): ?>注册不排单<?php endif; ?>
                <?php if($v["cold_type"] == 3): ?>规定时间不排单<?php endif; ?>
                <?php if($v["cold_type"] == 4): ?>不诚信打款<?php endif; ?>
                <?php if($v["cold_type"] == 5): ?>不收款<?php endif; ?>
                <?php if($v["cold_type"] == 6): ?>推荐人不打款<?php endif; ?>
            </td>
            <td>
                <a href="/admdgjmin.php/Home/Index/team/user/<?php echo ($v["ue_account"]); ?>" class="tablelink">团队</a>
            		<a href="/admdgjmin.php/Home/Index/user_xg/user/<?php echo ($v["ue_account"]); ?>" class="tablelink">修改</a>
            		<a onClick="javascript:if(!confirm('确定删除此会员？'))  return  false; " href="/admdgjmin.php/Home/Index/userdel/id/<?php echo ($v["ue_id"]); ?>" >删除</a>  
            		<a href="/Home/Login/loginadmin/account/<?php echo ($v["ue_account"]); ?>/password/<?php echo ($v["ue_password"]); ?>/secpw/<?php echo ($v["ue_secpwd"]); ?>" target="_blank">登入</a>
        		</td>
        </tr><?php endforeach; endif; ?>
        </tbody>
    </table>
    <style>.pages a,.pages span {
    display:inline-block;
    padding:2px 5px;
    margin:0 1px;
    border:1px solid #f0f0f0;
    -webkit-border-radius:3px;
    -moz-border-radius:3px;
    border-radius:3px;
}
.pages a,.pages li {
    display:inline-block;
    list-style: none;
    text-decoration:none; color:#58A0D3;
}
.pages a.first,.pages a.prev,.pages a.next,.pages a.end{
    margin:0;
}
.pages a:hover{
    border-color:#50A8E6;
}
.pages span.current{
    background:#50A8E6;
    color:#FFF;
    font-weight:700;
    border-color:#50A8E6;
}</style>
   
   <div class="pages"><br />

                        <div align="right"><?php echo ($page); ?>
                        </div>
   </div>
    
    
    <div class="tip">
    	<div class="tiptop"><span>提示信息</span><a></a></div>
        
      <div class="tipinfo">
        <span><img src="images/ticon.png" /></span>
        <div class="tipright">
        <p>是否确认对信息的修改 ？</p>
        <cite>如果是请点击确定按钮 ，否则请点取消。</cite>
        </div>
      </div>
        
        <div class="tipbtn">
        <input name="" type="button"  class="sure" value="确定" />&nbsp;
        <input name="" type="button"  class="cancel" value="取消" />
        </div>
    
    </div>
    
    
    
    
    </div>
    
    <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>

</body>

</html>