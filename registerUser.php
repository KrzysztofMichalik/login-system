<?php
require_once('init.php');
require_once('header.php');
require_once('nav.php');


function insertUser ($login, $pass, $email, $age, $phone, $city, $db) {
  $returned_arr = [];
  $query = $db->prepare('INSERT INTO users (login, pass, email, age, phone, city) VALUES (:login, :pass, :email, :age, :phone, :city)');
  $pass = password_hash($pass, PASSWORD_BCRYPT);
  $query->bindparam(':login', $login );
  $query->bindparam(':email', $email);
  $query->bindparam(':pass', $pass);
  $query->bindparam(':age', $age);
  $query->bindparam(':phone', $phone);
  $query->bindparam(':city', $city);

  $result = $query->execute();

  $html_result = '<div class="container">'.
            '<div class="row justify-content-md-center">'.
            '<div class="col-md-auto alert alert-success" role="alert">'.
            '<h1>Utworzyles konto teraz możesz się z powodzeniem zalogować</h1>'.
            '</div></div></div>';
  print $html_result;
  $db = null;

  }

?>
<div class="container register-form mt-5">
      <form class="form" method="POST" acction="registerUser.php">
          <div class="note">
              <p>Register form</p>
          </div>

          <div class="form-content">
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <input type="text" class="form-control" placeholder="Your Name" name="newUserName" required/>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <input type="email" class="form-control" placeholder="Your email" name="newUserEmail" required/>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <input type="password" class="form-control" placeholder="Your Password" name="newUserPswd" required/>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <input type="number" class="form-control" placeholder="Your Age" name="newUserAge" required/>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <input type="text" class="form-control" placeholder="Your Phone number" name="newUserPhone" required/>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <input type="text" class="form-control" placeholder="Your localisation" name="newUserCity" required/>
                      </div>
                  </div>
              </div>
              <div>
                <button type="submit" class="btnSubmit" name='newUserRegistred'>Submit</button>
              </div>
          </div>
      </form>
  </div>
  <?php

    if(isset($_POST['newUserRegistred'])){
      try {
        insertUser(
        $_POST['newUserName'],
        $_POST['newUserPswd'],
        $_POST['newUserEmail'],
        $_POST['newUserAge'],
        $_POST['newUserPhone'],
        $_POST['newUserCity'],
        $db);

      } catch (PDOException $e) {
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
