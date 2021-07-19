<?php
require_once("auth.php");
session_start();
$loginID = $_SESSION['LoginID'];
$Name = $_SESSION['name'];
$shop_name = $_GET["shop_name"];

require_once("gpsvars.php");
require_once("configure.php");
require_once("db_func.php");
$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);

//echo $Name;
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
<title>查看訂單</title>
</head>
<body>
<div class="top-message"style="display: inline-block;">
<div style="float:left;">查看訂單</div>
<ul class="drop-down-menu-top"style="float:right;">	
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
	</li>
	<ul>
	<?php
		if(!isset($_SESSION['LoginID']) || empty($_SESSION['LoginID'])){
	?>
	<li>
		<a href="login.php">會員登入</a>
	</li>
	<?php } ?>	
	</ul>
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
	<li>
		<a href="cart.php">購物車</a>
	</li>
	<li>
		<a href="#">選擇店家</a>
		<ul>
			<li>
				<a href="show_cus_odlist.php?shop_name=99早餐店">99早餐店</a>
			</li>
			<li>
				<a href="show_cus_odlist.php?shop_name=玉福">玉福</a>
			</li>
			<li>
				<a href="show_cus_odlist.php?shop_name=茶覺">茶覺</a>	
			</li>
			<li>
				<a href="show_cus_odlist.php?shop_name=陳記咖哩鐵板">陳記咖哩鐵板</a>				
			</li>
			<li>
				<a href="show_cus_odlist.php?shop_name=八方雲集">八方雲集</a>				
			</li>
			<li>
				<a href="show_cus_odlist.php?shop_name=喔A茶飲">喔A茶飲</a>				
			</li>
			<li>
				<a href="show_cus_odlist.php?shop_name=壹而美早餐店">壹而美早餐店</a>			
			</li>
			<li>
				<a href="show_cus_odlist.php?shop_name=哈瓦那義大利麵">哈瓦那義大利麵</a>				
			</li>
			<li>
				<a href="show_cus_odlist.php?shop_name=大野狼小綿羊">大野狼小綿羊</a>				
			</li>
			<li>
				<a href="show_cus_odlist.php?shop_name=真元氣滷味">真元氣滷味</a>				
			</li>
			<li>
				<a href="show_cus_odlist.php?shop_name=小食麵">小食麵</a>			
			</li>
		</ul>
	</li>
	<li>
		<a href="index.php">回首頁</a>
	</li>
	<li>
		<a href="logout.php">會員登出</a>
	</li>
	<?php } ?>
</ul>
<br><br>
</div>	
<div class="container">
    <div class="item_header">
        <div class="item_style">訂單內容</div> 
		<div class="item_style">訂單編號</div>
		<div class="item_style">訂單備註</div>
        <div class="item_style">總計</div>
		<div class="item_style">訂單狀態</div>
    </div>
</div>
<?php
	//echo $_GET['shop_name'];
	//echo $shop_name;
	switch($shop_name) 
	{
		case "99早餐店":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='99早餐店'AND od_status!='訂單完成'";
			break;
		case "玉福":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='玉福'AND od_status!='訂單完成'";
			break;
		case "茶覺":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='茶覺'AND od_status!='訂單完成'";
			break;
		case "陳記咖哩鐵板":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='陳記咖哩鐵板'AND od_status!='訂單完成'";
			break;
		case "八方雲集":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='八方雲集'AND od_status!='訂單完成'";
			break;
		case "喔A茶飲":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='喔A茶飲'AND od_status!='訂單完成'";
			break;
		case "壹而美早餐店":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='壹而美早餐店'AND od_status!='訂單完成'";
			break;
		case "哈瓦那義大利麵":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='哈瓦那義大利麵'AND od_status!='訂單完成'";
			break;
		case "大野狼小綿羊":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='大野狼小綿羊'AND od_status!='訂單完成'";
			break;
		case "真元氣滷味":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='真元氣滷味'AND od_status!='訂單完成'";
			break;
		case "小食麵":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='小食麵'AND od_status!='訂單完成'";
			break;
	}
				
	//$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='$shop_name'";
	$r = querydb($sqlcmd, $db_conn);
	if(count($r)!=0){
		for ($i=0; $i<count($r); $i++) {
			$od_total_product = $r[$i]['od_total_product'];	//訂單內容
			$od_number = $r[$i]['od_number'];//訂單編號
			$od_memo = $r[$i]['od_memo'];//訂單備註
			$od_total_price = $r[$i]['od_total_price'];//總計
			//$payment = $r[$i]['payment'];//付款方式
			$od_status = $r[$i]['od_status'];//訂單狀態*/
?>
<div class="item_container">
    <div class="item_header item_body">
		<div class="item_style"><?php echo $od_total_product; ?></div>
							
		<div class="item_style"><?php echo $od_number; ?></div>
		
		<div class="item_style"><?php if(empty($od_memo)) echo '無'; else echo $od_memo; ?></div>
							
		<div class="item_style"><span>$</span><?php echo $od_total_price; ?></div>
							
		<div class="item_style"><?php echo $od_status; ?></div>                   
    </div>
</div>
<?php }} ?>

<?php
	//echo $_GET['shop_name'];
	//echo $shop_name;
	switch($shop_name) 
	{
		case "99早餐店":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='99早餐店'AND od_status='訂單完成'";
			break;
		case "玉福":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='玉福'AND od_status='訂單完成'";
			break;
		case "茶覺":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='茶覺'AND od_status='訂單完成'";
			break;
		case "陳記咖哩鐵板":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='陳記咖哩鐵板'AND od_status='訂單完成'";
			break;
		case "八方雲集":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='八方雲集'AND od_status='訂單完成'";
			break;
		case "喔A茶飲":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='喔A茶飲'AND od_status='訂單完成'";
			break;
		case "壹而美早餐店":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='壹而美早餐店'AND od_status='訂單完成'";
			break;
		case "哈瓦那義大利麵":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='哈瓦那義大利麵'AND od_status='訂單完成'";
			break;
		case "大野狼小綿羊":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='大野狼小綿羊'AND od_status='訂單完成'";
			break;
		case "真元氣滷味":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='真元氣滷味'AND od_status='訂單完成'";
			break;
		case "小食麵":
			$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='小食麵'AND od_status='訂單完成'";
			break;
	}
				
	//$sqlcmd = "SELECT * FROM order_list WHERE name='$Name'AND shop_name='$shop_name'";
	$rs = querydb($sqlcmd, $db_conn);

	if(count($r)==0 && count($rs)==0){
		echo "<big><center>尚無訂單</center></big>";
	}
	
	if(count($rs)!=0){
		for ($i=0; $i<count($rs); $i++) {
			$od_total_product = $rs[$i]['od_total_product'];	//訂單內容
			$od_number = $rs[$i]['od_number'];//訂單編號
			$od_memo = $rs[$i]['od_memo'];//訂單備註
			$od_total_price = $rs[$i]['od_total_price'];//總計
			//$payment = $rs[$i]['payment'];//付款方式
			$od_status = $rs[$i]['od_status'];//訂單狀態*/
?>
<div class="item_container">
    <div class="item_header item_body">
		<div class="item_style"><?php echo $od_total_product; ?></div>
							
		<div class="item_style"><?php echo $od_number; ?></div>
		
		<div class="item_style"><?php if(empty($od_memo)) echo '無'; else echo $od_memo; ?></div>
							
		<div class="item_style"><span>$</span><?php echo $od_total_price; ?></div>
							
		<div class="item_style"><?php echo $od_status; ?></div>                   
    </div>
</div>
<?php }} ?>
</body>
</html>