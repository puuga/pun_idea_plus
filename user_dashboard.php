<?php include "include/include_pre.php" ?>
<?php
  requireSignin(false);
  requireLevel(100);
  $conn = connect_db($db_server, $db_username, $db_password, $db_dbname);

  $current_user = getCurrentUser();
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
      <h1>
        <?= $s_dashboard ?>
        <small><?= $current_user->name ?></small>
      </h1>

      <div class="row">

        <div class="">
          <div class="col-md-12">
            <dl class="dl-horizontal">
              <dt>name</dt>
              <dd><?= $current_user->name ?></dd>
            </dl>

            <dl class="dl-horizontal">
              <dt>email</dt>
              <dd><?= $current_user->email ?></dd>
            </dl>

            <dl class="dl-horizontal">
              <dt>permission</dt>
              <dd><?= $current_user->user_level_name ?></dd>
            </dl>
          </div>
        </div>
      </div>
    </div>

    <!--  nev bar -->
    <?php include "nev_bar.php" ?>

  </body>
</html>
