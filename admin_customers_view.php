<?php include "include/include_pre.php" ?>
<?php
  requireSignin(TRUE);
  requireLevel(0);
  $conn = connect_db($db_server, $db_username, $db_password, $db_dbname);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "include/include_head.php" ?>
  <title><?= $s_customer_dashboard;?></title>

</head>
<body>
  <?php include "include/include_body.php" ?>
  <div class="container">
    <h1>
      <?= $s_customer_dashboard;?>
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addCustomerModal">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <?= $s_add_customer; ?>
      </button>
    </h1>
    <?php
      $customers = getCustomers($conn);

      function makeUserEditButton($user) {
        $button = "<button type='button' class='btn btn-warning' ";
        $button .= "data-toggle='modal' data-target='#editUserModal' ";
        $button .= "data-id='$user[id]' ";
        $button .= "data-name='$user[name]' ";
        $button .= "data-email='$user[email]' ";
        $button .= "data-password='$user[password]' ";
        $button .= "data-permission='$user[level]'>";
        $button .= "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>";
        $button .= "</button>";

        return $button;
      }

      function makeUserDeleteButton($user) {
        $button = "<button type='button' class='btn btn-danger' ";
        $button .= "onclick='javascript:deleteUser($user[id])'>";
        $button .= "<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>";
        $button .= "</button>";

        return $button;
      }
    ?>

    <?php
    if ( isset($_GET["success"]) ) {
      if ( $_GET["success"]=="true" && $_GET["command"]=="add" ) {
        ?>
        <div class="row">
          <div class="alert alert-success" role="alert">
            Add user success.
          </div>
        </div>
        <?php
      } elseif ( $_GET["success"]=="true" && $_GET["command"]=="edit" ) {
        ?>
        <div class="row">
          <div class="alert alert-success" role="alert">
            Edit user success.
          </div>
        </div>
        <?php
      } elseif ( $_GET["success"]=="true" && $_GET["command"]=="delete" ) {
        ?>
        <div class="row">
          <div class="alert alert-success" role="alert">
            Delete user success.
          </div>
        </div>
        <?php
      } elseif ( $_GET["success"]=="false" && $_GET["command"]=="add" && $_GET["reason"]=="duplicate") {
        ?>
        <div class="row">
          <div class="alert alert-danger" role="alert">
            Duplicate e-mail.
          </div>
        </div>
        <?php
      } elseif ( $_GET["success"]=="false" && $_GET["command"]=="edit" && $_GET["reason"]=="duplicate") {
        ?>
        <div class="row">
          <div class="alert alert-danger" role="alert">
            Duplicate e-mail.
          </div>
        </div>
        <?php
      }
    }
    ?>

    <div class="row">

      <div class="col-lg-12">
        <div class="panel panel-primary">
          <div class="panel-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>firstname</th>
                  <th>lastname</th>
                  <th>tel</th>
                  <th>line</th>
                  <th>email</th>
                  <th>address</th>
                  <th>command</th>
                </tr>
              </thead>
              <tbody>
                <?php
                for ($i=0; $i < count($customers); $i++) {
                  echo "<tr>";
                  echo "<td>".$customers[$i]["firstname"]."</td>";
                  echo "<td>".$customers[$i]["lastname"]."</td>";
                  echo "<td>".$customers[$i]["tel"]."</td>";
                  echo "<td>".$customers[$i]["line_id"]."</td>";
                  echo "<td>".$customers[$i]["email"]."</td>";
                  echo "<td>".$customers[$i]["address"]."</td>";
                  echo "<td>";
                  echo " ";
                  echo "</td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>

  </div>

  <div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="addCustomerModalLabel">Add new Customer</h4>
        </div>

        <div class="modal-body">
          <form action="admin_customer_add_process.php" method="post" class="form-horizontal" name="addCustomer" id="addCustomer">
            <input type="hidden" name="source" value="admin_customers_view.php">

            <div class="form-group">
              <label for="inputFirstname" class="col-md-2 control-label">firstname</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="inputFirstname" id="inputFirstname" placeholder="firstname">
              </div>
            </div>

            <div class="form-group">
              <label for="inputLastname" class="col-md-2 control-label">lastname</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="inputLastname" id="inputLastname" placeholder="lastname">
              </div>
            </div>

            <div class="form-group">
              <label for="inputTel" class="col-md-2 control-label">tel</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="inputTel" id="inputTel" placeholder="tel">
              </div>
            </div>

            <div class="form-group">
              <label for="inputLine" class="col-md-2 control-label">line</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="inputLine" id="inputLine" placeholder="line">
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail" class="col-md-2 control-label">Email</label>
              <div class="col-md-10">
                <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="Email">
              </div>
            </div>

            <div class="form-group">
              <label for="inputAddress" class="col-md-2 control-label">address</label>
              <div class="col-md-10">
                <textarea type="password" class="form-control" name="inputAddress" id="inputAddress" placeholder="address"></textarea>
              </div>
            </div>

          </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info" form="addCustomer">Add</button>
        </div>

      </div>
    </div>
  </div>

  <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="editUserModalLabel">Edit User</h4>
        </div>

        <div class="modal-body">
          <form action="admin_user_edit_process.php" method="post" class="form-horizontal" name="editUser" id="editUser">
            <input type="hidden" name="inputIdEdit" id="inputIdEdit" value="">
            <input type="hidden" name="source" value="admin_users_view.php">

            <div class="form-group">
              <label for="inputName" class="col-md-2 control-label">Name</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="inputName" id="inputNameEdit" placeholder="Name">
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail" class="col-md-2 control-label">Email</label>
              <div class="col-md-10">
                <input type="email" class="form-control" name="inputEmail" id="inputEmailEdit" placeholder="Email">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword" class="col-md-2 control-label">Password</label>
              <div class="col-md-10">
                <input type="password" class="form-control" name="inputPassword" id="inputPasswordEdit" placeholder="Password">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label">Permission</label>
              <div class="col-md-10">
                <div class="radio radio-primary">
                  <label>
                    <input type="radio" name="optionsPermission" id="optionsPermissionNormalEdit" value="100" checked="">
                    Normal
                  </label>
                </div>
                <div class="radio radio-primary">
                  <label>
                    <input type="radio" name="optionsPermission" id="optionsPermissionAdminEdit" value="0">
                    Admin
                  </label>
                </div>
              </div>
            </div>

          </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info" form="editUser">
            <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit
          </button>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $('#editUserModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var id = button.data('id'); // Extract info from data-* attributes
      var name = button.data('name');
      var email = button.data('email');
      var password = button.data('password');
      var permission = button.data('permission');
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this);
      modal.find('#inputIdEdit').val(id);
      modal.find('#inputNameEdit').val(name);
      modal.find('#inputEmailEdit').val(email);
      modal.find('#inputPasswordEdit').val(password);
      if ( permission===100 ) {
        modal.find('#optionsPermissionNormalEdit').prop("checked", true);
      } else {
        modal.find('#optionsPermissionAdminEdit').prop("checked", true);
      }
    });

    function deleteUser(id) {
      var c = confirm("Delete ?");

      if (c) {
        window.location = "admin_user_delete_process.php?id="+id;
      }

    }
  </script>

  <!--  nev bar -->
  <?php include "nev_bar.php" ?>
</body>
</html>
