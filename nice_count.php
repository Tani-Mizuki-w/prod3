<?php

function return_nice($pid){
  /*PostgreSQLと接続*/
  $dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
      or die('Could not connect: ' . pg_last_error());

  /*pidごとのcountを取得*/
  if (isset($pid)){
      $sql = "select count(pid) from ww_nice WHERE pid=$1;";
      $result = pg_query_params($dbconn, $sql, array($pid)) or die('Query failed: ' . pg_last_error());
      $count = pg_fetch_row($result);
      if ($count > 0){
        return $count[0];
      }
      else{
        return 0;
      }
  }
}
?>
