<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
<link href="/sncss/css/style.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js"></script>
<script type="text/javascript">
	function del(ob){
		//alert(ob);
		var obj = $(ob);
		var id = obj.parent().parent().children().eq(0).html();
		$.post("/admdgjmin.php/Shop/Project/delProject",{id:id},function(data){
			alert(data);
			if(data){
				alert("删除成功");
				obj.parent().parent().remove();
			}else{
				alert("删除失败");
			}
		});
	}
	function upp(){
		//alert('111');
	}
</script>	
</head>
<body>
	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">产品管理</a></li>
    </ul>
    </div>

   <div class="formbody">
    
    <div class="formtitle"><span>基本信息</span></div>
    	
	 <table class="tablelist">
    	<thead>
    	<tr>
        <th>编号<i class="sort"><img src="/sncss/images/px.gif" /></i></th>
        <th>类别</th>        
        <th>名称</th>
        <th>标题</th>
        <th>价格</th>
        <th>缩略图</th>
        <th>添加时间</th>
        <th colspan="4">操作</th>
        
       
		
        </tr>
		
        </thead>
        <tbody>
		
		<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
		 <td><?php echo ($v["id"]); ?></td>
         <td><?php echo ($v["pidname"]); ?></td>
		 <td><?php echo ($v["name"]); ?></td>
		 <td><?php echo ($v["title"]); ?></td>		 
		 <td><?php echo ($v["price"]); ?></td>		 
		 <td><img src="<?php echo ($v["imagepath"]); ?>" width="100"></td>		 
		 <td><?php echo (date("Y-m-d H:i:s",$v["addtime"])); ?></td>		 
		 <td>
		 	<a onclick="" style='margin-left:10px;cursor:pointer;' href="/admdgjmin.php/Shop/Project/project/id/<?php echo ($v["id"]); ?>" >修改</a>
		 <a onclick="del(this)" style='margin-left:10px;cursor:pointer;'>删除</a>
		 <?php if($v["zt"] == 0): ?><a onclick="upp()" style='margin-left:10px;cursor:pointer;' href="/admdgjmin.php/Shop/Project/ztProject/id/<?php echo ($v["id"]); ?>/zt/1">上架</a>
		 <?php else: ?>	
		 	<a onclick="down(this)" style='margin-left:10px;cursor:pointer;' href="/admdgjmin.php/Shop/Project/ztProject/id/<?php echo ($v["id"]); ?>/zt/0">下架</a><?php endif; ?>
		 <?php if($v["zt"] == 2): ?><a onclick="upVip(this)" style='margin-left:10px;cursor:pointer;'href="/admdgjmin.php/Shop/Project/ztProject/id/<?php echo ($v["id"]); ?>/zt/1">取消</a>
		 <?php else: ?>	
		 	<a onclick="downVip(this)" style='margin-left:10px;cursor:pointer;'href="/admdgjmin.php/Shop/Project/ztProject/id/<?php echo ($v["id"]); ?>/zt/2">推荐</a></td><?php endif; ?>         
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
	
	
	
    </div>	
</body>
</html>