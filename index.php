<?php
require_once('init.php');
require_once('login.php');
require_once('header.php');
require_once('nav.php');

// if(!empty($_POST) ) {
//   if (!empty($_POST['name']) && !empty($_POST['pswd'])) {
//     $html = loginsys($_POST, $db);
//   } else{
//     $html = insertUser($_POST['newUserName'], $_POST['newUserPswd'], $db);
//   }
// } else {
//   // ustawiamy tablice na wypadek braku spełnienia jakiegokolwiek z powyzszych warunków, i ustawiamy jej indeks zerowy na false.
//   $html = array();
//   $html[0] = false;
// }

?>

    <div class="container">
      <div class="row">
        <div class="pt-5 mx-auto">
          <?php
            if(!empty($_POST)) {

              echo $html[1];

            }
          ?>
        </div>
      </div>
    </div>
  </body>
</html>
