<?php
	require './inc/config.php';
	require './inc/loading.php';
	$arr=range(1000,5000);
	shuffle($arr);
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (!empty($_REQUEST['act'])){
			$act = $_REQUEST['act'];
			if ($act == "sales"){
				$flag = 36;
				foreach($arr as $values){
					$arr=range(1000,5000);
					shuffle($arr);
					$database -> update("goods", [
							"sales" => $values
					],[
							"id" => $flag
					]);
					$flag++;
				}
				alertAndLoading("销量生成成功", "test.php");
			}
		}
	}
?>
<form method="post" action="test.php?act=sales"><button type="submit">生成销量</button></form>