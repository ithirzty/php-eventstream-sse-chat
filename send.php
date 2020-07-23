<?php
session_start();

//VARS TO SET
$username = 'SENDER\'S USERNAME';



if(strlen($_GET['msg']) <= 200) {
$msg = [$username => htmlspecialchars($_GET['msg'])];
  if(time() - $_SESSION['lastmsginchat'] >= 1) {
    $msgs = apc_fetch('chat');
    foreach($msgs as $time => $msg) {
      if((microtime(true) - $time) >= 5) {
      unset($msgs[$time]);
      }
    }
    $msgs[''.microtime(true).''] = $msg;
    apc_store('chat', $msgs);
}
$_SESSION['lastmsginchat'] = time();
}
?>
