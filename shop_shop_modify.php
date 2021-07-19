<?php
header('Content-type: text/html; charset=utf-8');
require_once("auth.php");
// 使用者點選放棄修改按鈕
if (isset($_GET['Abort'])) header("Location: index.php");

// 變數及函式處理，請注意其順序
require_once("gpsvars.php");
require_once("configure.php");
require_once("db_func.php");
$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);

$LoginID = $_SESSION['LoginID'];
$Seqno = $_GET['Seqno'];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF8">
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
<meta http-equiv="pragma" content="no-cache">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.6">
<link rel="stylesheet" href="shopstyle.css">
<title>修改餐點</title>
</head>
<body style="color:black;"bgcolor="#D7C4BB"onload="setFocus()">

<div class="top-message"style="display: inline-block;">
<div style="float:left;">修改餐點</div>
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
<div style="text-align:center;margin-top:30px;">
	<div style="width:80%;height:500px;margin:40px auto;background:white;font-size:25px;font-weight:bold;float:center;">
		<div style="text-align:left;">
			<form action="Confirm_mgm1.php" method="get" name="inputform">
				<br><br>
				<?php
					$sqlcmd = "SELECT * FROM product_shop WHERE seqno='$Seqno'";
					$rs = querydb($sqlcmd, $db_conn);
					$Old_Pd_name=$rs[0]['pd_name'];
					$Old_Pd_price=$rs[0]['pd_price'];
					//$Old_pd_category=$rs[0]['pd_price'];
				?>		
				<table border="1" width="60%" cellspacing="0" cellpadding="3" align="center">
				<tr height="40">
					<th width="40%">餐點名稱</th>
						<td><input type="text" name="Pd_name" value="<?php echo $Pd_name ?>" size="20" placeholder="<?php echo $Old_Pd_name ?>"></td>
				</tr>
				<tr height="40">
					<th width="40%">餐點價錢</th>
						<td><input type="text" name="Pd_price" value="<?php echo $Pd_price ?>" size="20" placeholder="<?php echo $Old_Pd_price ?>"></td>
				</tr>
				<tr height="40">
					<th>種類</th>
						<td>
						<?php
							$_SESSION['LoginID'];

							switch ($_SESSION['LoginID']) 
							{
								case "99bf":?>
									<select name="Pd_category" onchange="sumbit()">
									<option value="吐司果醬類">吐司果醬類</option>
									<option value="吐司現烤類">吐司現烤類</option>
									<option value="三明治總匯">三明治總匯</option>
									<option value="帕尼尼">帕尼尼</option>
									<option value="美味漢堡">美味漢堡</option>
									<option value="香酥餅類">香酥餅類</option>
									<option value="鐵板麵">鐵板麵</option>
									<option value="點心類">點心類</option>
									<option value="單品">單品</option>
									<option value="飲料">飲料</option>
									</select>
						<?php   break;
								case "yf":?>
									<select name="Pd_category" onchange="sumbit()">
									<option value="主食">主食</option>
									<option value="青菜">青菜</option>
									<option value="肉類">肉類</option>
									<option value="其他">其他</option>
									</select>
						<?php   break;
								case "cg":?>
									<select name="Pd_category" onchange="sumbit()">
									<option value="特選茶品">特選茶品</option>
									<option value="消暑飲">消暑飲</option>
									<option value="醇咖啡">醇咖啡</option>
									<option value="特調茶類">特調茶類</option>
									<option value="流行茶飲">流行茶飲</option>
									<option value="冬之茶">冬之茶</option>
									<option value="特調奶類">特調奶類</option>
									<option value="香醇鮮奶區">香醇鮮奶區</option>
									<option value="加料奶類">加料奶類</option>
									<option value="加料特區">加料特區</option>
						<?php   break;
								case "curry":?>
									<select name="Pd_category" onchange="sumbit()">
									<option value="飯類">飯類</option>
									<option value="咖哩">咖哩</option>
						<?php   break;
								case "8f":?>
									<select name="Pd_category" onchange="sumbit()">
									<option value="水餃">水餃</option>
									<option value="鍋貼">鍋貼</option>
									<option value="麵食">麵食</option>
									<option value="湯品">湯品</option>
									<option value="飲品">飲品</option>
									</select>
						<?php   break;;
								case "Atea":?>
									<select name="Pd_category" onchange="sumbit()">
									<option value="極品好茶">極品好茶</option>
									<option value="新鮮好茶">新鮮好茶</option>
									<option value="品味咖啡">品味咖啡</option>
									<option value="香濃奶茶">香濃奶茶</option>
									<option value="海鹽奶蓋香">海鹽奶蓋香</option>
									<option value="多多 多酚系列">多多 多酚系列</option>
									<option value="甘蔗系列">甘蔗系列</option>
									<option value="健康鮮奶">健康鮮奶</option>
									<option value="龍捲風冰沙">龍捲風冰沙</option>
									<option value="芭樂系列">芭樂系列</option>
									<option value="重乳系列">重乳系列</option>
									<option value="非常可樂">非常可樂</option>
									<option value="黑旋風奶蓋">黑旋風奶蓋</option>
									<option value="冰涼冰沙">冰涼冰沙</option>
									<option value="霜淇淋系列">霜淇淋系列</option>
						<?php   break;
								case "b1bf":?>
									<select name="Pd_category" onchange="sumbit()">
									<option value="吐司類">吐司類</option>
									<option value="三明治總匯">三明治總匯</option>
									<option value="漢堡">漢堡</option>
									<option value="蛋餅">蛋餅</option>
									<option value="鐵板麵">鐵板麵</option>
									<option value="點心類">點心類</option>
									<option value="飲料">飲料</option>
						<?php   break;
								case "pasta":?>
									<select name="Pd_category" onchange="sumbit()">
									<option value="白醬">白醬</option>
									<option value="紅醬">紅醬</option>
									<option value="青醬">青醬</option>
									<option value="辣味">辣味</option>
									<option value="焗烤">焗烤</option>
						<?php   break;
								case "rice":?>
									<select name="Pd_category" onchange="sumbit()">
									<option value="風味餐">風味餐</option>
									<option value="日式醬燒">日式醬燒</option>
									<option value="法蘭斯口味">法蘭斯口味</option>
									<option value="火鍋">火鍋</option>
						<?php   break;
								case "b1lw":?>
									<select name="Pd_category" onchange="sumbit()">
									<option value="主食">主食</option>
									<option value="青菜">青菜</option>
									<option value="肉類">肉類</option>
									<option value="其他">其他</option>
						<?php   break;
								case "noodle":?>
									<select name="Pd_category" onchange="sumbit()">
									<option value="湯麵">湯麵</option>
									<option value="乾麵">乾麵</option>
									<option value="飯 水餃 湯">飯 水餃 湯</option>
									<option value="其他">其他</option>
						<?php   break;
							}
						?>
							
						</td>
				</tr>
				</table>
				</br>
				<center>
					<input type="submit" name="Confirm" value="存檔送出">&nbsp;
					<input type="submit" name="Abort" value="放棄修改">	
					<input type="hidden" name="Seqno" value="<?php echo $Seqno ?>">
				</center>
			</form>
		</div>
	</div>
</div>
</body>
</html>