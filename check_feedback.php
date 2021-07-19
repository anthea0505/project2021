<?php
// Authentication 認證
require_once("auth.php");
session_start();
$loginID=$_SESSION['LoginID'];
$A = $_SESSION['A'];
// 變數及函式處理，請注意其順序
require_once("gpsvars.php");
require_once("configure.php");
require_once("db_func.php");

$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
$sqlcmd = "SELECT * FROM shop WHERE loginid='$LoginID' AND valid='Y'";
$rs = querydb($sqlcmd, $db_conn);
if (count($rs) <= 0) die ('Unknown or invalid user!');

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
<meta http-equiv="pragma" content="no-cache">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.6">
<link rel="stylesheet" title="MISstyle" type="text/css" />
<link rel="stylesheet" href="fbstyle.css">
<link rel="stylesheet" href="style.css">
<title>查看顧客回饋</title>
</head>
<body style="color:black;"bgcolor="B3D8C8"onload="setFocus()">
<div class="top-message"style="display: inline-block;">
<div style="float:left;">查看顧客回饋</div>
<ul class="drop-down-menu-top"style="float:right;">
	<?php if($A=="shop"|| empty($_SESSION['A'])){ ?>
		<li>
		<a href="#">
			<?php
				if(isset($_SESSION['LoginID']) || !empty($_SESSION['LoginID'])){
					echo"Hello, ";
					echo $_SESSION['LoginID'];
				}
				else
					echo"我是店家";
			?></a>
		</li>	
		<?php
			if(!isset($_SESSION['LoginID']) || empty($_SESSION['LoginID'])){
		?>
		<li>
			<a href="login_shop.php">店家登入</a>
		</li>
		<?php } ?>
		<li>
			<a href="shop_shop_add.php">新增餐點</a>
		</li>
		<?php
		$_SESSION['LoginID'];
		switch ($_SESSION['LoginID']) 
		{
			case "99bf":?>
				<li><a href="shop1_shop_management.php">店家管理</a></li>
		<?php	break;
			case "yf":?>
				<li><a href="shop2_shop_management.php">店家管理</a></li>
		<?php	break;
			case "cg":?>
				<li><a href="shop3_shop_management.php">店家管理</a></li>
		<?php	break;
			case "curry":?>
				<li><a href="shop4_shop_management.php">店家管理</a></li>
		<?php	break;
			case "8f":?>
				<li><a href="shop5_shop_management.php">店家管理</a></li>
		<?php	break;
			case "Atea":?>
				<li><a href="shop6_shop_management.php">店家管理</a></li>
		<?php	break;
			case "b1bf":?>
				<li><a href="shop7_shop_management.php">店家管理</a></li>
		<?php	break;
			case "pasta":?>
				<li><a href="shop8_shop_management.php">店家管理</a></li>
		<?php	break;
			case "rice":?>
				<li><a href="shop9_shop_management.php">店家管理</a></li>
		<?php	break;
			case "b1lw":?>
				<li><a href="shop10_shop_management.php">店家管理</a></li>
		<?php	break;
			case "noodle":?>
				<li><a href="shop11_shop_management.php">店家管理</a></li>
		<?php	break;		
		}?>
		<li>
			<a href="shop_odlist.php">訂單管理</a>
		</li>
	<?php } ?>
	</li>
	<?php
	$_SESSION['LoginID'];
	switch ($_SESSION['LoginID']) 
	{
		case "99bf":?>
			<li><a href="shop1.php">店家頁面</a></li>
	<?php	break;
		case "yf":?>
			<li><a href="shop2.php">店家頁面</a></li>
	<?php	break;
		case "cg":?>
			<li><a href="shop3.php">店家頁面</a></li>
	<?php	break;
		case "curry":?>
			<li><a href="shop4.php">店家頁面</a></li>
	<?php	break;
		case "8f":?>
			<li><a href="shop5.php">店家頁面</a></li>
	<?php	break;
		case "Atea":?>
			<li><a href="shop6.php">店家頁面</a></li>
	<?php	break;
		case "b1bf":?>
			<li><a href="shop7.php">店家頁面</a></li>
	<?php	break;
		case "pasta":?>
			<li><a href="shop8.php">店家頁面</a></li>
	<?php	break;
		case "rice":?>
			<li><a href="shop9.php">店家頁面</a></li>
	<?php	break;
		case "b1lw":?>
			<li><a href="shop10.php">店家頁面</a></li>
	<?php	break;
		case "noodle":?>
			<li><a href="shop11.php">店家頁面</a></li>
	<?php	break;		
	}?>
	<li>
		<a href="check_feedback.php">查看回饋</a>
	</li>
	<li>
		<a href="index.php">回首頁</a>
	</li>
	<?php
		if(isset($_SESSION['LoginID']) || !empty($_SESSION['LoginID'])){
	?>
	<li>
		<a href="logout_shop.php">店家登出</a>
	</li>
	<?php } ?>
