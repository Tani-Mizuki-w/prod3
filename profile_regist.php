<html>
<head>
  <title>
    profile form
  </title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
</head>
<body>
<form method="POST" action="./mypage.php">
ユーザ名: <input type="text" name="uname" size="40"><br>
自己紹介:<input type="text" name="word" size="40"><br>
<input type="submit" value="登録">
</form>


<?php
if (isset($_POST['uname'])&isset($_POST['word'])){
  $uname=$_POST['uname'];
  $word=$_POST['word'];
  $dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
      or die('Could not connect: ' . pg_last_error());
  #$sql="insert into ww_profile (uname,word) set uname='".$uname . "',word='" .$word . "';";
  $sql="insert into ww_profile (uname,word) values ('".$uname . "','" .$word . "');";
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
}
?>
</body>
</html>
