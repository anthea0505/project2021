<?php
session_start();
$loginID = $_SESSION['LoginID'];
$Name = $_SESSION['name'];
$A = $_SESSION['A'];
// Authentication 認證
require_once("auth.php");

// 變數及函式處理，請注意其順序
require_once("gpsvars.php");
require_once("configure.php");
require_once("db_func.php");
$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);

$Seqno = $_GET['Seqno']; 
$shop_name = $_GET['shop_name'];

switch($shop_name){
	case "99早餐店":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='99早餐店'";
		$shop_pos = "shop1.php";
		break;
	case "玉福":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='玉福'";
		$shop_pos = "shop2.php";
		break;
	case "茶覺":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='茶覺'";
		$shop_pos = "shop3.php";
		break;
	case "陳記咖哩鐵板":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='陳記咖哩鐵板'";
		$shop_pos = "shop4.php";
		break;		
	case "八方雲集":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='八方雲集'";
		$shop_pos = "shop5.php";
		break;
	case "喔A茶飲":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='喔A茶飲'";
		$shop_pos = "shop6.php";
		break;
	case "壹而美早餐店":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='壹而美早餐店'";
		$shop_pos = "shop7.php";
		break;
	case "哈瓦那義大利麵":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='哈瓦那義大利麵'";
		$shop_pos = "shop8.php";
		break;
	case "大野狼小綿羊":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='大野狼小綿羊'";
		$shop_pos = "shop9.php";
		break;
	case "真元氣滷味":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='真元氣滷味'";
		$shop_pos = "shop10.php";
		break;
	case "小食麵":
		$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno' AND shop_name='小食麵'";
		$shop_pos = "shop11.php";
		break;	
}
$rs = querydb($sqlcmd, $db_conn);

$pd_name = $rs[0]['pd_name'];
$pd_price = $rs[0]['pd_price'];
$sold_out = $rs[0]['sold_out'];

if($A=='customer'&&$sold_out=='N')
{
	
	//新增數量
	$sqlcmd = "SELECT * FROM cart WHERE name='$Name' AND pd_name='$pd_name'";
	$rs = querydb($sqlcmd, $db_conn);
	if($rs){
		$Pd_number = $rs[0]['pd_number'];
		$Pd_number += 1;
		$sqlcmd="UPDATE cart SET pd_number='$Pd_number' WHERE name='$Name' AND pd_name='$pd_name'";
		$result = updatedb($sqlcmd, $db_conn);
		header("Location: $shop_pos");
	}
	else{
		$sqlcmd="INSERT INTO cart (name,shop_name,pd_name,pd_price) VALUES "
		. "('$Name','$shop_name','$pd_name','$pd_price')";
		$result = updatedb($sqlcmd, $db_conn); 
		header("Location: $shop_pos");
	}
	
}
else if($A!='customer')
{
	echo "<script>alert('店家帳號無此功能'); history.back();</script>";
}
else if($sold_out!='N')
{
	echo "<script>alert('餐點已售完'); history.back();</script>";
}
?>


