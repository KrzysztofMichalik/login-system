<?php
  require_once('init.php');

  function getCredentials(){
    $fileData = file_get_contents('users.txt');

    $arr = array_filter(explode("\n", $fileData));

    $pass_array = array();
    foreach ($arr as $key => $value) {
      array_push($pass_array, explode(" ", $value));
    }

    return $pass_array;
  }

  getCredentials();
