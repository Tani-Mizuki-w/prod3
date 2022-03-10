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
      $sql="select pid,uname,word from ww_profile;";
      $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
      echo "\t<tr><th>名前</th><th>自己紹介</th></tr>\n";
      while ($line = pg_fetch_row($result)){
          echo "\t<tr>\n";
          echo "\t\t<td>{$line[1]}</td>\n";
          echo "\t\t<td>{$line[2]}</td>\n";
          echo "\t</tr>\n";
          $pid = $line[0];
          $link = "https://gms.gdl.jp/~tani/werewolf/profile?page_id=".$pid;
          echo "<a href=". $link ."> メッセージを見る<br> </a>";
      }



?>
</body>
</html>
