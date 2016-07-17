<?php
	require  '../inc/config.php';	//加载数据库配置文件
	require '../inc/loading.php'; //加载跳转页面函数
	
	if (empty($_COOKIE['adminName'])){
		alertAndLoading("请正确登录", "index.php");
	}
	$adminName = base64_decode(base64_decode($_COOKIE['adminName']));
	
	$allactivity = $database -> select("onsale", "*",[
			"ORDER" => "starttime DESC"
	]);
	
	if (!empty($_GET['activityid'])){
		if (!empty($_REQUEST['act'])){
			$act = $_REQUEST['act'];
			if ($act == "endactivity"){
				$database -> update("onsale", [
						"endtime" => date("Y/m/d H:m:s")
				],[
						"id" => $_GET['activityid']
				]);
				alertAndLoading("活动结束成功", "activity_manage.php");
			}
		}
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (!empty($_REQUEST['act'])){
			$act = $_REQUEST['act'];
			if ($act == "addactivity"){
				$activities = $database -> select("onsale", "*",[
						"endtime" => "0000-00-00 00:00:00"
				]);
				if (!empty($activities)){
					alertAndLoading("请先结束当前活动", "activity_manage.php");
				}else {
					$database -> insert("onsale", [
							"name" => $_POST['activityname'],
							"discount" => $_POST['discount'],
							"starttime" => date("Y/m/d H:i:s")
					]);
					alertAndLoading("活动添加成功", "activity_manage.php");
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
		<title>Rainbow - 活动管理</title>
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
							<li>
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
							<li class="active">
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
						添加活动
					</h1>
					<form id="edit-profile" class="form-horizontal" method="post" action="activity_manage.php?act=addactivity">
						<hr/>
						<fieldset>
							<div class="control-group">
								<label class="control-label" for="input01">活动名称：</label>
								<div class="controls">
									<input type="text" class="input-xlarge" name="activityname" id="input01" value="" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">折扣：</label>
								<div class="controls">
									<input type="text" class="input-xlarge" name="discount" id="input01" value="" />
								</div>
							</div>
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">添加</button>
							</div>
						</fieldset>
					</form>
					<h1>
						活动管理
					</h1>
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>
									活动名称
								</th>
								<th>
									折扣
								</th>
								<th>
									开始时间
								</th>
								<th>
									结束时间
								</th>
								<th>
									操作
								</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							if (!empty($allactivity)){
								foreach ($allactivity as $activity){
									echo '<tr>
											<td>
												'.$activity['name'].'
											</td>
											<td>
												'.$activity['discount'].'
											</td>
											<td>
												'.$activity['starttime'].'
											</td>
											<td>
												'.$activity['endtime'].'
											</td>
											<td>
			                                    <a href="activity_manage.php?act=endactivity&activityid='.$activity['id'].'">结束活动</a>
											</td>
										</tr>';
								}
							}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/site.js"></script>
	</body>
</html>
