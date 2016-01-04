<?php include "include/include_pre.php" ?>
<?php
  requireSignin(TRUE);
  requireLevel(0);
  $conn = connect_db($db_server, $db_username, $db_password, $db_dbname);
?>
<?php
  // define variables and set to empty values
  $inputId = $inputName = $inputEmail = $inputPassword = $optionsPermission = $source = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputId = testInput($_POST["inputIdEdit"]);
    $inputName = testInput($_POST["inputName"]);
    $inputEmail = testInput($_POST["inputEmail"]);
    $inputPassword = testInput($_POST["inputPassword"]);
    $optionsPermission = testInput($_POST["optionsPermission"]);
    $source = testInput($_POST["source"]);
  }

  $sql = "UPDATE users
          SET name='$inputName',
            email='$inputEmail',
            password='$inputPassword',
            level='$optionsPermission',
            updated_at=now()
          WHERE id=$inputId;";

  // echo $sql;
  if ($conn->query($sql) === TRUE) {
    header("Location: $source?success=true&command=edit");
    die();
  } else {
      // echo "Error: " . $sql . "<br>" . $conn->error;
    if ( strrpos($conn->error, "Duplicate") !== false ) {
      // echo "Duplicate";
      header("Location: $source?success=false&command=edit&reason=duplicate");
      die();
    } else {
      echo $conn->error;
    }
  }
?>
