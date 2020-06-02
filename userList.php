<?php

$host = 'localhost';
$dbUser = 'admin';
$dbPass = 'ambitne6789';
$dbname = 'phpcamp';
$db = new mysqli($host, $dbUser, $dbPass, $dbname);

$query = 'SELECT * FROM `users`';

$result = $db->query($query);



if ($result) {
  var_dump($result->fetch_all());

} else {
  var_dump($db->error_list);
}

$db->close();
