<?php
session_start();

//VARS TO SET
$username = 'usrename'; //sender's username
$time_between_message = 1; //time to pass between two message send by the same user
$message_max_length = 200; //max length of a message


if($_GET['message'] != '' && strlen($_GET['msg']) <= $message_max_length) {
$message = [$username => htmlspecialchars($_GET['msg'])];
  if(time() - $_SESSION['lastmsginchat'] >= $time_between_message) {
    $msgs = apc_fetch('chat');
    foreach($msgs as $time => $msg) {
      if((microtime(true) - $time) >= 5) {
      unset($msgs[$time]);
      }
    }
    $msgs[''.microtime(true).''] = $message;
    apc_store('chat', $msgs);
}
$_SESSION['lastmsginchat'] = time();
}
?>
