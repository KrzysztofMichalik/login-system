<?php
require_once('passwords.php');
// przez to ze zamkniete w funkcji brak dostepu do zmeinnej
require_once('init.php');

$isLogged = '';

function loginsys(array $post):array {
  $returned_arr = [];
  if (!empty($post['name']) && !empty($post['pswd']) && empty($post['logOut'])) {
    $pass_array = getCredentials();

    for ($i=0; $i < count($pass_array); $i++) {
      if($pass_array[$i][0] == $post['name'])  {
        $_SESSION['name'] = $post['name'];
      }
    }

    for ($i=0; $i < count($pass_array); $i++) {
      if($pass_array[$i][1] == $post['pswd']){
        $_SESSION['pswd'] = $post['pswd'];
      }
    }


    if ( (empty($_SESSION['name'])) && (!empty($_SESSION['pswd'])) ) {
      $html_result = '<div class="container">'.
      '<div class="row justify-content-md-center">'.
      '<div class="col-md-auto alert alert-danger" role="alert">'.
      '<h1>Podałeś złą nazwę użytkownika</h1>'.
      '</div></div></div>';
       $isLogged = false;

       array_push($returned_arr, $isLogged, $html_result);
       unset($_SESSION['pswd']);
       return $returned_arr;


    } elseif( (empty($_SESSION['pswd'])) && (!empty($_SESSION['name'])) ) {
      $html_result = '<div class="container">'.
      '<div class="row justify-content-md-center">'.
      '<div class="col-md-auto alert alert-danger" role="alert">'.
      '<h1>Podałeś złe hasło</h1>'.
      '</div></div></div>';
       $isLogged = false;

       array_push($returned_arr, $isLogged, $html_result);
       unset($_SESSION['name']);
       return $returned_arr;

    } elseif( (empty($_SESSION['pswd'])) && (empty($_SESSION['name'])) ) {
      var_dump($_SESSION);
      $html_result = '<div class="container">'.
      '<div class="row justify-content-md-center">'.
      '<div class="col-md-auto alert alert-danger" role="alert">'.
      '<h1>Podałeś złe hasło i  nazwę użytkownika</h1>'.
      '</div></div></div>';
       $isLogged = false;

       array_push($returned_arr, $isLogged, $html_result);
       return $returned_arr;

    }  elseif(!empty($_SESSION['name']) && !empty($_SESSION['pswd'])) {
      $html_result = '<div class="container">'.
      '<div class="row justify-content-md-center">'.
      '<div class="col-md-auto alert alert-success" role="alert">'.
      '<h1>Zalogowałeś się </h1>'.
      '</div></div></div>';
       $isLogged = true;

       array_push($returned_arr, $isLogged, $html_result);
       return $returned_arr;
     }
   } elseif(!empty($_POST['logOut']) ){

     $html_result ='<div class="container">'.
     '<div class="row justify-content-md-center">'.
     '<div class="col-md-auto alert alert-danger" role="alert">'.
     '<h1>Zostałeś wylogowany</h1>'.
     '</div></div></div>';
     $isLogged = false;
     array_push($returned_arr, $isLogged, $html_result);
     unset($_SESSION['name']);
     unset($_SESSION['pswd']);
     return $returned_arr;
   }
}

 ?>
