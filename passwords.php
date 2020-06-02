<?php
  require_once('init.php');


  function getCredentials($db){
    // pobieranie danych z pliku
    // $fileData = file_get_contents('users.txt');
    //
    // $arr = array_filter(explode("\n", $fileData));
    //
    // $pass_array = array();
    // foreach ($arr as $key => $value) {
    //   array_push($pass_array, explode(" ", $value));
    // }

    // pobieranie danych z bazki

    $query = $db->query('SELECT login, pass FROM users');
    $pass_array = $query->fetchAll();


    // var_dump($pass_array);

    return $pass_array;
  }

 // getCredentials($db);
