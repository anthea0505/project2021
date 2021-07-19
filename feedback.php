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
$sqlcmd = "SELECT * FROM customer WHERE loginid='$LoginID' AND valid='Y'";
$rs = querydb($sqlcmd, $db_conn);
if (count($rs) <= 0) die ('Unknown or invalid user!');

if (!isset($Name)) $Name = '';
if (!isset($Shop_name)) $Shop_name = '';
if (!isset($Content)) $Content = '';
if (isset($Confirm)) {
	if (empty($Name)){
		$ErrMsg = '顧客姓名不可為空白\n';
		echo "<script>alert('$ErrMsg'); </script>";
	}
	if (empty($Content)){
		$ErrMsg = '回饋欄不可為空白\n';
		echo "<script>alert('$ErrMsg'); </script>";
	}
	$d = date("Y-m-d" , mktime(date('m'), date('d'), date('Y')));
	$t = date("H:i:s" , mktime(date('H')+8, date('i')+2, date('s')));
	//echo $Name;echo $Content;
	if (empty($ErrMsg)) {
		$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
		$sqlcmd="INSERT INTO cus_feedback (name,f_date,f_time,shop_name,content) VALUES ('$Name','$d','$t','$Shop_name','$Content')";
		$result = updatedb($sqlcmd, $db_conn);
		
		//echo "123";
		//echo "$Name";
		//echo "$d";
		//echo "$t";
		//echo "$Shop_name";
		//echo "$Content";
		header("Location:index.php");
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
<meta http-equiv="pragma" content="no-cache">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.6">
<link rel="stylesheet" title="MISstyle" type="text/css" />
<title>顧客回饋</title>
</head>
<body style="color:black;"bgcolor="#DBE4C9"onload="setFocus()">
<style>
	html{
		height:100%; 
		width:100%;
	}
	body{
		height:100%; 
		width:100%;
		margin:0px;
		display:flex;
		flex-direction:column;
	}
	#text{
		color:#FFFFFF;
		font-size:30px;
		text-align:center;
	}
	.grid-item{
		color:#BFCFAC;
		font-size:30px;
		text-align:center;
		//background-color: #fff;
	}
	.grid-item2{
		color:#BFCFAC;
		font-size:30px;
		text-align:center;
	}	
	input{
		font-size:30px;
	}
	.top-message{
		position:absolute;
		width:100%;
		height:20%;
		font-size:30px;
	}
	ul{
	    /* 取消ul預設的內縮及樣式 */
	    margin: 0;
	    padding: 0;
		list-style: none;
	}
	ul.drop-down-menu-top {
	    border: #b8b0b0 3px solid;
	    display: inline-block;
 	    font-family: 'Open Sans', Arial, sans-serif;
		font-size: 25px;
	}
		
	ul.drop-down-menu-top li {
		position: relative;
		white-space: nowrap;
		border-right: #b8b0b0 3px solid;
	}

	ul.drop-down-menu-top>li:last-child {
		border-right: none;
	}

	ul.drop-down-menu-top>li {
		float: left;
	    /* 只有第一層是靠左對齊*/
	}

	ul.drop-down-menu-top a {
		background-color: #fff;
		color: #888888;
		display: block;
		padding: 0 30px;
		text-decoration: none;
		line-height: 40px;
	}

	ul.drop-down-menu-top a:hover {
		/* 滑鼠滑入按鈕變色*/
		background-color: #BFCFAC;
		color: #fff;
	}

	ul.drop-down-menu-top li:hover>a {
		/* 滑鼠移入次選單上層按鈕保持變色*/
		background-color: #BFCFAC;
		color: #fff;
	}

	ul.drop-down-menu-top ul {
		border: #b8b0b0 3px solid;
		position: absolute;
	    z-index: 99;
		left: -1px;
		top: 100%;
		min-width: 180px;
	}

	ul.drop-down-menu-top ul li {
		border-bottom: #b8b0b0 3px solid;
	}

	ul.drop-down-menu-top ul li:last-child {
	    border-bottom: none;
	}

	ul.drop-down-menu-top ul {
		/*隱藏次選單*/
		display: none;
	}

	ul.drop-down-menu-top li:hover>ul {
	    /* 滑鼠滑入展開次選單*/
		display: block;
	}

	.right-message{
		float:center;
		position:absolute;
		top:10%;
		left:2%;
		width:100%;
		height:100%;
		display: grid;
		grid-template-columns: 8% 15% 15% 15% 15% 15%;
		grid-template-rows: auto auto auto auto auto;
		//grid-template-columns: 1fr 1fr 1fr;
		//grid-template-columns: repeat(5, 1fr);
		grid-gap: 50px 50px;
	}
			
</style>
<div class="top-message"style="display: inline-block;">
<div style="float:left;">校園線上點餐系統</div>
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
		<a href="index.php">回首頁</a>
	</li>
	<li>
		<a href="logout.php">會員登出</a>
	</li>
	<?php } ?>	
	<?php } ?>
</ul>
</div>
<div style="text-align:center;margin-top:30px;">
	<div style="width:40%;height:600px;margin:40px auto;background:white;font-size:25px;font-weight:bold;float:center;">
		<div style="text-align:left;">
		<h2>&nbsp;&nbsp;&nbsp;顧客回饋</h2>
		<form action="" method="post" name="feedbackform">
			&nbsp;&nbsp;&nbsp;顧客姓名Name
			<br>
			&nbsp;&nbsp;
			<input type="text" name="Name" maxlength="20"style="width:300px; height:30px;font-size:15px;"/>
			<br><br>
			&nbsp;&nbsp;&nbsp;選擇店家Shop
			<br>
			&nbsp;&nbsp;
			<select name="Shop_name" onchange="sumbit()">
				<option value="99早餐店">99早餐店</option>
				<option value="玉福">玉福</option>
				<option value="茶覺">茶覺</option>
				<option value="陳記咖哩鐵板">陳記咖哩鐵板</option>
				<option value="八方雲集">八方雲集</option>
				<option value="喔A茶飲">喔A茶飲</option>
				<option value="壹而美早餐店">壹而美早餐店</option>
				<option value="哈瓦那義大利麵">哈瓦那義大利麵</option>
				<option value="大野狼小綿羊">大野狼小綿羊</option>
				<option value="真元氣滷味">真元氣滷味</option>
				<option value="小食麵">小食麵</option>
			</select>
			<br><br>
			&nbsp;&nbsp;&nbsp;回饋內容Content
			<br>
			&nbsp;&nbsp;
			<textarea name="Content" maxlength="90" style="width:300px;height:200px;font-size:15px;">
			</textarea>
			<br><br>
			&nbsp;&nbsp;&nbsp;<input type="submit" name="Confirm" value="確認送出"style="color:#F0F0F0;font-size:25px;width:150px;height:30px;border:2px blue none;background-color:#272727">
		</form>
		<br>
		</div>
	</div>
</div>
</body>
</html>