</ul>
</div>
<br><br><br><br>
<div class="container">
<div class="item_header">
    <div class="item_style">顧客姓名</div> 
	<div class="item_style">留言日期</div>
	<div class="item_style">留言時間</div>
	<div class="item_style">留言內容</div>
</div>
		
	<?php
	$_SESSION['LoginID'];

	switch ($_SESSION['LoginID']) 
	{
		case "99bf":
			$sqlcmd = "SELECT * FROM cus_feedback WHERE shop_name='99早餐店' ";
			$r = querydb($sqlcmd, $db_conn);
			break;
		case "yf":
			$sqlcmd = "SELECT * FROM cus_feedback WHERE shop_name='玉福' ";
			$r = querydb($sqlcmd, $db_conn);
			break;
		case "cg":
			$sqlcmd = "SELECT * FROM cus_feedback WHERE shop_name='茶覺' ";
			$r = querydb($sqlcmd, $db_conn);
			break;
		case "curry":
			$sqlcmd = "SELECT * FROM cus_feedback WHERE shop_name='陳記咖哩鐵板' ";
			$r = querydb($sqlcmd, $db_conn);
			break;
		case "8f":
			$sqlcmd = "SELECT * FROM cus_feedback WHERE shop_name='八方雲集' ";
			$r = querydb($sqlcmd, $db_conn);
			break;
		case "Atea":
			$sqlcmd = "SELECT * FROM cus_feedback WHERE shop_name='喔A茶飲' ";
			$r = querydb($sqlcmd, $db_conn);
			break;
		case "b1bf":
			$sqlcmd = "SELECT * FROM cus_feedback WHERE shop_name='壹而美早餐店' ";
			$r = querydb($sqlcmd, $db_conn);
			break;
		case "pasta":
			$sqlcmd = "SELECT * FROM cus_feedback WHERE shop_name='哈瓦那義大利麵' ";
			$r = querydb($sqlcmd, $db_conn);
			break;
		case "rice":
			$sqlcmd = "SELECT * FROM cus_feedback WHERE shop_name='大野狼小綿羊' ";
			$r = querydb($sqlcmd, $db_conn);
			break;
		case "b1lw":
			$sqlcmd = "SELECT * FROM cus_feedback WHERE shop_name='真元氣滷味' ";
			$r = querydb($sqlcmd, $db_conn);
			break;
		case "noodle":
			$sqlcmd = "SELECT * FROM cus_feedback WHERE shop_name='小食麵' ";
			$r = querydb($sqlcmd, $db_conn);
			break;		
	} 
	

	for ($i=0; $i<count($r); $i++) {
		$name = $r[$i]['name'];	//顧客系名
		$f_date = $r[$i]['f_date'];//留言日期
		$f_time = $r[$i]['f_time'];//留言時間
		$content = $r[$i]['content'];//留言內容
	?>
	
    <div class="item_container">
        <div class="item_header item_body">
            <div class="item_style"><?php echo $name; ?></div>
						
			<div class="item_style"><?php echo $f_date; ?></div>
			
			<div class="item_style"><?php echo $f_time; ?></div>
						
			<div class="item_style"><?php echo $content; ?></div>
                        
        </div>
    </div>
	<?php } ?>
</div>
</body>
</html>