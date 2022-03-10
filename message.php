<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja"> <head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<link rel="stylesheet" href="../stylesheet.css">
<title>ユーザー情報</title>
</head>
<body>

   <?php
   $dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
       or die('Could not connect: ' . pg_last_error());

   $pid= $_GET['page_id'];
   $query = "select uname,content from ww_post where pid = '".$pid."';";
   $result = pg_query($query) or die('Query failed: ' . pg_last_error());
   while ($line = pg_fetch_row($result)){
     echo "$line[0]";
     echo "さん:";
     echo "$line[1]<br/>";
   }

   ?>
  <form method="POST">
  メッセージを送る: <input type="text "name="message"><br />
  <input type="submit" value="送信">
  </form>
<?php

  #$receive_name = $_GET['page_name'];

  if(isset($_POST['message'])>0){
    #urlから変数をもってくる
    $message=$_POST['message'];
    $query="insert into ww_message(pid,message_text,send_name,receive_name) values ('" .$pid . "','" .$message . "','" . $_SESSION['uns'] . "'
    ,'" . $receive_name . "');";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());

  }

  #コメント表示
  $query="select send_name,message_text from ww_message where pid = '" . $pid . "'";
  $result = pg_query($query) or die('Query failed: ' . pg_last_error());
  while ($line = pg_fetch_row($result)){
    echo $_SESSION['uns'];
    echo ":$line[1]<br />";
  }

?>

</body>
</html>
