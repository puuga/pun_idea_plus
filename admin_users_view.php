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
    <h1>
      User
      <button type="button" class="btn btn-raised btn-info" data-toggle="modal" data-target="#addUserModal">Add User</a>
    </h1>

    <div class="row">

      <div class="col-lg-6">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">Admin</h3>
          </div>
          <div class="panel-body">
            <?php
              $users = getUsers($conn, 'admin');
              foreach ($users as $user) {
                echo "$user[name], $user[email]<br>";
              }
            ?>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">Normal</h3>
          </div>
          <div class="panel-body">
            <?php
              $users = getUsers($conn, 'normal');
              foreach ($users as $user) {
                echo "$user[name], $user[email]<br>";
              }
            ?>
          </div>
        </div>
      </div>

    </div>

  </div>

  <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="addUserModalLabel">Add new User</h4>
        </div>
        <div class="modal-body">
          <form action="admin_user_add_process.php" method="post" class="form-horizontal" name="addUser" id="addUser">

            <div class="form-group">
              <label for="inputName" class="col-md-2 control-label">Name</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="inputName" id="inputName" placeholder="Name">
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail" class="col-md-2 control-label">Email</label>
              <div class="col-md-10">
                <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="Email">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword" class="col-md-2 control-label">Password</label>
              <div class="col-md-10">
                <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label">Permission</label>
              <div class="col-md-10">
                <div class="radio radio-primary">
                  <label>
                    <input type="radio" name="optionsPermission" id="optionsPermissionNormal" value="100" checked="">
                    Normal
                  </label>
                </div>
                <div class="radio radio-primary">
                  <label>
                    <input type="radio" name="optionsPermission" id="optionsPermissionAdmin" value="0">
                    Admin
                  </label>
                </div>
              </div>
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info" form="addUser">Add</button>
        </div>
      </div>
    </div>
  </div>

  <!--  nev bar -->
  <?php include "nev_bar.php" ?>
</body>
</html>
