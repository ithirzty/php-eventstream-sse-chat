  <?php
//Project made from https://github.com/ithirzty/php-eventstream-sse-chat
  date_default_timezone_set("Europe/Paris");
  header("Content-Type: text/event-stream\n\n");
    $nb = -1;
    while ($nb < 30) {
      $chat = apc_fetch('chat');
      $chattime = end(array_keys($chat));
      if($nb === -1) {
        $lasttime = $chattime;
        $nb = 0;
      }
      if($lasttime < $chattime) {
        $newchat = [];
      foreach($chat as $time => $msg){
        if ($time > $lasttime) {
        foreach($msg as $username => $message) {
          $return = ['message' => $message, 'username' => $username, 'time' => $time];
        echo 'data: '.json_encode($return)."\n\n";
      }
    }
    }
    $lasttime = $chattime;
    }
    echo "event: ping\n";
    $curDate = date(DATE_ISO8601);
    echo 'data: {"time": "' . $curDate . '"}'."\n\n";
      ob_end_flush();
      flush();
      $nb++;
      sleep(1);
    }
