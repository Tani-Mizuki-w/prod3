<<?php
session_start()
 ?>
<html>
<head>
  <title>
    profile一覧
  </title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
</head>
<body>

<?php
  $dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
      or die('Could not connect: ' . pg_last_error());

      $your_id= $_GET['page_id'];
      $sql = "insert into ww_follow(my_id,your_id) values ('" . $_SESSION['uid'] . "','" . $your_id . "');";
      $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
      
?>
</body>
</html>
