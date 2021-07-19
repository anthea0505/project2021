<?php
// Authentication 認證
require_once("auth.php");
session_start();
$loginID = $_SESSION['LoginID'];
$Name = $_SESSION['name'];

// 變數及函式處理，請注意其順序
require_once("gpsvars.php");
require_once("configure.php");
require_once("db_func.php");
$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);

?>

<!DOCTYPE html>
<html>
<head>
<title>結帳頁面</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="shopstyle.css">
</head>
<body bgcolor="#DEB4A0" onload="ShowTime()">

<style>
    input[type="submit"]{
	padding:5px 10px; background:#ccc; border:0 none;
	cursor:pointer;
	-webkit-border-radius: 5px;
	border-radius: 5px; 
    }
    
    input[type="text"]{padding:5px 15px; border:2px black solid;
	cursor:pointer;
	-webkit-border-radius: 5px;
	border-radius: 5px; }
    .user_search{
    	padding-top: 0px;
    	text-align: center
    }
</style>

<body>
<div class="top-message"style="display: inline-block;">
<div style="float:left;">校園線上點餐系統-結帳</div>
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
	<div style="width:48%;height:80%;margin:15px auto;background:#FFFFFB;font-size:25px;font-weight:bold;float:left;">
		<?php
			
		$shop_arr=array(	//存店家名稱
			"3" =>array(0=>"99早餐店"),//$shop_arr[3][0]=99早餐店
			"4" =>array(0=>"玉福"),
			"5" =>array(0=>"茶覺"),
			"6" =>array(0=>"陳記咖哩鐵板"),
			"7" =>array(0=>"八方雲集"),
			"8" =>array(0=>"喔A茶飲"),
			"9" =>array(0=>"壹而美早餐店"),
			"10" =>array(0=>"哈瓦那義大利麵"),
			"11" =>array(0=>"大野狼小綿羊"),
			"12" =>array(0=>"真元氣滷味"),
			"13" =>array(0=>"小食麵")
		);

		$sqlcmd = "SELECT * FROM cart WHERE name='$Name'";
		$rs = querydb($sqlcmd, $db_conn);
		if(count($rs)==0){
			echo "<big><center>尚無商品</center></big>";
		}

		for ($i=0; $i<count($rs); $i++) {

			$Seqno = $rs[$i]['seqno'];
			$pd_name = $rs[$i]['pd_name'];	//商品名稱
			$pd_price = $rs[$i]['pd_price'];//單價
			$pd_number = $rs[$i]['pd_number'];//數量
			//$od_memo = $rs[$i]['od_memo'];//餐點備註
			$shop_name = $rs[$i]['shop_name'];//店家名稱
			//$payment = $rs[$i]['payment'];//付款方式
			//$name = $rs[$i]['name'];//購買人名字
			$total += $pd_number*$pd_price;//總價
			//$od_total_product = $od_total_product.' '.$pd_name;
			
			
			
			$sqlcmd = "SELECT * FROM shop WHERE shop_name='$shop_name'"; //找目前餐點的店家seqno
			$re = querydb($sqlcmd, $db_conn);
			$shop_seqno = $re[0]['seqno'];
			$shop_arr[$shop_seqno][1] = $shop_arr[$shop_seqno][1].' '.$pd_name.'X'.$pd_number;	//把同店家的商品串一起
			$shop_arr[$shop_seqno][2] += $pd_number*$pd_price;	//把同店家的商品價格相加
			
		?><br>

		店家名稱： 
		<?php echo $shop_name; ?><br>
		商品名稱： 
		<?php echo $pd_name; ?><br>
		單價：
		<?php echo $pd_price ?>元<br>
		數量：
		<?php echo $pd_number ?>個
		<?php } ?>
		<br><br>
	</div>


	<?php 
		//時間
		$d = date("Y-m-d" , mktime(date('m'), date('d'), date('Y')));
		$t = date("H:i:s" , mktime(date('H')+8, date('i'), date('s')+50));
		
		$Content = $_GET['Content'];//取得備註陣列
		//print_r($Content);

		//抓電話號碼,email
		$sqlcmd = "SELECT * FROM customer WHERE name='$Name'";
		$rs = querydb($sqlcmd, $db_conn);
		$Phone = $rs[0]['phone'];
		$Email = $rs[0]['email'];


	if (isset($Confirm)){
		for($i=3; $i<=13; $i++){
			if( !empty($shop_arr[$i][1]) ){
				$Rand = rand(0,1000);//亂數訂單號碼
				$shop_name = $shop_arr[$i][0];
				$od_total_product = $shop_arr[$i][1];
				$od_total_price = $shop_arr[$i][2];
				$memo = $Content[$i];
				
				$sqlcmd="INSERT INTO order_list (shop_name,od_number,od_total_product,od_total_price,od_date,od_time,email,od_status,name,phone,od_memo) VALUES "
				. "('$shop_name','$Rand','$od_total_product','$od_total_price','$d','$t','$Email','未製作','$Name',$Phone,'$memo')";//送出訂單
				$result = updatedb($sqlcmd, $db_conn);				
			}
		}
		$sqlcmd= "delete from cart WHERE name='$Name'";//刪除購物車資料
		$result = updatedb($sqlcmd, $db_conn);
		
		header("Location: index.php");
	}

	?>
	<div style="width:48%;height:80%;margin:15px auto;background:#FFFFFB;font-size:25px;font-weight:bold;float:right;">
		<br>
		訂單日期:<?php echo $d;?><br>
		訂單時間:<?php echo $t;?><br>
		購買人: <?php echo "$Name";?><br>
		手機號碼:0<?php echo "$Phone";?><br>
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
		//echo count($arr);
		for($k=0;$k<count($arr);$k++){	
			echo $arr[$k];
			
			for($i=3;$i<=13;$i++){
				if( $arr[$k] == $shop_arr[$i][0] ){
					echo "價格: ";
					echo $shop_arr[$i][2];
					echo"元";
					echo "<br>";
					echo "備註: ";
					if(empty($Content[$i])) echo '無'; else echo "$Content[$i]";
					//echo $Content[$i];
					echo "<br>";
				}	
			}
			//if(empty($Content)) echo '無'; else echo "$Content";
		}	
		?>
		訂單總價格:<?php echo "$total"; echo"元"?><br><br>
		<!---餐點備註:<?php //if(empty($Content)) echo '無'; else echo "$Content";?><br>--->
		<form action="" method="post" name="inputform">
			<input type="submit" name="Confirm" value="確定送出">&nbsp;
			<input type ="button" onclick="history.back()" value="回上頁">
		</form>
	</div>
</body>
</html>