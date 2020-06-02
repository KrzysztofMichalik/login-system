<?php
$dsn = 'mysql:dbname=phpcamp;host=127.0.0.1';
$dbUser = 'admin';
$dbPass = 'ambitne6789';

try {
  $db = new PDO($dsn, $dbUser, $dbPass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  print 'blad polaczenia z bazka';
}


// if ($db) {
//   var_dump($db);
// } else {
//   echo 'wystapił błąd z nawiazaniem polaczenia';
// }
// $query = $db->query('SELECT login, pass FROM users');
// $pass_array = $query->fetchALL();
//
// var_dump($pass_array);
