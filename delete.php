<?php
require_once 'app/init.php';

if(isset($_GET['id'])){

  $reset = $db->prepare('
    DELETE FROM items
    WHERE id = :id
  ');

  $reset->execute(['id' => $_GET['id']]);

  header('Location: index.php');

}


?>
