<?php
session_start();
$loginID = $_SESSION['LoginID'];
$Name = $_SESSION['name'];
// Authentication 認證
require_once("auth.php");
// session_start();
// 變數及函式處理，請注意其順序
require_once("gpsvars.php");
require_once("configure.php");
require_once("db_func.php");
$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);

/*
購物車:顯示加入購物車的
商品名稱、pd_name
數量(數量基本預設1，但這邊還可以增加減少，旁邊設計一個X按鈕可以讓整個商品移除)、pd_number
單價、pd_price
餐點備註(可以用來填寫特別需求，例如:餐點加辣、飯少之類的需求)、od_memo
付款方式(用Radio Buttons選現金或悠遊卡)、payment
購買人名字、name
手機號碼，
最後有一個送出訂單按鈕。

*/
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>購物車</title>
    <link rel="stylesheet" href="cartstyle.css">
	<link rel="stylesheet" href="shopstyle.css">
</head>
<body>
<div class="top-message"style="display: inline-block;">
<div style="float:left;">校園線上點餐系統-購物車</div>
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
			<div class="item_style">店家名稱</div>
            <div class="item_style">商品名稱</div>
            <div class="item_style">單價</div>
            <div class="item_style">數量</div> 
            <div class="item_style">總計</div>
            <div class="item_style">操作</div>
        </div>
		
		<?php
		$sqlcmd = "SELECT * FROM cart WHERE name='$Name'";
		$rs = querydb($sqlcmd, $db_conn);

		if(count($rs)==0){
			echo "<big><center>尚無商品</center></big>";
		}

		for ($i=0; $i<count($rs); $i++) {
			$Seqno = $rs[$i]['seqno'];
			$shop_name = $rs[$i]['shop_name'];//店家名稱
			$pd_name = $rs[$i]['pd_name'];	//商品名稱
			$pd_price = $rs[$i]['pd_price'];//單價
			$pd_number = $rs[$i]['pd_number'];//數量
			//$od_memo = $rs[$i]['od_memo'];//餐點備註
			//$payment = $rs[$i]['payment'];//付款方式
			$name = $rs[$i]['name'];//購買人名字
		?>
		
        <div class="item_container">
            <div class="item_header item_body">
				<div class="item_style"><?php echo $shop_name; ?></div>
				
                <div class="item_style"><div class="name"><?php echo $pd_name; ?></div></div>
                        
                <div class="item_style"><span>$</span><?php echo $pd_price; ?></div>
                        
				<div class="item_style">
					<form action="Addsub.php" method="get">
						<input type="submit" name = "addsub2" value="−">
						<?php echo $pd_number; ?>
						<input type="submit" name = "addsub1" value="+">
						<input type="hidden" name="Seqno" value="<?php echo $Seqno ?>">
					</form>
				</div> 
						
                <div class="item_style"><?php echo $pd_price*$pd_number; ?></div>
                        
				<div class="item_style">	
					<form action="Delete.php" method="get">
						<input type="submit" name = "delete" value="刪除">
						<input type="hidden" name="Seqno" value="<?php echo $Seqno ?>">								
					</form>	
				</div>
            </div>
        </div>
		<?php } ?>
    </div>
	<div style="width:1200px;height:80%;margin:40px auto;background:white;font-size:25px;font-weight:bold;float:center;">
	<form action="bill.php" method="get">
		付款方式:請到店付款<br>
		<?php 
		$sqlcmd = "SELECT * FROM cart WHERE name='$Name'";
		$r = querydb($sqlcmd, $db_conn);
		for ($j=0; $j<count($r); $j++) {
			if($j==0){
				$arr[0]= $r[$j]['shop_name'];
			}
			else{
				for($i=0;$i<count($arr);$i++){
					if($r[$j]['shop_name'] == $arr[$i])
						break;
					else if($i+1 == count($arr))
						$arr[$i+1] = $r[$j]['shop_name'];
				}
			}
		}
		//echo print_r($arr);
		?>
		<?php
		//echo count($arr);
		for($k=0;$k<count($arr);$k++){
			
			$sqlcmd = "SELECT * FROM shop WHERE shop_name='$arr[$k]'";//找店家seqno
			$rr = querydb($sqlcmd, $db_conn);
			$num = $rr[0]['seqno'];
			echo $arr[$k];
			echo "備註:";
			echo "<input type='text' name='Content[$num]'><br>";
			//echo "<textarea name="Content"></textarea><br>";
		}?>
<input type="submit" value="結帳送出"><br>		
	</form>
	</div>
</body>
</html>