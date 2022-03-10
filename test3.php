<?php
  header('Content-Type: text/css; charset=utf-8');
  include_once( 'index.php' ); // 設定の有るファイルを読み込むとか？
?>
.FadeFrame {
  border:1px solid #ff6a00;
  margin: 1rem 1rem 1rem 1rem;
}

  .FadeFrame.fadeout {
    /*時間を変更する*/
    /*投稿ボタンをフェードアウトボタンにする*/
    animation: fadein-keyframes <?php echo $test_time; ?>s ease 0s 1 forwards;
  }

  @keyframes fadein-keyframes {
    0% {
      opacity: 1;
    }

    100% {
      opacity: 0;
    }
  }

  #text-button {
    display: block;
    cursor: pointer;
    width: 160px;
    text-align: center;
    border: 1px solid #232323;
  }
