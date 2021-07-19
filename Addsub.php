<?php
$Seqno = $_GET['Seqno'];

session_start();
$loginID = $_SESSION['LoginID'];
$Name = $_SESSION['name'];

// Authentication 認證
require_once("auth.php");

// 變數及函式處理，請注意其順序
require_once("gpsvars.php");
require_once("configure.php");
require_once("db_func.php");
$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);


$sqlcmd = "SELECT * FROM cart WHERE seqno='$Seqno'";
$rs = querydb($sqlcmd, $db_conn);
$Pd_number = $rs[0]['pd_number'];


if(isset($_GET['addsub1'])){
	$Pd_number += 1;
	$sqlcmd="UPDATE cart SET pd_number='$Pd_number' WHERE seqno='$Seqno'";

}else{
	if($Pd_number>1){
		$Pd_number -= 1;
		$sqlcmd="UPDATE cart SET pd_number='$Pd_number' WHERE seqno='$Seqno'";	
	}else{
		$sqlcmd = "delete from cart WHERE seqno='$Seqno'";
	}
}
$result = updatedb($sqlcmd, $db_conn);
header("Location: cart.php");

?>
