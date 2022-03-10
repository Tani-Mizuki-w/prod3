<?php
session_start()
?>
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

// followボタンからのvalueの値を取得
if (isset($_POST['post_id']) && strlen($_POST['post_id'])>0){
  #フォローされる人のuidを取得
    $your_id = (int) $_POST['post_id'];
}
#フォローする人のuidを取得
$my_id = $_SESSION['uid'];

if (isset($my_id) && isset($your_id)){
    $sql1 = "select my_id from ww_follow WHERE your_id=$1 AND my_id=$2;";
    $result1 = pg_query_params($dbconn, $sql1, array($your_id, $my_id)) or die('Query failed: ' . pg_last_error());

    // フォロー解除
    if (pg_fetch_row($result1) > 0){
        $sql2 = "delete from ww_follow where my_id=$1 AND your_id=$2;";
        $result2 = pg_query_params($dbconn, $sql2, array($my_id, $your_id)) or die('Query failed: ' . pg_last_error());
        echo '<p>followを解除しました</p>';
    }
    // フォロー登録
    else {
        $sql2 = "insert into ww_follow(my_id, your_id) values ($1, $2);";
        $result2 = pg_query_params($dbconn, $sql2, array($my_id, $your_id)) or die('Query failed: ' . pg_last_error());
        echo '<p>登録しました</p>';
    }
}


?>
<p><a href="./profile.php">戻る</a></p>
</body>
</html>
