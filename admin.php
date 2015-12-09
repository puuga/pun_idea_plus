<?php include "include/db_connect_oo.php" ?>
<?php include "include.php" ?>
<?php
  requireSignin(TRUE);
  requireLevel(0);
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <?php include "include_head.php" ?>
  <title>Admin</title>

  <script>
    $(document).ready(function() {
      // This command is used to initialize some elements and make them work properly
      $.material.init();

    });
  </script>
</head>
<body>
  <?php include "include_body.php" ?>
  <div class="container">
    <h1><?php echo $title; ?></h1>

    <div class="row">

      <div class="col-lg-6">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">User</h3>
          </div>
          <div class="panel-body">
            <?php
              $users = getUsers($conn);
            ?>
            admin: <?php echo count(getUsers($conn, 'admin')); ?><br/>
            normal: <?php echo count(getUsers($conn, 'normal')); ?>
          </div>
          <div class="panel-footer text-right">
            <a href="admin_users_view.php" class="btn btn-info">View</a>
            <a href="javascript:void(0)" class="btn btn-info">Add</a>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">Item</h3>
          </div>
          <div class="panel-body">
            active: <br/>
            inactive:
          </div>
          <div class="panel-footer text-right">
            view | add
          </div>
        </div>
      </div>

    </div>

  </div>

  <!--  nev bar -->
  <?php include "nev_bar.php" ?>
</body>
</html>
