<div class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">

    <div class="navbar-header">
      <button type="button"
      class="navbar-toggle"
      data-toggle="collapse"
      data-target=".navbar-responsive-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php"><?php echo $s_project_name;?></a>
    </div>

    <div class="navbar-collapse collapse navbar-responsive-collapse">

      <ul class="nav navbar-nav">
        <li>
          <a href="home.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
        </li>
        <li>
          <a href="sale.php"><span class="glyphicon glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Sale</a>
        </li>
        <li>
          <a href="shipping.php"><span class="glyphicon glyphicon glyphicon-send" aria-hidden="true"></span> Shipping</a>
        </li>
        <?php if ( getUserLevel()==0 ) { ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Admin <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="admin.php"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Admin Dashboard</a>
            </li>
            <li>
              <a href="admin_users_view.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> User Dashboard</a>
            </li>
            <li>
              <a href="#"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Product Dashboard</a>
            </li>
          </ul>
        </li>
        <?php } ?>
      </ul>

      <ul class="nav navbar-nav navbar-right">

        <?php if ( !isSignin() ) { ?>
          <li>
            <a href="sign_in_form.php">
              <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
              <?php echo $s_sign_in;?>
            </a>
          </li>
        <?php } else { ?>
          <li>
            <p class="navbar-text">
              <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              <?php echo getUserEmail();?>
            </p>
          </li>
          <li>
            <a href="user_dashboard.php">
              <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
              <?= $s_dashboard ?>
            </a>
          </li>
          <li>
            <a href="control_sign_out.php">
              <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
              <?php echo $s_sign_out;?>
            </a>
          </li>
        <?php } ?>


      </ul>

    </div>
  </div>
</div>
