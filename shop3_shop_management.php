<?php
// Authentication 認證
require_once("auth.php");
session_start();
// 變數及函式處理，請注意其順序
require_once("gpsvars.php");
require_once("configure.php");
require_once("db_func.php");
$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);


$ItemPerPage = 10;
$sqlcmd = "SELECT count(*) AS reccount FROM product_shop WHERE shop_name='茶覺'";
$rs = querydb($sqlcmd, $db_conn);
$RecCount = $rs[0]['reccount'];
$TotalPage = (int) ceil($RecCount/$ItemPerPage);
if (!isset($Page)) {
    if (isset($_SESSION['CurPage'])) $Page = $_SESSION['CurPage'];
    else $Page = 1;
}
if ($Page > $TotalPage) $Page = $TotalPage;
$_SESSION['CurPage'] = $Page;
$StartRec = ($Page-1) * $ItemPerPage;
$sqlcmd = "SELECT * FROM product_shop WHERE shop_name='茶覺' LIMIT $StartRec,$ItemPerPage";
$Contacts = querydb($sqlcmd, $db_conn);
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF8">
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
<meta http-equiv="pragma" content="no-cache">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.6">
<link rel="stylesheet" href="shopstyle.css">
<title>餐點管理</title>
</head>
<body style="color:black;"bgcolor="#D7C4BB">
<div>
<Script Language="JavaScript">
<!--
function confirmation(DspMsg, PassArg) {
var name = confirm(DspMsg)
    if (name == true) {
      location=PassArg;
    }
}
-->
</SCRIPT>
<div class="top-message"style="display: inline-block;">
<div style="float:left;">茶覺餐點管理</div>
<ul class="drop-down-menu-top"style="float:right;">
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
	<li>
		<a href="shop3_shop_management.php">店家管理</a>
	</li>
	<li>
		<a href="shop_odlist.php">訂單管理</a>
	</li>
	<li>
		<a href="shop3.php">店家頁面</a>
	</li>
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
<br><br>
<table style="border:3px solid;" border="1" width="90%" align="center" cellpadding="10" cellpadding="2">
	<tr>
		<th width="5%">處理</th>
		<th width="5%">是否售完</th>
		<th width="5%">餐點編號</th>
		<th width="10%">餐點名稱</th>
		<th width="5%">餐點價錢</th>
		<th width="10%">餐點類型</th>
	</tr>
	<?php
	$H = date("H" , mktime(date('H')+8));	//小時
	$i = date("i" , mktime(date('i')));		//分
	//echo $i;
	if($H==7 && $i==58){	//8:00重置
		$sqlcmd="UPDATE product_shop SET sold_out='N'";
		$result = updatedb($sqlcmd, $db_conn);		
	}
	//$t = date("H:i:s" , mktime(date('H')+8, date('i'), date('s')+50));
	
	$sqlcmd = "SELECT * FROM product_shop WHERE shop_name='茶覺' LIMIT $StartRec,$ItemPerPage";
	$Contacts = querydb($sqlcmd, $db_conn);
	foreach ($Contacts AS $item) {
	  $sold_out = $item['sold_out'];
	  $seqno = $item['seqno'];
	  $pd_name = $item['pd_name'];
	  $pd_price = $item['pd_price'];
	  $pd_catagory = $item['pd_category'];
	  //$Valid = $item['valid'];
	  echo '<tr align="center"><td>';
	?>
	<form method="get" action="shop_shop_modify.php">
		<input type="submit" name = "modify" value="修改">
		<input type="hidden" name="Seqno" value="<?php echo $seqno ?>">
	</form>
	<form method="get" action="shop_shop_delete.php">
		<input type="submit" name = "delete" value="刪除">
		<input type="hidden" name="Seqno" value="<?php echo $seqno ?>">
	</form>
	<form method="get" action="sold_out.php">
		<input type="submit" name="sold_out" value="售完" >
		<input type="hidden" name="Seqno" value="<?php echo $seqno ?>">
	</form>
	</td>

	<td><?php if($sold_out=='N')echo "否"; else if($sold_out=='Y') echo "是"; ?></td> 
	<td><?php echo $seqno ?></td>   
    <td><?php echo $pd_name ?></td>
    <td><?php echo $pd_price ?></td>
    <td><?php echo $pd_catagory ?></td>   
    </tr>
	<?php } ?>
</table>
<center><table border="0" width="90%" align="center" cellspacing="0"cellpadding="2">
	<tr>
	<?php if ($TotalPage > 1) { ?>
		<form name="SelPage" method="POST" action="">
		  第<select name="Page" onchange="submit();">
		<?php 
		for ($p=1; $p<=$TotalPage; $p++) 
		{ 
			echo '  <option value="' . $p . '"';
			if ($p == $Page) echo ' selected';
			echo ">$p</option>\n";
		}
		?>
		  </select>頁 共<?php echo $TotalPage ?>頁
		</form>
	<?php } ?>
	</tr>
</table></center>
</div>
</body>
</html>