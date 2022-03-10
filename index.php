<?php
 session_start();
 if (isset($_SESSION['uns'])) {
   $uns=$_SESSION['uns'];
 }
 if (isset($_SESSION['pws'])) {
   $pws=$_SESSION['pws'];
 }
 if (isset($_POST['unf'])){$uns=$_POST['unf'];}
 if (isset($_POST['pwf'])){$pws=$_POST['pwf'];}
 $aflag=0;
 if (isset($uns) &&isset($pws)){
   $sql="select * from ww_login where uname='". $uns . "';";
   $dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
       or die('Could not connect: ' . pg_last_error());
   $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
   if(pg_num_rows($result)==1){
     $row = pg_fetch_row($result);
     if (password_verify($pws, $row[3])){
       $_SESSION['uns']=$uns;
       $_SESSION['pws']=$pws;
       $_SESSION['uid']=$row[0];
       $aflag=1;
     }
   }
 }
 if($aflag==0){
   header('location: ./login.html');
 }
?>
<html>
<head>
  <title>
    index
  </title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<!--<link rel="stylesheet" href="test3.css" />-->
<link rel="stylesheet" type="text/css" href="test3.php" />
<script type="text/javascript">
  function LinkClick() {
    var elemList = document.getElementsByClassName("FadeFrame");
    for (i = 0; i < elemList.length; i++){
      elemList[i].classList.add("fadeout");
    }
  }
</script>

</head>
<body>
<?php

/*PostgreSQLと接続*/
$dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
    or die('Could not connect: ' . pg_last_error());
#日付を取得
$current_date = date("Y-m-d H:i");

/*
#時間を取得し、段階的に投稿を消す
$time = date("H:i:s");
require "seconds.php";
$second = hour_to_sec($time);
if ($second >= 79200){
  $disappear_time = 108000 - $second;
}
else{
  $disappear_time = 21600 - $second;
}

*/

$test_time = 20;


/*textareaの内容を変数に代入*/
if (isset($_POST['content']) && strlen($_POST['content'])>0){
    $content = $_POST['content'];
}
#echo $disappear_time;
/*テーブルに登録*/
if (isset($content)){
    $sql = "insert into ww_post(uid,uname,content,send_time) values ('" . $_SESSION['uid'] . "','" . $_SESSION['uns'] . "','" . $content . "','".$current_date."');";
    $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
}

#いいねをカウントする関数を動かす
require "nice_count.php";

#22:00 ~ 6:00までの間のみ表示
#if ($second < 21600 AND 79200 < $second){

#フォローしている人のidを取得
#$query = "select your_id from ww_follow where my_id =  '".$_SESSION['uid']."';";
#$result = pg_query($query) or die('Query failed: ' . pg_last_error());
#while ($line = pg_fetch_row($result)){
/*テーブル内の内容を取得して表示*/
#$query = "select uid,pid,uname,content,send_time from ww_post where uid = $line[0] order by pid desc;";
$query = "select uid,pid,uname,content,send_time from ww_post order by pid desc;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
while ($line = pg_fetch_row($result)){
    echo "<div class=\"FadeFrame\">";
    echo '<div>';
    echo '<p>';
    echo $line[2], $line[3];
    echo '</p>';
    echo '<form method="POST" action="./nice_data.php">';
    echo '<input type="hidden" name="post_id" value="'. $line[1] .'">';
    echo '<button type="submit">';
    echo 'いいね';
    echo '</button>';
    echo '</form>';
    echo '<p>';
    echo return_nice($line[1]);
    echo '</p>';
    echo '</div>';
    $page_id = "$line[1]";
    $link = "https://gms.gdl.jp/~tani/werewolf/message?page_id=".$page_id;
    echo "<a href=". $link ."> メッセージを見る<br> </a>";

    echo "</p>";
    echo "</div>";
    echo '<script type="text/javascript">',
     'LinkClick();',
     '</script>';

}
#}
echo "<a href="."post_home.html".">呟く</a>";
 ?>
</body>
</html>
