<!DOCTYPE html>
<html lang="ja">
<head>
  <title>test_nice</title>
<meta charset="utf-8">
<link rel="stylesheet" href="hide.css">
</head>
<body>
<?php
session_start();

$dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
    or die('Could not connect: ' . pg_last_error());

// いいねボタンからのvalueの値を取得
if (isset($_POST['post_id']) && strlen($_POST['post_id'])>0){
    $pid = (int) $_POST['post_id'];
}

$uid = $_SESSION['uid'];

if (isset($pid) && isset($uid)){
    $sql1 = "select uid from ww_nice WHERE pid=$1 AND uid=$2;";
    $result1 = pg_query_params($dbconn, $sql1, array($pid, $uid)) or die('Query failed: ' . pg_last_error());

    // いいね解除
    if (pg_fetch_row($result1) > 0){
        $sql2 = "delete from ww_nice where uid=$1 AND pid=$2;";
        $result2 = pg_query_params($dbconn, $sql2, array($uid, $pid)) or die('Query failed: ' . pg_last_error());
        echo '<p>いいね解除しました</p>';
    }
    // いいね登録
    else {
        $sql2 = "insert into ww_nice(uid, pid) values ($1, $2);";
        $result2 = pg_query_params($dbconn, $sql2, array($uid, $pid)) or die('Query failed: ' . pg_last_error());
        echo '<p>登録しました</p>';
    }
}


?>
<p><a href="./index.php">戻る</a></p>
</body>
</html>
