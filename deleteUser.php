<?php
require_once('init.php');
require_once('header.php');
require_once('nav.php');

if (empty($_SESSION['name'])) {
  echo '<div class="container mt-5">'.
        '<div class="row justify-content-md-center">'.
        '<div class="col-md-auto alert alert-danger" role="alert">'.
        '<h1>Zaloguj się!</h1>'.
        '</div></div></div>';
  die;
}


function deleteUser($login, $pass, $db){
  $query = $db->prepare('SELECT pass FROM users WHERE login = ?');
  $query->execute([$login]);
  $hash = $query->fetch();


  if (password_verify($pass, $hash['pass'])) {
    $query = $db->prepare('DELETE FROM users WHERE login = :login');
    $query->bindparam(':login', $login );
    $query->execute();
    $html_result = '<div class="container">'.
              '<div class="row justify-content-md-center">'.
              '<div class="col-md-auto alert alert-success" role="alert">'.
              '<h1>Twoje konto zostało usunięte</h1>'.
              '</div></div></div>';
    $db = null;
    unset($_SESSION['name']);
    unset($_SESSION['pswd']);

  } else {
    throw new Exception('Podałeś złe hasło!');
  }
}

?>
<div class="container register-form mt-5">
  <div class="col-6 mx-auto">
    <form class="form" method="POST" acction="registerUser.php">
      <div class="note">
          <p>REMOVE ACCOUNT</p>
      </div>
      <div class="form-group">
        <div class="form-content">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="login">User Name</label>
                <input type="text" class="form-control" name="login" value="<?php echo $_SESSION['name'] ?>" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="pswd">Password</label>
                <input type="password" class="form-control" name="pswd" placeholder="Password" required>
              </div>
            </div>
            <div class="col-md-6 mt-3">
              <div class="form-group">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" name="checkbox" required>
                  <label class="form-check-label" for="checkbox">I am sure</label>
                </div>
              </div>
            </div>
            <div class="col-md-6">

              <button type="submit" class="mt-2 btn btn-primary" name="removeAcc">Submit</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php

  if(isset($_POST['removeAcc']) ){
    try {
      deleteUser(
        $_POST['login'],
        $_POST['pswd'],
        $db);
        header('./index.php');
    } catch (Exception $e) {
      $html_result = '<div class="container">'.
            '<div class="row justify-content-md-center">'.
            '<div class="col-md-auto alert alert-danger" role="alert">'.
            '<h1>'. $e->getMessage() . '</h1>'.
            '</div></div></div>';
      print $html_result;
      $db = null;
    }
  }
 ?>
