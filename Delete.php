<?php
// 使用者點選放棄修改按鈕
//if (isset($_GET['delete'])) header("Location: super_index.php");
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
$sqlcmd = "delete from cart WHERE seqno='$Seqno'";
$result = updatedb($sqlcmd, $db_conn);
header("Location: cart.php");

?>
