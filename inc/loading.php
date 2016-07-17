<?php
function alertAndLoading($mes ,$url){
	echo "<script>alert('{$mes}');</script>";
	echo "<script>window.location = '{$url}'</script>";
}
function loading($url){
	echo "<script>window.location = '{$url}'</script>";
}
