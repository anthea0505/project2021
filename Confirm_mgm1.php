<?php
session_start();
$loginID = $_SESSION['LoginID'];
// Authentication 認證
require_once("auth.php");
// 變數及函式處理，請注意其順序
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

if (isset($Confirm)) {   // 確認按鈕
    if (!isset($Pd_name) || empty($Pd_name)) $ErrMsg = '餐點名稱不可為空白\n';
    if (!isset($Pd_price) || empty($Pd_price)) $ErrMsg = '價錢不可為空白\n';

	if (empty($ErrMsg)) {   // 資料經初步檢核沒問題
		
		$_SESSION['LoginID'];

		switch ($_SESSION['LoginID']) 
		{
			case "99bf":
				$sqlcmd="UPDATE product_shop SET pd_name='$Pd_name',pd_category='$Pd_category',pd_price='$Pd_price',shop_name='99早餐店' WHERE seqno='$Seqno'";
				$result = updatedb($sqlcmd, $db_conn);
				header("Location: shop1_shop_management.php");
				break;
			case "yf":
				$sqlcmd="UPDATE product_shop SET pd_name='$Pd_name',pd_category='$Pd_category',pd_price='$Pd_price',shop_name='玉福' WHERE seqno='$Seqno'";
				$result = updatedb($sqlcmd, $db_conn);
				header("Location: shop2_shop_management.php");
				break;
			case "cg":
				$sqlcmd="UPDATE product_shop SET pd_name='$Pd_name',pd_category='$Pd_category',pd_price='$Pd_price',shop_name='茶覺' WHERE seqno='$Seqno'";
				$result = updatedb($sqlcmd, $db_conn);
				header("Location: shop3_shop_management.php");
				break;
			case "curry":
				$sqlcmd="UPDATE product_shop SET pd_name='$Pd_name',pd_category='$Pd_category',pd_price='$Pd_price',shop_name='陳記咖哩鐵板' WHERE seqno='$Seqno'";
				$result = updatedb($sqlcmd, $db_conn);
				header("Location: shop4_shop_management.php");
				break;
			case "8f":
				$sqlcmd="UPDATE product_shop SET pd_name='$Pd_name',pd_category='$Pd_category',pd_price='$Pd_price',shop_name='八方雲集' WHERE seqno='$Seqno'";
				$result = updatedb($sqlcmd, $db_conn);
				header("Location: shop5_shop_management.php");
				break;
			case "Atea":
				$sqlcmd="UPDATE product_shop SET pd_name='$Pd_name',pd_category='$Pd_category',pd_price='$Pd_price',shop_name='喔A茶飲' WHERE seqno='$Seqno'";
				$result = updatedb($sqlcmd, $db_conn);
				header("Location: shop6_shop_management.php");
				break;
			case "b1bf":
				$sqlcmd="UPDATE product_shop SET pd_name='$Pd_name',pd_category='$Pd_category',pd_price='$Pd_price',shop_name='壹而美早餐店' WHERE seqno='$Seqno'";
				$result = updatedb($sqlcmd, $db_conn);
				header("Location: shop7_shop_management.php");
				break;
			case "pasta":
				$sqlcmd="UPDATE product_shop SET pd_name='$Pd_name',pd_category='$Pd_category',pd_price='$Pd_price',shop_name='哈瓦那義大利麵' WHERE seqno='$Seqno'";
				$result = updatedb($sqlcmd, $db_conn);
				header("Location: shop8_shop_management.php");
				break;
			case "rice":
				$sqlcmd="UPDATE product_shop SET pd_name='$Pd_name',pd_category='$Pd_category',pd_price='$Pd_price',shop_name='大野狼小綿羊' WHERE seqno='$Seqno'";
				$result = updatedb($sqlcmd, $db_conn);
				header("Location: shop9_shop_management.php");
				break;
			case "b1lw":
				$sqlcmd="UPDATE product_shop SET pd_name='$Pd_name',pd_category='$Pd_category',pd_price='$Pd_price',shop_name='真元氣滷味' WHERE seqno='$Seqno'";
				$result = updatedb($sqlcmd, $db_conn);
				header("Location: shop10_shop_management.php");
				break;
			case "noodle":
				$sqlcmd="UPDATE product_shop SET pd_name='$Pd_name',pd_category='$Pd_category',pd_price='$Pd_price',shop_name='小食麵' WHERE seqno='$Seqno'";
				$result = updatedb($sqlcmd, $db_conn);
				header("Location: shop11_shop_management.php");
				break;	
		}
		//exit();
	}
}
if (isset($_GET['Abort'])){
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
}
?>