<?php
	require  '../inc/config.php';	//加载数据库配置文件
	require '../inc/loading.php'; //加载跳转页面函数
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (!empty($_REQUEST['act'])){
			$act = $_REQUEST['act'];
			if ($act == "login"){
				$login = $database -> select("admin", "*",[
						"adminName" => $_POST['adminName']
				]);
				if (!empty($login)){
					foreach ($login as $getpwd){
						$password = $getpwd['password'];
					}
					if (md5($_POST['password'])==$password){
						setcookie('adminName',base64_encode(base64_encode($_POST['adminName'])),time()+3600,'/');
						loading("success.php");
					}else {
						alertAndLoading("密码错误，请正确输入", "index.php");
					}
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
		<title>Login - 登录</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="css/site.css" rel="stylesheet">
		<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	</head>
	<body>
		<div id="login-page" class="container">
			<h1>后台登录</h1>
		<form id="login-form" class="well" action="index.php?act=login" method="post">
			<input type="text" class="span2" placeholder="请输入账号" name="adminName"/><br />
			<input type="password" class="span2" placeholder="请输入密码" name="password"/><br />
			<button type="submit" class="btn btn-primary">登录</button>
		</form>	
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/site.js"></script>
	</body>
</html>