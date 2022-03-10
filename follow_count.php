<?php

function return_follow($my_id){
  /*PostgreSQLと接続*/
  $dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
      or die('Could not connect: ' . pg_last_error());

  /*pidごとのcountを取得*/
  if (isset($my_id)){
      $sql = "select count(my_id) from ww_follow WHERE my_id=$1 GROUP BY my_id;";
      $result = pg_query_params($dbconn, $sql, array($my_id)) or die('Query failed: ' . pg_last_error());
      $count = pg_fetch_row($result);
      if ($count > 0){
        return $count[0];
      }
      else{
        return 0;
      }
  }
}

function return_follower($your_id){
  /*PostgreSQLと接続*/
  $dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
      or die('Could not connect: ' . pg_last_error());

  /*pidごとのcountを取得*/
  if (isset($your_id)){
      $sql = "select count(your_id) from ww_follow WHERE your_id=$1 GROUP BY your_id;";
      $result = pg_query_params($dbconn, $sql, array($your_id)) or die('Query failed: ' . pg_last_error());
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
