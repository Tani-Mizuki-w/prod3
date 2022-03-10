<!DOCTYPE html>
<html lang="ja">
<head>
  <title>test</title>
<meta charset="utf-8">
<link rel="stylesheet" href="hide.css">
</head>
<body>
<?php
/*PostgreSQLと接続*/
$dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
    or die('Could not connect: ' . pg_last_error());
#日付を取得
$current_date = date("Y-m-d H:i");
/*textareaの内容を変数に代入*/
if (isset($_POST['content']) && strlen($_POST['content'])>0){
    $content = $_POST['content'];
}

/*テーブルに登録*/
if (isset($content)){
    $sql = "insert into ww_post(content, send_time) values ('" . $content . "','".$current_date."');";
    $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
}

/*テーブル内の内容を取得して表示*/
$query = "select content, send_time from ww_post order " . "by pid desc;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
while ($line = pg_fetch_row($result)){
    echo "<p>";
    echo $line[0], $line[1];
    echo "</p>";
}
?>

<p><a href="./post_home.php">戻る</a></p>
</body>
</html>
