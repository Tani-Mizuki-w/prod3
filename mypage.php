<?php
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
require "follow_count.php";
  $dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
      or die('Could not connect: ' . pg_last_error());
      $sql="select uid,uname,word from ww_profile;";
      $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
      while ($line = pg_fetch_row($result)){
          echo $line[1];
          echo $line[2];
          echo $line[0];
          #$uid = $line[0];
          #$link = "https://gms.gdl.jp/~tani/werewolf/follow?page_id=".$uid;
          #echo "<a href=". $link ."> フォローする<br> </a>";
          #フォローボタン
          echo '<div>';
          echo '<p>';
          echo '</p>';
          echo '<form method="POST" action="./follow_data.php">';
          echo '<input type="hidden" name="post_id" value="'. $line[0] .'">';
          echo '<button type="submit">';
          echo 'follow';
          echo '</button>';
          echo '</form>';
          echo '<p>';
          echo "フォロー：";
          echo return_follow($line[0]);
          echo '</p>';
          echo '<p>';
          echo "フォロワー:";
          echo return_follower($line[0]);
          echo '</p>';
          echo '</div>';

      }


      /*過去の投稿をテーブル内の内容を取得して表示*/
      $query = "select content,send_time,pid,uname from ww_post where uid = '".$_SESSION['uid']."';";
      $result = pg_query($query) or die('Query failed: ' . pg_last_error());
      while ($line = pg_fetch_row($result)){
          echo "<p>";
          echo $line[0], $line[1];
          echo "</p>";
          echo '<form method="POST" action="./delete.php">';
          echo '<input type="hidden" name="post_id" value="'. $line[2] .'">';
          echo '<button type="submit">';
          echo '投稿削除';
          echo '</button>';
          echo '</form>';
      }
?>
</body>
</html>
