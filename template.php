<?php include "include/include_pre.php" ?>
<?php
  requireSignin(false);
  // requireLevel(100);
  // $conn = connect_db($db_server, $db_username, $db_password, $db_dbname);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'include/include_head.php'; ?>

    <title><?= $s_title; ?></title>

  </head>
  <body>
    <?php include "include/include_body.php" ?>
    <div class="container">
      <h1>Hello, world!</h1>
    </div>

    <!--  nev bar -->
    <?php include "nev_bar.php" ?>

  </body>
</html>
