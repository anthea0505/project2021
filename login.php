<?php
header('Content-Type: text/html; charset=utf-8');
?>
<?php
function userauth($ID, $PWD, $db_conn) {
    $sqlcmd = "SELECT * FROM customer WHERE loginid='$ID' AND valid='Y'";
    $rs = querydb($sqlcmd, $db_conn);
    $retcode = 0;
    if (count($rs) > 0) {
        $Password = sha1($PWD);
        if ($Password == $rs[0]['password']) $retcode = 1;
    }
    return $retcode;
}
session_start();
session_unset();
require_once("gpsvars.php");
$ErrMsg = "";
if (!isset($ID)) $ID = "";
$ErrMsg = '';
if (isset($_POST['Submit']) && !empty($_POST['Submit'])) {
	if (isset($Submit)) {
		require ("configure.php");
		require ("db_func.php");
		$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
		if (strlen($ID) > 0 && strlen($ID)<=16 && $ID==addslashes($ID)) {
			$Authorized = userauth($ID,$PWD,$db_conn);
			if ($Authorized) {
				$sqlcmd = "SELECT * FROM customer WHERE loginid='$ID' AND valid='Y'";
				$rs = querydb($sqlcmd, $db_conn);
				$LoginID = $rs[0]['loginid'];
				$_SESSION['LoginID'] = $LoginID;
				$_SESSION['A']="customer";
				$Name = $rs[0]['name'];
				$_SESSION['name'] = $Name;
				header ("Location:index.php");
				exit();
			}
			//$ErrMsg ='帳號或密碼輸入錯誤';
			echo "<script>alert('帳號或密碼輸入錯誤'); </script>";
		} else {
			//$ErrMsg ='ID錯誤，您並非合法使用者或是使用權已被停止';
			echo "<script>alert('ID錯誤，您並非合法使用者或是使用權已被停止'); </script>";
		}
		/*if (empty($ErrMsg)){
			//$ErrMsg ='登入錯誤';
			echo "<script>alert('登入錯誤'); </script>";
		}*/
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
<title>會員登入</title>
</head>
<body style="color:black;"bgcolor="#D7C4BB"onload="setFocus()">
<div style="text-align:center;margin-top:30px;">
	<div style="width:40%;height:600px;margin:40px auto;background:white;font-size:25px;font-weight:bold;float:center;">
		<div style="text-align:left;">
			<h2>&nbsp;&nbsp;&nbsp;會員登入</h2>
			<form method="POST" name="LoginForm" action="">
			&nbsp;&nbsp;&nbsp;帳號Account
			<br>
			&nbsp;&nbsp;
			<input type="text" name="ID" size="30" maxlength="16"value="<?php echo $ID; ?>" style="width:300px; height:30px;"/>
			<br><br>
			&nbsp;&nbsp;&nbsp;密碼Password
			<br>
			&nbsp;&nbsp;
			<input type="password" name="PWD" size="30" maxlength="16"style="width:300px; height:30px;"/>
			<br><br>
			&nbsp;&nbsp;&nbsp;新用戶&nbsp;&nbsp;<a href="register.php"style="color:#9D9D9D;">加入會員</a>
			<br><br>
			&nbsp;&nbsp;
			<input type="submit" name="Submit" value="會員登入"style="color:#F0F0F0;font-size:25px;width:150px;height:30px;border:2px blue none;background-color:#272727">
			&nbsp;&nbsp;<a href="index.php"style="color:#9D9D9D;">回首頁</a>
			</form>
			
			<br>
			<?php if (!empty($ErrMsg)) echo $ErrMsg; ?>
		</div>
	</div>
</div>
</body>
</html>
