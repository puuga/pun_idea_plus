<?php
  function getUsers($conn, $option='all') {
    $users = [];

    switch ($option) {
      case 'all':
        $sql = "SELECT * FROM users";
        break;
      case 'admin':
        $sql = "SELECT * FROM users WHERE level=0";
        break;
      case 'normal':
        $sql = "SELECT * FROM users WHERE level<>0";
        break;
      default:
        return $users;
        break;
    }

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
          $users[] = $row;
      }
    }

    return $users;
  }

  function getCustomers($conn, $option='all', $key='') {
    $customers = [];

    switch ($option) {
      case 'all':
        $sql = "SELECT * FROM customers";
        break;
      default:
        return $customers;
        break;
    }

    if ( $key != '') {
      $sql .= " WHERE firstname Like '%$key%' ";
      $sql .= " OR lastname Like '%$key%' ";
      $sql .= " OR tel Like '%$key%' ";
      $sql .= " OR line_id Like '%$key%' ";
      $sql .= " OR email Like '%$key%' ";
    }

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
          $customers[] = $row;
      }
    }

    return $customers;
  }

  function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function getProducts($conn, $option='all') {
    $products = [];

    switch ($option) {
      case 'all':
        $sql = "SELECT * FROM products";
        break;
      case 'active':
        $sql = "SELECT * FROM products WHERE is_active=1";
        break;
      case 'inactive':
        $sql = "SELECT * FROM products WHERE is_active=0";
        break;
      default:
        return $products;
        break;
    }

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
          $products[] = $row;
      }
    }

    return $products;
  }

  function getProductById($conn, $id) {

    $sql = "SELECT * FROM products WHERE id=$id;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
          $product = $row;
      }
    }

    $product_photos = [];
    $sql = "SELECT * FROM product_photos WHERE product_id=$id;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
          $product_photos[] = $row;
      }
    }

    $product["photos"] = $product_photos;

    return $product;
  }
?>
