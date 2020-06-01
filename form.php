<?php
require_once('init.php');
require_once('passwords.php');

$isLogged = '';

function loginsys(array $post):array {
  $returned_arr = [];
 // warunek sprawdzajacy czy formularz logowania został wypełniony i wysłany.
  if (!empty($post['name']) && !empty($post['pswd']) && empty($post['logOut'])) {

    $pass_array = getCredentials();
    // pod zmienną pass_array kryje się tablica, która pod jednym elementem trzyma dane w postaci user password

    unset($_SESSION['name']);
    unset($_SESSION['pswd']);
    // usuwamy te zmienne sesyjne na początku skryptu, żeby mieć pewność, że żadna zmienna z poprzedniej sesji nie zostanie wczytana.

    for ($i=0; $i < count($pass_array); $i++) {
      //  w tej pętli for jest zawarta cała logika logowania.

      if($pass_array[$i][0] == $post['name'])  {
        // Znaleziony użytkownik
        if($pass_array[$i][1] == $post['pswd']){
          // poprawne hasło
          $_SESSION['pswd'] = $post['pswd'];
          $_SESSION['name'] = $post['name'];
          $html_result = '<div class="container">'.
          '<div class="row justify-content-md-center">'.
          '<div class="col-md-auto alert alert-primary" role="alert">'.
          '<h1>Zalogowałeś się.</h1>'.
          '</div></div></div>';
           $isLogged = true;

           array_push($returned_arr, $isLogged, $html_result);

           return $returned_arr;
        } else {
          // $_SESSION['name'] = $post['name'];
          $html_result = '<div class="container">'.
          '<div class="row justify-content-md-center">'.
          '<div class="col-md-auto alert alert-danger" role="alert">'.
          '<h1>Podałeś złe hasło</h1>'.
          '</div></div></div>';
           $isLogged = false;

           array_push($returned_arr, $isLogged, $html_result);
           unset($_SESSION['name']);
           return $returned_arr;
        }
      }
    }
    $html_result = '<div class="container">'.
    '<div class="row justify-content-md-center">'.
    '<div class="col-md-auto alert alert-danger" role="alert">'.
    '<h1>Podałeś złe hasło i  nazwę użytkownika</h1>'.
    '</div></div></div>';
     $isLogged = false;

     array_push($returned_arr, $isLogged, $html_result);
     return $returned_arr;



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
