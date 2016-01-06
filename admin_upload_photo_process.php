<?php include "include/include_pre.php" ?>
<?php
  requireSignin(TRUE);
  requireLevel(0);
  $conn = connect_db($db_server, $db_username, $db_password, $db_dbname);
?>
<?php
  $target_dir = "photos/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

  $old_file_name = basename($_FILES["fileToUpload"]["name"]);
  $new_file_name = date("Y-m-d-H-i-s") . "." . $imageFileType;
  $new_target_file = $target_dir.$new_file_name;

  // Check if image file is a actual image or fake image
  if( isset($_POST["submit"]) ) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
          // echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          // echo "File is not an image.";
          $uploadOk = 0;
      }
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      // echo "Sorry, your file was not uploaded.";
      header("Location: admin_product_view.php?id=$product_id&success=false&command=upload&reason=0");
      die();
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $new_target_file)) {
          // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
      } else {
          echo "Sorry, there was an error uploading your file.";
          header("Location: admin_product_view.php?id=$product_id&success=false&command=upload&reason=0");
          die();
      }
  }

  // define variables and set to empty values
  $product_id = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = testInput($_POST["product_id"]);
  }

  $sql = "INSERT INTO product_photos (product_id, name, created_at, updated_at)
          VALUES ($product_id, '$new_file_name', now(), now() )";

  // echo $sql;
  if ($conn->query($sql) === TRUE) {
    header("Location: admin_product_view.php?id=$product_id&success=true&command=upload");
    die();
  } else {
      // echo "Error: " . $sql . "<br>" . $conn->error;
    if ( strrpos($conn->error, "Duplicate") !== false ) {
      // echo "Duplicate";
      header("Location: admin_product_view.php?id=$product_id&success=false&command=upload&reason=0");
      die();
    } else {
      echo $conn->error;
    }
  }
?>
