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

$query = $db->prepare('SELECT * FROM users WHERE login = :login');
$query->bindparam(':login', $_SESSION['name']);
$query->execute();
$userData = $query->fetch();


function editUser ($login, $pass, $email, $age, $phone, $city, $db) {
  $query = $db->prepare('UPDATE users SET login = :login, pass = :pass, email = :email, age = :age, phone = :phone, city = :city WHERE login = :name'  );

  $pass = password_hash($pass, PASSWORD_BCRYPT);
  $query->bindparam(':name', $_SESSION['name']);
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
            '<h1>Twoje dane zostały zmienione</h1>'.
            '</div></div></div>';
  print $html_result;
  $db = null;
}

?>
<!--  -->

<div class="container register-form mt-5">
  <form class="form " method="POST" acction="editUser.php">
      <div class="note">
          <p>Edit form</p>
      </div>

      <div class="form-content">
          <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="newUserName">User name</label>
                      <input type="text" class="form-control" name="newUserName" value="<?php print $userData['login'] ?>" required/>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="newUserEmail">Email</label>
                      <input type="text" class="form-control" name="newUserEmail" value="<?php print $userData['email'] ?>" required/>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="newUserPswd">Passoword</label>
                      <input type="password" class="form-control" name="newUserPswd" placeholder="Your new password" required/>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="newUserAge">Age</label>
                      <input type="text" class="form-control" name="newUserAge" value="<?php print $userData['age'] ?>" required/>
                  </div>
              </div>
              <div class="col-md-6">
                    <div class="form-group">
                      <label for="newUserCity">City</label>
                        <input type="text" class="form-control" name="newUserCity" value="<?php print $userData['city'] ?>" required/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="newUserPhone">Phone</label>
                        <input type="text" class="form-control" name="newUserPhone" value="<?php print $userData['phone'] ?>" required/>
                    </div>
                </div>
          </div>
          <div>
            <button type="submit" name="submitChanges" class="btnSubmit">Submit</button>
          </div>
      </div>
  </form>
  <?php

  if (isset($_POST['submitChanges'])) {
    try {
      editUser($_POST['newUserName'],
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
</div>
