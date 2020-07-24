<?php
session_start();
if(isset($_GET['username']) and strlen($_GET['username']) < 200) {
  $_SESSION['username'] = htmlspecialchars($_GET['username']);
}
 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>alois xyz chat template</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
     <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <main>

  <section id="chat" class="chat">

  <div id="chatinn">

  </div>

  </section>

<input id="input" type="text" placeholder="Message" style="color:black" autocomplete="off" />
<button onclick="send($('#input').val());"><i class="material-icons">send</i></button>

</main>
    <script>
    <?php
if($_SESSION['username'] == null) {
  echo '
var username = prompt("Please enter your username:", "guest");
if(username != "") {
  $.ajax({
        url: "?username="+username,
        type: \'get\',
        async: false
     });
}  ';
}
    ?>
 $('#input').keypress(function(e) {
    var keycode = (e.keyCode ? e.keyCode : e.which);
    if (keycode == '13') {
        send($('#input').val());
    }
});
function send(msg) {
  $.get('./send.php?msg='+encodeURIComponent(msg));
  $('#input').val('');
  $('#input').focus();
}

var evtSource = new EventSource("./refresh.php");
evtSource.onmessage = function(e) {
  item = JSON.parse(e.data);
      if(item.message != undefined) {
$('#chatinn').append('<p><strong>'+item.username+'</strong>:<span class="message"> '+item.message+'</span></p>');
      $("#chat").animate({ scrollTop: $("#chatinn").height() }, "slow");
    }
};
    </script>
  </body>
</html>
