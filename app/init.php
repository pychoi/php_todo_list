<?php

session_start();

$_SESSION['user_id'] = 1;

$db = new PDO('mysql:dbname=todo_list;host=localhost', 'root', 'hhsp');

if(!isset($_SESSION['user_id'])) {
  die('You are not signed in.');
}

?>
