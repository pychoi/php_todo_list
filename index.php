<?php

require_once 'app/init.php';

$itemsQuery = $db->prepare("
  SELECT id, name, done
  FROM items
  WHERE user = :user
");

$itemsQuery->execute([
  'user' => $_SESSION['user_id']
]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>To Do List Made With PHP</title>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans|Shadows+Into+Light+Two" />
    <link rel="stylesheet" href="css/style.css" />

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=0" />

  </head>
  <body>
    <div class="list">
      <h1 class="header">To Do:</h1>

      <?php if(!empty($items)): ?>
        <ul class="items">
          <?php foreach($items as $item): ?>
            <li>
              <span class="item <?php echo $item['done'] ? 'done' : ''; ?>"><?php echo $item['name']; ?></span>
              <?php if(!$item['done']): ?>
                <a href="mark.php?as=done&item=<?php echo $item['id']; ?>" class="done-button">Mark as done</a>
              <?php endif; ?>
              <a href="delete.php?id=<?php echo $item['id']; ?>">Remove Item</a>
            </li>
          <?php endforeach; ?>
        </ul>

      <?php else: ?>
        <p>You don't have any items to do.</p>
      <?php endif; ?>

      <form class="item-add" action="add.php" method="post">
        <input type="text" name="name" placeholder="Add new item here" class="input" autocomplete="off" required/>
        <input type="submit" value="Add" class="submit"/>
      </form>

    </div>
  </body>
</html>
