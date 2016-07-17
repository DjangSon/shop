<?php
	require  '../inc/config.php';	//加载数据库配置文件
	require '../inc/loading.php'; //加载跳转页面函数
	
	if (empty($_COOKIE['adminName'])){
		alertAndLoading("请正确登录", "index.php");
	}
	$adminName = base64_decode(base64_decode($_COOKIE['adminName']));
	
	$allgoods = $database -> select("goods", "*");
	
	if (!empty($_GET['goodsid'])){
		if (!empty($_REQUEST['act'])){
			$act = $_REQUEST['act'];
			if ($act == "deletegoods"){
				$database -> delete("goods", [
						"id" => $_GET['goodsid']
				]);
				alertAndLoading("商品删除成功", "goods_manage.php");
			}elseif ($act == "addcrazy"){
				$database -> update("goods", [
						"crazy" => 1
				],[
						"id" => $_GET['goodsid']
				]);
				alertAndLoading("加入今日疯抢成功", "goods_manage.php");
			}elseif ($act == "deletecrazy"){
				$database -> update("goods", [
						"crazy" => 0
				],[
						"id" => $_GET['goodsid']
				]);
				alertAndLoading("删除今日疯抢成功", "goods_manage.php");
			}elseif ($act == "addtop3"){
				$alltop3 = $database -> select("goods", "*",[
						"top3" => 1
				]);
				
				if (!empty($alltop3)){
					$flagtop3 = 0;
					foreach ($alltop3 as $gettop3){
						$flagtop3++;
					}
				}
				if ($flagtop3==3){
					alertAndLoading("TOP3已满", "goods_manage.php");
				}else {
					$database -> update("goods", [
							"top3" => 1
					],[
							"id" => $_GET['goodsid']
					]);
					alertAndLoading("加入TOP3成功", "goods_manage.php");
				}
			}elseif ($act == "deletetop3"){
				$database -> update("goods", [
						"top3" => 0
				],[
						"id" => $_GET['goodsid']
				]);
				alertAndLoading("删除TOP3成功", "goods_manage.php");
			}
		}
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="ie6 ielt7 ielt8 ielt9"><![endif]--><!--[if IE 7 ]><html lang="en" class="ie7 ielt8 ielt9"><![endif]--><!--[if IE 8 ]><html lang="en" class="ie8 ielt9"><![endif]--><!--[if IE 9 ]><html lang="en" class="ie9"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en"><!--<![endif]--> 
	<head>
		<meta charset="utf-8">
		<title>Rainbow - 商品管理</title>
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
							<li  class="active">
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
						商品管理
					</h1>
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="text-align: center;">
									商品名
								</th>
								<th style="text-align: center;">
									价格
								</th>
								<th style="text-align: center;">
									操作
								</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							if (!empty($allgoods)){
								foreach ($allgoods as $goods){
									if ($goods['crazy']==0){
										$crazy = 'addcrazy&goodsid='.$goods['id'].'">加入今日疯抢';
									}elseif($goods['crazy']==1){
										$crazy = 'deletecrazy&goodsid='.$goods['id'].'">删除今日疯抢';
									}
									if ($goods['top3']==0){
										$top3 = 'addtop3&goodsid='.$goods['id'].'">加入TOP3';
									}elseif($goods['top3']==1){
										$top3 = 'deletetop3&goodsid='.$goods['id'].'">删除TOP3';
									}
									echo '<tr>
											<td style="text-align: center;"><a href="../product.php?goodsid='.$goods['id'].'">
												'.$goods['name'].'</a>
											</td>
											<td style="text-align: center;">
												'.$goods['price'].'
											</td>
											<td style="text-align: center;">
												<a style="padding-right:20px;" href="goods_manage.php?act='.$crazy.'</a>
												<a style="padding-right:20px;" href="goods_manage.php?act='.$top3.'</a>
			                                    <a href="goods_manage.php?act=deletegoods&goodsid='.$goods['id'].'">删除</a>
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
