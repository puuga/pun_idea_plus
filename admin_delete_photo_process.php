<?php include "include/include_pre.php" ?>
<?php
  requireSignin(TRUE);
  requireLevel(0);
  $conn = connect_db($db_server, $db_username, $db_password, $db_dbname);
?>
<?php
  // define variables and set to empty values
  $photo_id = $product_id = $photo_name = "";

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $photo_id = testInput($_GET["photo_id"]);
    $product_id = testInput($_GET["product_id"]);
    $photo_name = testInput($_GET["photo_name"]);
  }

  unlink("photos/".$photo_name);

  // die();
  $sql = "DELETE FROM product_photos
          WHERE id=$photo_id;";

  // echo $sql;
  if ($conn->query($sql) === TRUE) {
    header("Location: admin_product_view.php?id=$product_id&success=true&command=delete");
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
