<?php include "include/db_connect_oo.php" ?>
<?php include "include.php" ?>
<?php requireSignin(false); ?>
<!DOCTYPE html>
<html lang="th">
<head>
  <?php include "include_head.php" ?>
  <title>Sign in</title>

  <script>
    $(document).ready(function() {
      // This command is used to initialize some elements and make them work properly
      $.material.init();

    });
  </script>
</head>
<body>
  <?php include_once("include/analyticstracking.php") ?>
  <div class="container">

    <div class="row">

      <div class="col-lg-6 col-lg-offset-3">
        <div class="panel panel-info">
          <div class="panel-body">

            <form class="form-horizontal" method="post" action="control_sign_in.php">
              <fieldset>
                <legend>
                  <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
                  Sign in
                </legend>
                <div class="form-group">
                  <label for="inputEmail" class="col-md-2 control-label">Email</label>

                  <div class="col-md-10">
                    <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword" class="col-md-2 control-label">Password</label>

                  <div class="col-md-10">
                    <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password">

                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-10 col-md-offset-2 text-right">
                    <button type="button" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </fieldset>
            </form>

          </div>
        </div>
      </div>

    </div>

  </div>

  <!--  nev bar -->
  <?php include "nev_bar.php" ?>
</body>
</html>
