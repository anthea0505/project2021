<?php
header('Content-Type: text/html; charset=utf-8');
require_once("gpsvars.php");
require_once("configure.php");
require_once("db_func.php");
$Name = filter_input(INPUT_POST, 'name');
$Gender = filter_input(INPUT_POST, 'gender');
$Email = filter_input(INPUT_POST, 'email');
$Birthday = filter_input(INPUT_POST, 'birthday');
$Loginid = filter_input(INPUT_POST, 'loginid');
$Password = filter_input(INPUT_POST, 'password');
$Phone = filter_input(INPUT_POST, 'phone');

if (isset($_POST['Submit'])) 
{   // 確認按鈕
    if (empty($Name)){
		$ErrMsg = '姓名不可為空白\n';
		echo "<script>alert('$ErrMsg'); </script>";
	}
	if (empty($Gender)){
		$ErrMsg = '性別不可為空白\n';
		echo "<script>alert('$ErrMsg'); </script>";
	}
	/*if (empty($Email)){
		$ErrMsg = '信箱不可為空白\n';
		echo "<script>alert('$ErrMsg'); </script>";
	}*/
	if (!filter_var($Email, FILTER_VALIDATE_EMAIL)||empty($Email)){
		$ErrMsg = '信箱格式錯誤或空白\n';
		echo "<script>alert('$ErrMsg'); </script>";
	}
	if (empty($Birthday)){
		$ErrMsg = '生日不可為空白\n';
		echo "<script>alert('$ErrMsg'); </script>";
	}
	if (empty($Loginid)){
		$ErrMsg = '帳號不可為空白\n';
		echo "<script>alert('$ErrMsg'); </script>";
	}
    if (empty($Password)){
		$ErrMsg = '密碼不可為空白\n';
		echo "<script>alert('$ErrMsg'); </script>";
	}
    /*if (empty($Phone)){
		$ErrMsg = '電話格式錯誤或空白\n';
		echo "<script>alert('$ErrMsg'); </script>";
    }*/
	
	if (mb_strlen($Name,"utf-8")>30) $Name=mb_substr($Name,0,30,"utf-8");
	if (mb_strlen($Phone,"utf-8")>15) $Phone=mb_substr($Phone,0,15,"utf-8"); 
	if (mb_strlen($Email,"utf-8")>40) 
	{
		$str1=mb_substr($Email,0,30,"utf-8");
		$str2=mb_substr($Email,31,10,"utf-8");
		$Email=$str1.$str2;
	}
	if (!preg_match("/^09[0-9]{8}$/","$Phone")||empty($Phone)){
		$ErrMsg = '電話格式錯誤或空白\n';
		echo "<script>alert('$ErrMsg'); </script>";
	}
    if (empty($ErrMsg)) 
	{
		$Password=sha1($Password);
		$conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
		// $conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
		// if (mysqli_connect_error())
		// {
			// die('Connect Error ('. mysqli_connect_errno() .') '
				// . mysqli_connect_error());
		// }
		// else
		// {
			$sql = "INSERT INTO customer (name,gender,email,birthday,loginid,password,phone,valid)
				values ('$Name','$Gender','$Email','$Birthday','$Loginid','$Password','$Phone','Y')";
			$result = updatedb($sql, $conn);
			// if ($conn->query($sql))
			// {
				echo "3秒後回到登入畫面";
				header("refresh:3;url=login.php");
			// }
			// else
			// {
				// echo "Error: ". $sql ." ". $conn->error;
			// }
			// $conn->close();
//		}
		
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
<title>會員註冊</title>
</head>
<body style="color:black;"bgcolor="#D7C4BB"onload="setFocus()">
<div style="text-align:center;margin-top:30px;">
	<div style="width:40%;height:800px;margin:40px auto;background:white;font-size:25px;font-weight:bold;float:center;">
		<div style="text-align:left;">
		<h2>&nbsp;&nbsp;&nbsp;會員註冊</h2>
		<form method="POST" name="LoginForm" action="">
			&nbsp;&nbsp;&nbsp;用戶姓名Name
			<br>
			&nbsp;&nbsp;
			<input type="text" name="name"  size="30" maxlength="20"style="width:300px; height:30px;"/>
			<br><br>
			&nbsp;&nbsp;&nbsp;用戶性別Gender
			<br>
			&nbsp;&nbsp;
			<input type="radio" name="gender" id="Male" value="Male" size="50"<?php if($Gender=='Male') echo 'checked';?>><label for='Male'>生理男</label>
			<input type="radio" name="gender" id="Female" value="Female" size="50"<?php if($Gender=='Female') echo 'checked';?>><label for='Female'>生理女</label>
			<br><br>
			&nbsp;&nbsp;&nbsp;電子信箱Email
			<br>
			&nbsp;&nbsp;
			<input type="text" name="email"  size="30" maxlength="40" placeholder="123@example.com"style="width:300px; height:30px;"/>
			<br><br>
			&nbsp;&nbsp;&nbsp;出生日期Birthday
			<br>
			&nbsp;&nbsp;
			<input type="date" name="birthday"  size="30" maxlength="40" style="width:300px; height:30px;"/>
			<br><br>
			&nbsp;&nbsp;&nbsp;用戶帳號Account
			<br>
			&nbsp;&nbsp;
			<input type="text" name="loginid" size="30" maxlength="16" style="width:300px; height:30px;"/>
			<br><br>
			&nbsp;&nbsp;&nbsp;用戶密碼Password
			<br>
			&nbsp;&nbsp;
			<input type="password" name="password" size="30" maxlength="16"style="width:300px; height:30px;"/>
			<br><br>
			&nbsp;&nbsp;&nbsp;連絡電話Phone
			<br>
			&nbsp;&nbsp;
			<input type="text" name="phone" size="30" maxlength="15"style="width:300px; height:30px;"/>
			<br><br>
			&nbsp;&nbsp;
			<input type="submit" name="Submit" value="確認送出"style="color:#F0F0F0;font-size:25px;width:150px;height:30px;border:2px blue none;background-color:#272727">
			&nbsp;&nbsp;<a href="index.php"style="color:#9D9D9D;">回首頁</a>
		</form>
		<br>
		</div>
	</div>
</div>
</body>
</html>
