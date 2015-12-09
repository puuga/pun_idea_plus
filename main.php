<?php include "include/db_connect_oo.php" ?>
<?php include "include.php" ?>
<?php requireSignin(false); ?>
<!DOCTYPE html>
<html lang="th">
<head>
  <?php include "include_head.php" ?>
  <title>Main</title>

  <script>
    $(document).ready(function() {
      // This command is used to initialize some elements and make them work properly
      $.material.init();

    });
  </script>

</head>
<body>
  <?php include "include_body.php" ?>
  kkk

  <!--  nev bar -->
  <?php include "nev_bar.php" ?>
</body>
</html>
