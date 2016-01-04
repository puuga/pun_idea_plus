<?php include "include/include_pre.php" ?>
<?php
  requireSignin(TRUE);
  requireLevel(0);
  $conn = connect_db($db_server, $db_username, $db_password, $db_dbname);
?>
<?php
  // define variables and set to empty values
  $inputName = $inputType = $inputPrice = $inputType = $optionsActive = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputName = testInput($_POST["inputName"]);
    $inputType = testInput($_POST["inputType"]);
    $inputPrice = testInput($_POST["inputPrice"]);
    $inputUnit = testInput($_POST["inputUnit"]);
    $optionsActive = testInput($_POST["optionsActive"]);
  }

  $sql = "INSERT INTO products (name, price, unit, type, is_active, created_at, updated_at)
          VALUES ('$inputName', $inputPrice, '$inputUnit', '$inputType', $optionsActive, now(), now() )";

  // echo $sql;
  if ($conn->query($sql) === TRUE) {
    header("Location: admin_products_view.php?success=true&command=add");
    die();
  } else {
      // echo "Error: " . $sql . "<br>" . $conn->error;
    if ( strrpos($conn->error, "Duplicate") !== false ) {
      // echo "Duplicate";
      header("Location: admin_products_view.php?success=false&command=add&reason=duplicate");
      die();
    } else {
      echo $conn->error;
    }
  }
?>
