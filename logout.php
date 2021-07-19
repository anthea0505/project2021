<?php
session_start();
session_destroy();
header("Refresh:3;url=login.php")

?>
<html>
<head>
<title>Sign out</title>
</head>
<body style="color:black;"bgcolor="#D7C4BB">
<div style="width:40%;height:300px;margin:40px auto;background:white;font-size:25px;font-weight:bold;float:center;">
<br><br><br><center>感謝您的瀏覽，將於3秒後回到登入畫面!</center>
</div>
</body>
</html>