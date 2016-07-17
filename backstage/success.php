<?php
	require  '../inc/config.php';	//加载数据库配置文件
	require '../inc/loading.php'; //加载跳转页面函数
	
	if (empty($_COOKIE['adminName'])){
		alertAndLoading("请正确登录", "index.php");
	}
	
	$adminName = base64_decode(base64_decode($_COOKIE['adminName']));
	
	if (!empty($_REQUEST['act'])){
		$act = $_REQUEST['act'];
		if ($act == "deletecookie"){
			if (!empty($_COOKIE['adminName'])){
				setcookie('adminName',base64_decode(base64_decode($_COOKIE['adminName'])),time()-3600,'/');
				loading("index.php");
			}
		}
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (!empty($_REQUEST['act'])){
			$act = $_REQUEST['act'];
			if ($act == "addgoods"){
				$path="../uploads/";        //上传路径
				$pathsave="./uploads/";
				//echo $_FILES["filename"]["type"];
				if(!file_exists($path)){
					//检查是否有该文件夹，如果没有就创建，并给予最高权限
					mkdir("$path", 0700);
				}
				//允许上传的文件格式
				$tp = array("image/gif","image/jpeg","image/png");
				//检查上传文件是否在允许上传的类型
				if(!in_array($_FILES["filename1"]["type"],$tp)){
					alertAndLoading("格式不正确", "success.php");
				}
				if(!in_array($_FILES["filename2"]["type"],$tp)){
					alertAndLoading("格式不正确", "success.php");
				}
				if(!in_array($_FILES["filename3"]["type"],$tp)){
					alertAndLoading("格式不正确", "success.php");
				}
				if(!in_array($_FILES["filename4"]["type"],$tp)){
					alertAndLoading("格式不正确", "success.php");
				}
				if(!in_array($_FILES["describe_pic"]["type"],$tp)){
					alertAndLoading("格式不正确", "success.php");
				}
				if(!in_array($_FILES["top3_pic"]["type"],$tp)){
					alertAndLoading("格式不正确", "success.php");
				}
				if(!in_array($_FILES["product_pic"]["type"],$tp)){
					alertAndLoading("格式不正确", "success.php");
				}
				//将文件名字改为当前路径+上传时间+用户名+原文件名
				if($_FILES["filename1"]["name"]){
					$file1 = $_FILES["filename1"]["name"];
					$able1 = pathinfo($file1)['extension'];
					$file1save = $path.date("Ymdhisa").'1.'.$able1;
					$file1path = $pathsave.date("Ymdhisa").'1.'.$able1;
				}
				if($_FILES["filename2"]["name"]){
					$file2 = $_FILES["filename2"]["name"];
					$able2 = pathinfo($file2)['extension'];
					$file2save = $path.date("Ymdhisa").'2.'.$able2;
					$file2path = $pathsave.date("Ymdhisa").'2.'.$able2;
				}
				if($_FILES["filename3"]["name"]){
					$file3 = $_FILES["filename3"]["name"];
					$able3 = pathinfo($file3)['extension'];
					$file3save = $path.date("Ymdhisa").'3.'.$able3;
					$file3path = $pathsave.date("Ymdhisa").'3.'.$able3;
				}
				if($_FILES["filename4"]["name"]){
					$file4 = $_FILES["filename4"]["name"];
					$able4 = pathinfo($file3)['extension'];
					$file4save = $path.date("Ymdhisa").'4.'.$able4;
					$file4path = $pathsave.date("Ymdhisa").'4.'.$able4;
				}
				if($_FILES["describe_pic"]["name"]){
					$file5 = $_FILES["describe_pic"]["name"];
					$able5 = pathinfo($file1)['extension'];
					$file5save = $path.date("Ymdhisa").'5.'.$able5;
					$file5path = $pathsave.date("Ymdhisa").'5.'.$able5;
				}
				if($_FILES["top3_pic"]["name"]){
					$file6 = $_FILES["top3_pic"]["name"];
					$able6 = pathinfo($file1)['extension'];
					$file6save = $path.date("Ymdhisa").'6.'.$able6;
					$file6path = $pathsave.date("Ymdhisa").'6.'.$able6;
				}
				if($_FILES["product_pic"]["name"]){
					$file7 = $_FILES["product_pic"]["name"];
					$able7 = pathinfo($file1)['extension'];
					$file7save = $path.date("Ymdhisa").'7.'.$able7;
					$file7path = $pathsave.date("Ymdhisa").'7.'.$able7;
				}
				if (!empty($_POST['goodsname'])&&$_POST['category']&&$_POST['type']&& $_POST['price']&&$_POST['brand']
						&&$_POST['function']&&$_POST['described']){
					//特别注意这里传递给move_uploaded_file的第一个参数为上传到服务器上的临时文件
					$result1 = move_uploaded_file($_FILES["filename1"]["tmp_name"],$file1save);
					$result2 = move_uploaded_file($_FILES["filename2"]["tmp_name"],$file2save);
					$result3 = move_uploaded_file($_FILES["filename3"]["tmp_name"],$file3save);
					$result4 = move_uploaded_file($_FILES["filename4"]["tmp_name"],$file4save);
					$result5 = move_uploaded_file($_FILES["describe_pic"]["tmp_name"],$file5save);
					$result6 = move_uploaded_file($_FILES["top3_pic"]["tmp_name"],$file6save);
					$result7 = move_uploaded_file($_FILES["product_pic"]["tmp_name"],$file7save);
					if($result1 && $result2 && $result3 && $result4){
						$database ->insert("goods", [
								"name" => $_POST['goodsname'],
								"type" => $_POST['type'],
								"price" => $_POST['price'],
								"category" => $_POST['category'],
								"brand" => $_POST['brand'],
								"cbrand" => $_POST['cbrand'],
								"function" => $_POST['function'],
								"picture01" => $file1path,
								"picture02" => $file2path,
								"picture03" => $file3path,
								"picture04" => $file4path,
								"described" => $_POST['described'],
								"describe_pic" => $file5path,
								"top3_pic" => $file6path,
								"product_pic" => $file7path,
								"addtime" => date("Y/m/d H:m:s")
						]);
						alertAndLoading("上传成功", "success.php");
					}
				}else {
					alertAndLoading("请输入所有信息", "success.php");
				}
			}
		}
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="ie6 ielt7 ielt8 ielt9"><![endif]--><!--[if IE 7 ]><html lang="en" class="ie7 ielt8 ielt9"><![endif]--><!--[if IE 8 ]><html lang="en" class="ie8 ielt9"><![endif]--><!--[if IE 9 ]><html lang="en" class="ie9"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en"><!--<![endif]--> 
	<head>
		<meta charset="utf-8">
		<title>Rainbow - 添加单品</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="css/site.css" rel="stylesheet">
		<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	</head>
	<body>
		<div class="container">
			<div class="navbar">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <a class="brand" href="#"></a>
						<div class="nav-collapse">
							<form class="navbar-search pull-left" action="">
								<input type="text" class="search-query span2" placeholder="Search" />
							</form>
							<ul class="nav pull-right">
								<li>
									<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <span class="brand" style="font-size:10px;">欢迎您，<span><?php echo $adminName;?></span>&nbsp;</span>
								</li>
								<li>
									<a href="success.php?act=deletecookie">[退出]</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span3">
					<div class="well" style="padding: 8px 0;">
						<ul class="nav nav-list">
							<li class="nav-header">
							</li>
							<li class="active">
								<a href="success.php"><i class="icon-white icon-home"></i> 添加单品</a>
							</li>
							<li>
								<a href="user_manage.php"><i class="icon-folder-open"></i> 用户管理</a>
							</li>
							<li>
								<a href="goods_manage.php"><i class="icon-check"></i> 商品管理</a>
							</li>
							<li>
								<a href="brand_manage.php"><i class="icon-envelope"></i> 品牌管理</a>
							</li>
							<li>
								<a href="category_manage.php"><i class="icon-cog"></i> 分类管理</a>
							</li>
							<li>
								<a href="function_manage.php"><i class="icon-info-sign"></i> 功能管理</a>
							</li>
							<li>
								<a href="activity_manage.php"><i class="icon-list-alt"></i> 活动管理</a>
							</li>
							<li>
								<a href="orders_manage.php"><i class="icon-stop"></i> 订单管理</a>
							</li>
							<li>
								<a href="admin_manage.php"><i class="icon-user"></i> 管理员配备</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="span9">
					<h1>
						添加单品
					</h1>
					<form id="edit-profile" class="form-horizontal" enctype="multipart/form-data" method="post" action="success.php?act=addgoods">
						<hr/>
						<fieldset>
							<div class="control-group">
								<label class="control-label" for="input01">商品名称：</label>
								<div class="controls">
									<input type="text" name="goodsname" class="input-xlarge" id="input01" value="" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">型号：</label>
								<div class="controls">
									<input type="text" name="type" class="input-xlarge" id="input01" value="" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">品牌英文名：</label>
								<div class="controls">
									<input type="text" name="brand" class="input-xlarge" id="input01" value="" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">品牌中文名：</label>
								<div class="controls">
									<input type="text" name="cbrand" class="input-xlarge" id="input01" value="" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">分类：</label>
								<div class="controls">
									<input type="text" name="category" class="input-xlarge" id="input01" value="" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">价格：</label>
								<div class="controls">
									<input type="text" name="price" class="input-xlarge" id="input01" value="" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">功能：</label>
								<div class="controls">
									<input type="text" name="function" class="input-xlarge" id="input01" value="" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">描述：</label>
								<div class="controls">
									<textarea  type="text"  name="described" style="width:500px;height:100px;overflow-x:visible;overflow-y:visible;"></textarea>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">图片描述：</label>
								<div class="controls">
									<input class="input-file" name="describe_pic" id="fileInput" type="file" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">TOP3图片：</label>
								<div class="controls">
									<input class="input-file" name="top3_pic" id="fileInput" type="file" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">商品图片：</label>
								<div class="controls">
									<input class="input-file" name="product_pic" id="fileInput" type="file" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="fileInput">图片上传：</label>
								<div class="controls">
									<input class="input-file" name="filename1" id="fileInput" type="file" />
									<input class="input-file" name="filename2" id="fileInput" type="file" />
									<input class="input-file" name="filename3" id="fileInput" type="file" />
									<input class="input-file" name="filename4" id="fileInput" type="file" />
								</div>
							</div>					
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">添加</button>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/site.js"></script>
	</body>
</html>