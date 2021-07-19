<?php
header('Content-Type: text/html; charset=utf-8');
//require_once("auth.php");
//session_start();
//$loginID = $_SESSION['LoginID'];
//$Name = $_SESSION['name'];
session_start();
$loginID = $_SESSION['LoginID'];
$A = $_SESSION['A'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"></meta>
	<title>校園線上點餐系統</title>
</head>
<body bgcolor="#fbf0f0">
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
		color:#9F353A;
		font-size:30px;
		text-align:center;
		//background-color: #fff;
	}
	.grid-item2{
		color:#9F323A;
		font-size:30px;
		text-align:center;
		//background-color: black;
		//background-image:url('https://imgur.com/1CYBVH4');
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
		background-color: #dfd3d3;
		color: #fff;
	}

	ul.drop-down-menu-top li:hover>a {
		/* 滑鼠移入次選單上層按鈕保持變色*/
		background-color: #dfd3d3;
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
<div style="color:#888888;float:left;">校園線上點餐系統</div>
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
	
	<?php if($A!="customer"|| empty($_SESSION['A'])){ ?>
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
			<li><a href="shop1_shop_management.php">餐點管理</a></li>
		<?php	break;
		case "yf":?>
				<li><a href="shop2_shop_management.php">餐點管理</a></li>
		<?php	break;
			case "cg":?>
				<li><a href="shop3_shop_management.php">餐點管理</a></li>
		<?php	break;
			case "curry":?>
				<li><a href="shop4_shop_management.php">餐點管理</a></li>
		<?php	break;
			case "8f":?>
				<li><a href="shop5_shop_management.php">餐點管理</a></li>
		<?php	break;
			case "Atea":?>
				<li><a href="shop6_shop_management.php">餐點管理</a></li>
		<?php	break;
				case "b1bf":?>
				<li><a href="shop7_shop_management.php">餐點管理</a></li>
		<?php	break;
			case "pasta":?>
				<li><a href="shop8_shop_management.php">餐點管理</a></li>
		<?php	break;
			case "rice":?>
				<li><a href="shop9_shop_management.php">餐點管理</a></li>
		<?php	break;
			case "b1lw":?>
				<li><a href="shop10_shop_management.php">餐點管理</a></li>
		<?php	break;
			case "noodle":?>
				<li><a href="shop11_shop_management.php">餐點管理</a></li>
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
</ul>
</div>
	
<div class="right-message">
	<div class="grid-item2" ><p style="color:#7c7575;">早餐</p></div>
	<div class="grid-item"><a href="shop1.php"style="color:#7c7575;">99早餐店</a><img src="https://i.imgur.com/aDNOku5.png" width="90%" height="80%"></div>
	<div class="grid-item"><a href="shop7.php"style="color:#7c7575;">壹而美早餐店</a><img src="https://i.imgur.com/NmlrIBe.png" width="90%" height="80%"></div>
	<div class="grid-item"></div>
	<div class="grid-item"></div>
	<div class="grid-item"></div>
	
	<div class="grid-item2"><p style="color:#7c7575;">飲料</p></div>
	<div class="grid-item"><a href="shop3.php"style="color:#7c7575;">茶覺</a><img src="https://i.imgur.com/5pwHaPA.jpg" width="90%" height="80%"></div>
	<div class="grid-item"><a href="shop6.php"style="color:#7c7575;">喔A茶飲</a><img src="https://i.imgur.com/ziSmvfC.png" width="90%" height="80%"></div>
	<div class="grid-item"></div>
	<div class="grid-item"></div>
	<div class="grid-item"></div>
	
	<div class="grid-item2"><p style="color:#7c7575;">日/義式</p></div>
	<div class="grid-item"><a href="shop8.php"style="color:#7c7575;">哈瓦那義大利麵</a><img src="https://i.imgur.com/CDGN3Js.png" width="90%" height="80%"></div>
	<div class="grid-item"><a href="shop9.php"style="color:#7c7575;">大野狼小綿羊</a><img src="https://i.imgur.com/UFxnIOw.png" width="90%" height="80%"></div>
	<div class="grid-item"></div>
	<div class="grid-item"></div>
	<div class="grid-item"></div>
	
	<div class="grid-item2"><p style="color:#7c7575;">中式</p></div>
	<div class="grid-item"><a href="shop2.php"style="color:#7c7575;">玉福</a><img src="https://i.imgur.com/3BiPwkO.png" width="90%" height="80%"></div>
	<div class="grid-item"><a href="shop4.php"style="color:#7c7575;">陳記咖哩鐵板</a><img src="https://i.imgur.com/SVkKGet.png" width="90%" height="80%"></div>
	<div class="grid-item"><a href="shop5.php"style="color:#7c7575;">八方雲集</a><img src="https://i.imgur.com/4XEZFkP.jpg" width="90%" height="80%"></div>
	<div class="grid-item"><a href="shop10.php"style="color:#7c7575;">真元氣滷味</a><img src="https://i.imgur.com/CSILutR.png" width="90%" height="80%"></div>
	<div class="grid-item"><a href="shop11.php"style="color:#7c7575;">小食麵</a><img src="https://i.imgur.com/vomAklT.jpg" width="90%" height="80%"></div>

</div>
	
</body>
</html>
