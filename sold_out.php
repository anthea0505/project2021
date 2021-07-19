<?php
session_start();
require_once("auth.php");
require_once("gpsvars.php");
require_once("configure.php");
require_once("db_func.php");
$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);

$Seqno = $_GET['Seqno'];
$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno'";
$rs = querydb($sqlcmd, $db_conn);

$Sold_status = $rs[0]['sold_out'];

$New_Sold_status = Y;

if (count($rs) <= 0) die("找不到編號為 $seqno 之資料 ");

if($Sold_status == N)
{
	$sqlcmd="UPDATE product_shop SET sold_out='$New_Sold_status' WHERE seqno='$Seqno'";
	$result = updatedb($sqlcmd, $db_conn);
	
}

$_SESSION['LoginID'];

switch ($_SESSION['LoginID']) 
{
	case "99bf":
		$shop_pos = "shop1_shop_management.php";
		break;
	case "yf":
		$shop_pos = "shop2_shop_management.php";
		break;
	case "cg":
		$shop_pos = "shop3_shop_management.php";
		break;
	case "curry":
		$shop_pos = "shop4_shop_management.php";
		break;
	case "8f":
		$shop_pos = "shop5_shop_management.php";
		break;
	case "Atea":
		$shop_pos = "shop6_shop_management.php";
		break;
	case "b1bf":
		$shop_pos = "shop7_shop_management.php";
		break;
	case "pasta":
		$shop_pos = "shop8_shop_management.php";
		break;
	case "rice":
		$shop_pos = "shop9_shop_management.php";
		break;
	case "b1lw":
		$shop_pos = "shop10_shop_management.php";
		break;
	case "noodle":
		$shop_pos = "shop10_shop_management.php";
		break;		
}
header("Location: $shop_pos");

?>