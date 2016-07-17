<?php
	require  'medoo.php';	//调用medoo框架
	
	//
	//----------以下配置Mysql数据库----------
	//
	$database = new medoo([
			// Mysql配置
			'database_type' => 'mysql',	//数据库格式
			'database_name' => 'shop',	//数据库名
			'server' => '127.0.0.1',	//数据库ip
			'username' => 'shop',		//数据库用户
			'password' => 'shop...',	//数据库密码
			'charset' => 'utf8',		//数据库编码
	]);
?>