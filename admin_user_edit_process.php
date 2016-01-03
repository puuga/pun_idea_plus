<?php include "include/include_pre.php" ?>
<?php
  requireSignin(TRUE);
  requireLevel(0);
  $conn = connect_db($db_server, $db_username, $db_password, $db_dbname);
?>
<?php
  // echo $_POST["inputName"];
  // echo $_POST["inputEmail"];
  // echo $_POST["inputPassword"];
  // echo $_POST["optionsPermission"];

  $sql = "UPDATE users
          SET name='$_POST[inputName]',
            email='$_POST[inputEmail]',
            password='$_POST[inputPassword]',
            level='$_POST[optionsPermission]',
            updated_at=now()
          WHERE id=$_POST[inputIdEdit];";

  // echo $sql;
  if ($conn->query($sql) === TRUE) {
    header("Location: admin_users_view.php?success=true&command=edit");
    die();
  } else {
      // echo "Error: " . $sql . "<br>" . $conn->error;
    if ( strrpos($conn->error, "Duplicate") !== false ) {
      echo "Duplicate";
    } else {
      echo $conn->error;
    }
  }
?>
