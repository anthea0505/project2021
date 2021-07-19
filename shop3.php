<?php
// Authentication 認證
//require_once("auth.php");
session_start();
$loginID = $_SESSION['LoginID'];
$A = $_SESSION['A'];
// 變數及函式處理，請注意其順序
require_once("gpsvars.php");
require_once("configure.php");
require_once("db_func.php");
$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
$shop_name = '茶覺';
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF8">
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
<meta http-equiv="pragma" content="no-cache">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.6">
<link rel="stylesheet" href="shopstyle.css">
<title>茶覺</title>
</head>
<body style="color:black;"bgcolor="#D7C4BB"onload="setFocus()">

<style>
.grid-container{
	display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
	width:100%;
}
.grid-item{
	text-align:left;
	padding: 20px;
}
</style>
<div class="top-message"style="display: inline-block;">
<div style="float:left;">校園線上點餐系統-茶覺</div>
<ul class="drop-down-menu-top"style="float:right;">
	<?php if($A=="customer" || empty($_SESSION['A'])){ ?>
	<li>	
		<a href="#">
		<?php
			if(isset($_SESSION['LoginID']) || !empty($_SESSION['LoginID'])){
					echo"Hello, ";
					echo $_SESSION['LoginID'];
				}
				else
					echo"顧客專區";
			?></a>
		<ul>
		<?php
			if(!isset($_SESSION['LoginID']) || empty($_SESSION['LoginID'])){
		?>
		<li>
			<a href="login.php">會員登入</a>
		</li>
		<?php } ?>	
		</ul>
	</li>	
	<?php
		if(isset($_SESSION['LoginID']) || !empty($_SESSION['LoginID'])){
	?>
	<li>
		<a href="modify.php">修改資料</a>
	</li>
	<li>
		<a href="cus_odlist.php">查看訂單</a>
	</li>
	<li>
		<a href="feedback.php">顧客回饋</a>
	</li>
	<?php if($A=="customer"){ ?>
	<li>
		<a href="cart.php">購物車</a>
	</li>
	<?php } ?>
	<li>
		<a href="logout.php">會員登出</a>
	</li>
	<?php } ?>	
	<?php } ?>
	<?php if($A=="shop"|| empty($_SESSION['A'])){ ?>
	<li>
		<a href="#">
		<?php
			if(isset($_SESSION['LoginID']) || !empty($_SESSION['LoginID'])){
					echo"Hello, ";
					echo $_SESSION['LoginID'];
				}
				else
					echo"店家專區";
		?></a>
		<ul>
		<?php
			if(!isset($_SESSION['LoginID']) || empty($_SESSION['LoginID'])){
		?>
		<li>
			<a href="login_shop.php">會員登入</a>
		</li>
		<?php } ?>
		</ul>
	</li>
	<?php
		if(isset($_SESSION['LoginID']) || !empty($_SESSION['LoginID'])){
	?>
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
	<li>
		<a href="check_feedback.php">查看回饋</a>
	</li>
	<li>
		<a href="logout_shop.php">店家登出</a>
	</li>
	<?php } ?>
	<?php } ?>	
	<li>
		<a href="index.php">回首頁</a>
	</li>
