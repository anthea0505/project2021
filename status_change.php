<?php
require_once("auth.php");
require_once("gpsvars.php");
require_once("configure.php");
require_once("db_func.php");
$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);

$check=$_GET['checkbox'];
for ($i=0; $i<count($check); $i++) {
	
	if($_GET['statu']== "訂單完成"){
		$sqlcmd="UPDATE order_list SET od_status='訂單完成' WHERE seqno= $check[$i]";
	}
	else if($_GET['statu']== "已出餐"){
		$sqlcmd="UPDATE order_list SET od_status='已出餐' WHERE seqno= $check[$i]";
	}
	else if($_GET['statu']== "製作中"){
		$sqlcmd="UPDATE order_list SET od_status='製作中' WHERE seqno= $check[$i]";
	}
	$result = updatedb($sqlcmd, $db_conn);
}
//print_r($check);  
//echo $check[0];

header("Location: shop_odlist.php");
?>