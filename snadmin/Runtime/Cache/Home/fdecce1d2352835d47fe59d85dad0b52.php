<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/sncss/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">表单</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    <div class="formtitle"><span>基本信息</span></div>
      <form id="form1" name="form1" method="post" action="/admdgjmin.php/Home/Index/usercl">
	  <input name="UE_account"  type="hidden" class="dfinput" value="<?php echo ($userdata['ue_account']); ?>" />
    <ul class="forminfo">
	<li><label>会员编号</label><input name="UE_account1" disabled="true " type="text" class="dfinput" value="<?php echo ($userdata['ue_account']); ?>" /><i>不可修改</i></li>
	<li><label>推荐人</label><input name="UE_accName" disabled="true " type="text" class="dfinput" value="<?php echo ($userdata['ue_accname']); ?>"/><i>不可修改</i></li>
	<li><label>昵称</label><input name="UE_theme" type="text" class="dfinput" value="<?php echo ($userdata['ue_theme']); ?>"/></li>
	<li style="display:none;"><label>是否激活</label><?php if($userdata['ue_check'] == 0): ?><cite><input name="UE_check" type="radio" value="1" />是&nbsp;&nbsp;&nbsp;&nbsp;<input name="UE_check" type="radio" value="0" checked="checked" />否</cite><?php else: ?><cite><input name="UE_check" type="radio" value="1" checked="checked" />
	是&nbsp;&nbsp;&nbsp;&nbsp;<input name="UE_check" type="radio" value="0" />
	否</cite><?php endif; ?></li>
    <li><label>是否内部账号</label><?php if($userdata['sfjl'] == 0): ?><cite><input name="UE_stop" type="radio" value="1" />是&nbsp;&nbsp;&nbsp;&nbsp;<input name="UE_stop" type="radio" value="0" checked="checked" />否</cite><?php else: ?><cite><input name="UE_stop" type="radio" value="1" checked="checked" />
	是&nbsp;&nbsp;&nbsp;&nbsp;<input name="UE_stop" type="radio" value="0" />
	否</cite><?php endif; ?></li>
    <!-- <li><label>是否封号</label><?php if($userdata['UE_status'] == 0): ?><cite><input name="UE_status" type="radio" value="1" />是&nbsp;&nbsp;&nbsp;&nbsp;<input name="UE_status" type="radio" value="0" checked="UE_status" />否</cite><?php else: ?><cite><input name="UE_status" type="radio" value="1" checked="checked" />
	是&nbsp;&nbsp;&nbsp;&nbsp;<input name="UE_check" type="radio" value="0" />
	否</cite><?php endif; ?></li> -->
    <li><label>是否冻结</label><?php if($userdata['cold'] == 0): ?><cite><input name="cold" type="radio" value="1" />是&nbsp;&nbsp;&nbsp;&nbsp;<input name="cold" type="radio" value="0" checked="UE_status" />否</cite><?php else: ?><cite><input name="cold" type="radio" value="1" checked="checked" />
    是&nbsp;&nbsp;&nbsp;&nbsp;<input name="cold" type="radio" value="0" />
    否</cite><?php endif; ?></li>
    <li><label>一级密码</label><input name="UE_password" type="text" class="dfinput" /><i>不修改请留空</i></li>
    <li><label>二级密码</label><input name="UE_secpwd" type="text" class="dfinput" /><i>不修改请留空</i></li>
    <li><label>姓名</label><input name="UE_truename" type="text" class="dfinput" value="<?php echo ($userdata['ue_truename']); ?>"/><i></i></li>
	<li><label>微信号</label><input name="weixin" type="text" class="dfinput" value="<?php echo ($userdata['weixin']); ?>"/><i></i></li>
	<li><label>支付宝</label><input name="zfb" type="text" class="dfinput" value="<?php echo ($userdata['zfb']); ?>"/><i></i></li>
	<li><label>银行名称</label><input name="yhmc" type="text" class="dfinput" value="<?php echo ($userdata['yhmc']); ?>"/><i></i></li>
    <li><label>银行账户号码</label><input name="yhzh" type="text" class="dfinput" value="<?php echo ($userdata['yhzh']); ?>"/><i></i></li>
	<li><label>手机号</label><input name="UE_phone" type="text" class="dfinput" value="<?php echo ($userdata['ue_phone']); ?>"/><i></i></li>
        <li><label>静态钱包</label><input name="UE_money" type="text" class="dfinput" value="<?php echo ($userdata['ue_money']); ?>"/><i></i></li>
        <li><label>动态钱包</label><input name="tj_he" type="text" class="dfinput" value="<?php echo ($userdata['tj_he']); ?>"/><i></i></li>
        <li><label>商城钱包</label><input name="shop_money" type="text" class="dfinput" value="<?php echo ($userdata['shop_money']); ?>"/><i></i></li>
    <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="确认保存"/></li>
    </ul>
      </form>
    
    </div>


</body>

</html>