</ul>
</div>
<div style="text-align:center;margin-top:30px;">
	<div style="width:90%;height:4500px;margin:40px auto;background:white;font-size:25px;font-weight:bold;float:center;">
		<div style="text-align:left;">
			<h3>&nbsp;&nbsp;&nbsp;<font color="#EB7A77">特選茶品</font></h3>
			<div class="grid-container" style="font-size:20px;font-weight:bold;">
			<?php 
				$sqlcmd = "SELECT * FROM product_shop WHERE shop_name LIKE '茶覺' AND pd_category LIKE '特選茶品'";
				$rs = querydb($sqlcmd, $db_conn);
				for ($i=0; $i<count($rs); $i++) {
			?>
			<?php 
				$Pd_name = $rs[$i]['pd_name'];
				$Pd_price = $rs[$i]['pd_price'];
				$Pd_category = $rs[$i]['pd_category'];
				$Seqno = $rs[$i]['seqno'];
			?>
			<div class="grid-item">
			餐點名稱: <?php echo $Pd_name; ?><br>
			餐點價錢: <?php echo $Pd_price ?>元<br>
				<form id="form2" name="form2" method="get" action="Confirm.php">
					<input type="hidden" name="Seqno" value="<?php echo $Seqno ?>">
					<input type="hidden" name="shop_name" value="<?php echo $shop_name ?>">
					<input type="submit" name="Confirm" value="加進購物車"style="color:#F0F0F0;font-size:20px;width:120px;height:30px;border:2px blue none;background-color:#272727">
				</form>
			</div>
			<?php }?>
			</div>
			
			<h3>&nbsp;&nbsp;&nbsp;<font color="#EB7A77">消暑飲</font></h3>
			<div class="grid-container" style="font-size:20px;font-weight:bold;">
			<?php 
				$sqlcmd = "SELECT * FROM product_shop WHERE shop_name LIKE '茶覺' AND pd_category LIKE '消暑飲'";
				$rs = querydb($sqlcmd, $db_conn);
				for ($i=0; $i<count($rs); $i++) {
			?>
			<?php 
				$Pd_name = $rs[$i]['pd_name'];
				$Pd_price = $rs[$i]['pd_price'];
				$Pd_category = $rs[$i]['pd_category'];
				$Seqno = $rs[$i]['seqno'];
			?>
			<div class="grid-item">
			餐點名稱: <?php echo $Pd_name; ?><br>
			餐點價錢: <?php echo $Pd_price ?>元<br>
				<form id="form2" name="form2" method="get" action="Confirm.php">
					<input type="hidden" name="Seqno" value="<?php echo $Seqno ?>">
					<input type="hidden" name="shop_name" value="<?php echo $shop_name ?>">
					<input type="submit" name="Confirm" value="加進購物車"style="color:#F0F0F0;font-size:20px;width:120px;height:30px;border:2px blue none;background-color:#272727">
				</form>
			</div>
			<?php }?>
			</div>
			
			<h3>&nbsp;&nbsp;&nbsp;<font color="#EB7A77">醇咖啡</font></h3>
			<div class="grid-container" style="font-size:20px;font-weight:bold;">
			<?php 
				$sqlcmd = "SELECT * FROM product_shop WHERE shop_name LIKE '茶覺' AND pd_category LIKE '醇咖啡'";
				$rs = querydb($sqlcmd, $db_conn);
				for ($i=0; $i<count($rs); $i++) {
			?>
			<?php 
				$Pd_name = $rs[$i]['pd_name'];
				$Pd_price = $rs[$i]['pd_price'];
				$Pd_category = $rs[$i]['pd_category'];
				$Seqno = $rs[$i]['seqno'];
			?>
			<div class="grid-item">
			餐點名稱: <?php echo $Pd_name; ?><br>
			餐點價錢: <?php echo $Pd_price ?>元<br>
				<form id="form2" name="form2" method="get" action="Confirm.php">
					<input type="hidden" name="Seqno" value="<?php echo $Seqno ?>">
					<input type="hidden" name="shop_name" value="<?php echo $shop_name ?>">
					<input type="submit" name="Confirm" value="加進購物車"style="color:#F0F0F0;font-size:20px;width:120px;height:30px;border:2px blue none;background-color:#272727">
				</form>
			</div>
			<?php }?>
			</div>
			
			<h3>&nbsp;&nbsp;&nbsp;<font color="#EB7A77">特調茶類</font></h3>
			<div class="grid-container" style="font-size:20px;font-weight:bold;">
			<?php 
				$sqlcmd = "SELECT * FROM product_shop WHERE shop_name LIKE '茶覺' AND pd_category LIKE '特調茶類'";
				$rs = querydb($sqlcmd, $db_conn);
				for ($i=0; $i<count($rs); $i++) {
			?>
			<?php 
				$Pd_name = $rs[$i]['pd_name'];
				$Pd_price = $rs[$i]['pd_price'];
				$Pd_category = $rs[$i]['pd_category'];
				$Seqno = $rs[$i]['seqno'];
			?>
			<div class="grid-item">
			餐點名稱: <?php echo $Pd_name; ?><br>
			餐點價錢: <?php echo $Pd_price ?>元<br>
				<form id="form2" name="form2" method="get" action="Confirm.php">
					<input type="hidden" name="Seqno" value="<?php echo $Seqno ?>">
					<input type="hidden" name="shop_name" value="<?php echo $shop_name ?>">
					<input type="submit" name="Confirm" value="加進購物車"style="color:#F0F0F0;font-size:20px;width:120px;height:30px;border:2px blue none;background-color:#272727">
				</form>
			</div>
			<?php }?>
			</div>
			
			<h3>&nbsp;&nbsp;&nbsp;<font color="#EB7A77">流行茶飲</font></h3>
			<div class="grid-container" style="font-size:20px;font-weight:bold;">
			<?php 
				$sqlcmd = "SELECT * FROM product_shop WHERE shop_name LIKE '茶覺' AND pd_category LIKE '流行茶飲'";
				$rs = querydb($sqlcmd, $db_conn);
				for ($i=0; $i<count($rs); $i++) {
			?>
			<?php 
				$Pd_name = $rs[$i]['pd_name'];
				$Pd_price = $rs[$i]['pd_price'];
				$Pd_category = $rs[$i]['pd_category'];
				$Seqno = $rs[$i]['seqno'];
			?>
			<div class="grid-item">
			餐點名稱: <?php echo $Pd_name; ?><br>
			餐點價錢: <?php echo $Pd_price ?>元<br>
				<form id="form2" name="form2" method="get" action="Confirm.php">
					<input type="hidden" name="Seqno" value="<?php echo $Seqno ?>">
					<input type="hidden" name="shop_name" value="<?php echo $shop_name ?>">
					<input type="submit" name="Confirm" value="加進購物車"style="color:#F0F0F0;font-size:20px;width:120px;height:30px;border:2px blue none;background-color:#272727">
				</form>
			</div>
			<?php }?>
			</div>
			
			<h3>&nbsp;&nbsp;&nbsp;<font color="#EB7A77">冬之茶</font></h3>
			<div class="grid-container" style="font-size:20px;font-weight:bold;">
			<?php 
				$sqlcmd = "SELECT * FROM product_shop WHERE shop_name LIKE '茶覺' AND pd_category LIKE '冬之茶'";
				$rs = querydb($sqlcmd, $db_conn);
				for ($i=0; $i<count($rs); $i++) {
			?>
			<?php 
				$Pd_name = $rs[$i]['pd_name'];
				$Pd_price = $rs[$i]['pd_price'];
				$Pd_category = $rs[$i]['pd_category'];
				$Seqno = $rs[$i]['seqno'];
			?>
			<div class="grid-item">
			餐點名稱: <?php echo $Pd_name; ?><br>
			餐點價錢: <?php echo $Pd_price ?>元<br>
				<form id="form2" name="form2" method="get" action="Confirm.php">
					<input type="hidden" name="Seqno" value="<?php echo $Seqno ?>">
					<input type="hidden" name="shop_name" value="<?php echo $shop_name ?>">
					<input type="submit" name="Confirm" value="加進購物車"style="color:#F0F0F0;font-size:20px;width:120px;height:30px;border:2px blue none;background-color:#272727">
				</form>
			</div>
			<?php }?>
			</div>
			
			<h3>&nbsp;&nbsp;&nbsp;<font color="#EB7A77">特調奶類</font></h3>
			<div class="grid-container" style="font-size:20px;font-weight:bold;">
			<?php 
				$sqlcmd = "SELECT * FROM product_shop WHERE shop_name LIKE '茶覺' AND pd_category LIKE '特調奶類'";
				$rs = querydb($sqlcmd, $db_conn);
				for ($i=0; $i<count($rs); $i++) {
			?>
			<?php 
				$Pd_name = $rs[$i]['pd_name'];
				$Pd_price = $rs[$i]['pd_price'];
				$Pd_category = $rs[$i]['pd_category'];
				$Seqno = $rs[$i]['seqno'];
			?>
			<div class="grid-item">
			餐點名稱: <?php echo $Pd_name; ?><br>
			餐點價錢: <?php echo $Pd_price ?>元<br>
				<form id="form2" name="form2" method="get" action="Confirm.php">
					<input type="hidden" name="Seqno" value="<?php echo $Seqno ?>">
					<input type="hidden" name="shop_name" value="<?php echo $shop_name ?>">
					<input type="submit" name="Confirm" value="加進購物車"style="color:#F0F0F0;font-size:20px;width:120px;height:30px;border:2px blue none;background-color:#272727">
				</form>
			</div>
			<?php }?>
			</div>
			
			<h3>&nbsp;&nbsp;&nbsp;<font color="#EB7A77">香醇鮮奶區</font></h3>
			<div class="grid-container" style="font-size:20px;font-weight:bold;">
			<?php 
				$sqlcmd = "SELECT * FROM product_shop WHERE shop_name LIKE '茶覺' AND pd_category LIKE '香醇鮮奶區'";
				$rs = querydb($sqlcmd, $db_conn);
				for ($i=0; $i<count($rs); $i++) {
			?>
			<?php 
				$Pd_name = $rs[$i]['pd_name'];
				$Pd_price = $rs[$i]['pd_price'];
				$Pd_category = $rs[$i]['pd_category'];
				$Seqno = $rs[$i]['seqno'];
			?>
			<div class="grid-item">
			餐點名稱: <?php echo $Pd_name; ?><br>
			餐點價錢: <?php echo $Pd_price ?>元<br>
				<form id="form2" name="form2" method="get" action="Confirm.php">
					<input type="hidden" name="Seqno" value="<?php echo $Seqno ?>">
					<input type="hidden" name="shop_name" value="<?php echo $shop_name ?>">
					<input type="submit" name="Confirm" value="加進購物車"style="color:#F0F0F0;font-size:20px;width:120px;height:30px;border:2px blue none;background-color:#272727">
				</form>
			</div>
			<?php }?>
			</div>
			
			<h3>&nbsp;&nbsp;&nbsp;<font color="#EB7A77">加料奶類</font></h3>
			<div class="grid-container" style="font-size:20px;font-weight:bold;">
			<?php 
				$sqlcmd = "SELECT * FROM product_shop WHERE shop_name LIKE '茶覺' AND pd_category LIKE '加料奶類'";
				$rs = querydb($sqlcmd, $db_conn);
				for ($i=0; $i<count($rs); $i++) {
			?>
			<?php 
				$Pd_name = $rs[$i]['pd_name'];
				$Pd_price = $rs[$i]['pd_price'];
				$Pd_category = $rs[$i]['pd_category'];
				$Seqno = $rs[$i]['seqno'];
			?>
			<div class="grid-item">
			餐點名稱: <?php echo $Pd_name; ?><br>
			餐點價錢: <?php echo $Pd_price ?>元<br>
				<form id="form2" name="form2" method="get" action="Confirm.php">
					<input type="hidden" name="Seqno" value="<?php echo $Seqno ?>">
					<input type="hidden" name="shop_name" value="<?php echo $shop_name ?>">
					<input type="submit" name="Confirm" value="加進購物車"style="color:#F0F0F0;font-size:20px;width:120px;height:30px;border:2px blue none;background-color:#272727">
				</form>
			</div>
			<?php }?>
			</div>
			
			<h3>&nbsp;&nbsp;&nbsp;<font color="#EB7A77">加料特區</font></h3>
			<div class="grid-container" style="font-size:20px;font-weight:bold;">
			<?php 
				$sqlcmd = "SELECT * FROM product_shop WHERE shop_name LIKE '茶覺' AND pd_category LIKE '加料特區'";
				$rs = querydb($sqlcmd, $db_conn);
				for ($i=0; $i<count($rs); $i++) {
			?>
			<?php 
				$Pd_name = $rs[$i]['pd_name'];
				$Pd_price = $rs[$i]['pd_price'];
				$Pd_category = $rs[$i]['pd_category'];
				$Seqno = $rs[$i]['seqno'];
			?>
			<div class="grid-item">
			餐點名稱: <?php echo $Pd_name; ?><br>
			餐點價錢: <?php echo $Pd_price ?>元<br>
				<form id="form2" name="form2" method="get" action="Confirm.php">
					<input type="hidden" name="Seqno" value="<?php echo $Seqno ?>">
					<input type="hidden" name="shop_name" value="<?php echo $shop_name ?>">
					<input type="submit" name="Confirm" value="加進購物車"style="color:#F0F0F0;font-size:20px;width:120px;height:30px;border:2px blue none;background-color:#272727">
				</form>
			</div>
			<?php }?>
			</div>
		</div>
	</div>
</div>
</body>
</html>