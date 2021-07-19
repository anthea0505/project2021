<?php
require_once("auth.php");
session_start();
$loginID = $_SESSION['LoginID'];
$Shop_name = $_SESSION['shop_name'];

require_once("gpsvars.php");
require_once("configure.php");
require_once("db_func.php");
$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
<meta http-equiv="pragma" content="no-cache">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.6">
<link rel="stylesheet" title="MISstyle" type="text/css" />
<link rel="stylesheet" href="cartstyle.css">
<link rel="stylesheet" href="shopstyle.css">
<title>訂單管理</title>
</head>
<body>
<div class="top-message"style="display: inline-block;">
<div style="float:left;">訂單管理</div>
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
<br><br>
</div>
<div class="container">
    <form action="status_change.php" method="get">
		<div class="item_header">
			<div class="item_style">
				<input type="submit" value="製作中" name="statu">
				<input type="submit" value="已出餐" name="statu">
				<input type="submit" value="訂單完成" name="statu">
			</div>
			<div class="item_style">訂單內容</div> 
			<div class="item_style">訂單編號</div>
			<div class="item_style">訂單備註</div>
			<div class="item_style">總計</div>
			<div class="item_style">訂單狀態</div>
		</div>
	
		<?php
		$sqlcmd = "SELECT * FROM order_list WHERE shop_name='$Shop_name' AND od_status!='訂單完成'";
		$rs = querydb($sqlcmd, $db_conn);

		if(count($rs)==0){
			echo "<big><center>尚無訂單</center></big>";
		}
			for ($i=0; $i<count($rs); $i++) {
				$od_total_product = $rs[$i]['od_total_product'];	//訂單內容
				$od_number = $rs[$i]['od_number'];//訂單編號
				$od_memo = $rs[$i]['od_memo'];//訂單備註
				$od_total_price = $rs[$i]['od_total_price'];//總計
				//$payment = $rs[$i]['payment'];//付款方式
				$od_status = $rs[$i]['od_status'];//訂單狀態
				$seqno = $rs[$i]['seqno'];//訂單seqno
		?>
		
		<div class="item_container">
			<div class="item_header item_body">
				<div class="item_style"><input type="checkbox" name="checkbox[]" value=<?php echo $seqno; ?> /></div>
				
				<div class="item_style"><?php echo $od_total_product; ?></div>
							
				<div class="item_style"><?php echo $od_number; ?></div>
							
				<div class="item_style"><?php if(empty($od_memo)) echo '無'; else echo $od_memo; ?></div>
							
				<div class="item_style"><span>$</span><?php echo $od_total_price; ?></div>
							
				<div class="item_style"><?php echo $od_status; ?></div>
			</div>						   
		</div>
		<?php } ?>
		
		
		<?php
		$sqlcmd = "SELECT * FROM order_list WHERE shop_name='$Shop_name' AND od_status='訂單完成'";
		$rs = querydb($sqlcmd, $db_conn);		
		
			for ($i=0; $i<count($rs); $i++) {
				$od_total_product = $rs[$i]['od_total_product'];	//訂單內容
				$od_number = $rs[$i]['od_number'];//訂單編號
				$od_memo = $rs[$i]['od_memo'];//訂單備註
				$od_total_price = $rs[$i]['od_total_price'];//總計
				//$payment = $rs[$i]['payment'];//付款方式
				$od_status = $rs[$i]['od_status'];//訂單狀態
				$seqno = $rs[$i]['seqno'];//訂單seqno
		?>
		
		<div class="item_container">
			<div class="item_header item_body">
				
				<div class="item_style"></div>
				
				<div class="item_style"><?php echo $od_total_product; ?></div>
							
				<div class="item_style"><?php echo $od_number; ?></div>
							
				<div class="item_style"><?php if(empty($od_memo)) echo '無'; else echo $od_memo; ?></div>
							
				<div class="item_style"><span>$</span><?php echo $od_total_price; ?></div>
							
				<div class="item_style"><?php echo $od_status; ?></div>
			</div>						   
		</div>
		<?php } ?>		
		
		
	</form>	
	
</div>
</body>
</html>