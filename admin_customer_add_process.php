<?php include "include/include_pre.php" ?>
<?php
  requireSignin(TRUE);
  requireLevel(0);
  $conn = connect_db($db_server, $db_username, $db_password, $db_dbname);
?>
<?php
  // define variables and set to empty values
  $inputFirstname = $inputLastname = $inputTel = $inputLine = $inputEmail = $inputAddress = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputFirstname = testInput($_POST["inputFirstname"]);
    $inputLastname = testInput($_POST["inputLastname"]);
    $inputTel = testInput($_POST["inputTel"]);
    $inputLine = testInput($_POST["inputLine"]);
    $inputEmail = testInput($_POST["inputEmail"]);
    $inputAddress = testInput($_POST["inputAddress"]);
    $source = testInput($_POST["source"]);

    $inputFirstname = $conn->real_escape_string($inputFirstname);
    $inputLastname = $conn->real_escape_string($inputLastname);
    $inputTel = $conn->real_escape_string($inputTel);
    $inputLine = $conn->real_escape_string($inputLine);
    $inputEmail = $conn->real_escape_string($inputEmail);
    $inputAddress = $conn->real_escape_string($inputAddress);
    $source = $conn->real_escape_string($source);
  }

  $sql = "INSERT INTO customers (firstname, lastname, tel, line_id, email, address, created_at, updated_at)
          VALUES ('$inputFirstname', '$inputLastname', '$inputTel', '$inputLine', '$inputEmail', '$inputAddress', now(), now() )";

  // echo $sql;
  if ($conn->query($sql) === TRUE) {
    header("Location: $source?success=true&command=add");
    die();
  } else {
      // echo "Error: " . $sql . "<br>" . $conn->error;
    if ( strrpos($conn->error, "Duplicate") !== false ) {
      // echo "Duplicate";
      header("Location: $source?success=false&command=add&reason=duplicate");
      die();
    } else {
      echo $conn->error;
      die();
    }
  }
?>
