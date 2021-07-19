<?php
session_start();
require_once("auth.php");
require_once("gpsvars.php");
require_once("configure.php");
require_once("db_func.php");
$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
$Seqno = $_GET['Seqno'];

$_SESSION['LoginID'];

switch ($_SESSION['LoginID']) 
{
	case "99bf":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='99早餐店'";
		$rs = querydb($sqlcmd, $db_conn);
		break;
	case "yf":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='玉福'";
		$rs = querydb($sqlcmd, $db_conn);
		break;
	case "cg":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='茶覺'";
		$rs = querydb($sqlcmd, $db_conn);
		break;
	case "curry":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='陳記咖哩鐵板'";
		$rs = querydb($sqlcmd, $db_conn);
		break;
	case "8f":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='八方雲集'";
		$rs = querydb($sqlcmd, $db_conn);
		break;
	case "Atea":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='喔A茶飲'";
		$rs = querydb($sqlcmd, $db_conn);
		break;
	case "b1bf":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='壹而美早餐店'";
		$rs = querydb($sqlcmd, $db_conn);
		break;
	case "pasta":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='哈瓦那義大利麵'";
		$rs = querydb($sqlcmd, $db_conn);
		break;
	case "rice":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='大野狼小綿羊'";
		$rs = querydb($sqlcmd, $db_conn);
		break;
	case "b1lw":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='真元氣滷味'";
		$rs = querydb($sqlcmd, $db_conn);
		break;
	case "noodle":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='小食麵'";
		$rs = querydb($sqlcmd, $db_conn);
		break;		
}

if (count($rs) <= 0) die("找不到編號為 $seqno 之資料 ");
else
{
	$_SESSION['LoginID'];
	switch ($_SESSION['LoginID']) 
	{
		case "99bf":
			$sqlcmd="delete from product_shop WHERE seqno='$Seqno'";
			$result = updatedb($sqlcmd, $db_conn);
			header("Location: shop1_shop_management.php");
			break;
		case "yf":
			$sqlcmd="delete from product_shop WHERE seqno='$Seqno'";
			$result = updatedb($sqlcmd, $db_conn);
			header("Location: shop2_shop_management.php");
			break;
		case "cg":
			$sqlcmd="delete from product_shop WHERE seqno='$Seqno'";
			$result = updatedb($sqlcmd, $db_conn);
			header("Location: shop3_shop_management.php");
			break;
		case "curry":
			$sqlcmd="delete from product_shop WHERE seqno='$Seqno'";
			$result = updatedb($sqlcmd, $db_conn);
			header("Location: shop4_shop_management.php");
			break;
		case "8f":
			$sqlcmd="delete from product_shop WHERE seqno='$Seqno'";
			$result = updatedb($sqlcmd, $db_conn);
			header("Location: shop5_shop_management.php");
			break;
		case "Atea":
			$sqlcmd="delete from product_shop WHERE seqno='$Seqno'";
			$result = updatedb($sqlcmd, $db_conn);
			header("Location: shop6_shop_management.php");
			break;
		case "b1bf":
			$sqlcmd="delete from product_shop WHERE seqno='$Seqno'";
			$result = updatedb($sqlcmd, $db_conn);
			header("Location: shop7_shop_management.php");
			break;
		case "pasta":
			$sqlcmd="delete from product_shop WHERE seqno='$Seqno'";
			$result = updatedb($sqlcmd, $db_conn);
			header("Location: shop8_shop_management.php");
			break;
		case "rice":
			$sqlcmd="delete from product_shop WHERE seqno='$Seqno'";
			$result = updatedb($sqlcmd, $db_conn);
			header("Location: shop9_shop_management.php");
			break;
		case "b1lw":
			$sqlcmd="delete from product_shop WHERE seqno='$Seqno'";
			$result = updatedb($sqlcmd, $db_conn);
			header("Location: shop10_shop_management.php");
			break;
		case "noodle":
			$sqlcmd="delete from product_shop WHERE seqno='$Seqno'";
			$result = updatedb($sqlcmd, $db_conn);
			header("Location: shop11_shop_management.php");
			break;	
	}
}
			?>

