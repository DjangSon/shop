<?php
	require  '../inc/config.php';	//加载数据库配置文件
	require '../inc/loading.php'; //加载跳转页面函数
	
	if (empty($_COOKIE['adminName'])){
		alertAndLoading("请正确登录", "index.php");
	}
	$adminName = base64_decode(base64_decode($_COOKIE['adminName']));
	
	$allorders = $database -> select("orders", "*");
	
	if (!empty($allorders)){
		$flag = 0;
		foreach ($allorders as $orders){
			$receiver[$flag] = $orders['receiver'];
			$piece[$flag] = $orders['piece'];
			$goods_id[$flag] = $orders['goods_id'];
			$ordersid[$flag] = $orders['orderid'];
			$flag++;
		}
	}
	
	if (!empty($_GET['ordersid'])){
		if (!empty($_REQUEST['act'])){
			$act = $_REQUEST['act'];
			if ($act == "deleteorders"){
				$database -> delete("orders", [
						"orderid" => $_GET['ordersid']
				]);
				alertAndLoading("已删除订单", "orders_manage.php");
			}elseif ($act == "giveorders"){
				$database -> update("orders", [
						"pay" => 1
				],[
						"orderid" => $_GET['ordersid']
				]);
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
							<li  class="active">
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
						订单管理
					</h1>
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="text-align: center;">
									收货人
								</th>
								<th style="text-align: center;">
									手机号
								</th>
								<th style="text-align: center;">
									收货地址
								</th>
								<th style="text-align: center;">
									购买商品
								</th>
								<th style="text-align: center;">
									操作
								</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							if (!empty($allorders)){
								$tag = 0;
								for ($i=0;$i<$flag;$i+=$piece[$i]){
									$allreceivermes = $database -> select("address", "*",[
											"recivename" => $receiver[$i]
									]);
									foreach ($allreceivermes as $receivemes){
										$phone = $receivemes['mobile'];
										$address = $receivemes['address'];
									}

									
									echo '<tr>
											<td style="text-align: center;">
												'.$receiver[$i].'
											</td>
											<td style="text-align: center;">
												'.$phone.'
											</td>
											<td style="text-align: center;">
												'.$address.'
											</td>
											<td style="text-align: center;">
												';
									for ($j=0;$j<$piece[$i] ;$j++){
										echo $goods_id[$tag]." ";
										$tag++;
									}
												echo '
											</td>
											<td style="text-align: center;">
												<a style="margin-right: 20px;" href="orders_manage.php?act=giveorders&ordersid='.$ordersid[$i].'">发货</a>
												<a href="orders_manage.php?act=deleteorders&ordersid='.$ordersid[$i].'">删除</a>
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
