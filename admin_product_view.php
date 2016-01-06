<?php include "include/include_pre.php" ?>
<?php
  requireSignin(true);
  requireLevel(100);
  $conn = connect_db($db_server, $db_username, $db_password, $db_dbname);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'include/include_head.php'; ?>

    <title><?= $s_product_dashboard; ?></title>

  </head>
  <body>
    <?php include "include/include_body.php" ?>
    <?php
      $product = getProductById($conn, $_GET['id']);
    ?>
    <div class="container">
      <h1><?= $product["name"]; ?></h1>

      <div class="row">
        <p>
          <dl class="dl-horizontal">
            <dt>price</dt>
            <dd><?= $product["price"]; ?></dd>
          </dl>
        </p>

        <p>
          <dl class="dl-horizontal">
            <dt>unit</dt>
            <dd><?= $product["unit"]; ?></dd>
          </dl>
        </p>

        <p>
          <dl class="dl-horizontal">
            <dt>type</dt>
            <dd><?= $product["type"]; ?></dd>
          </dl>
        </p>

        <p>
          <dl class="dl-horizontal">
            <dt>active</dt>
            <dd><?= $product["is_active"]==1?"Yes":"No"; ?></dd>
          </dl>
        </p>

        <p>
          <dl class="dl-horizontal">
            <dt>photos</dt>
            <dd>
              <?php
                foreach ($product["photos"] as $photo) {
                  echo "<img src='photos/$photo[name]' ";
                  echo "class='img-responsive img-thumbnail' alt='Responsive image' ";
                  echo "style='max-width: 200px; max-height: 200px;'> ";
                }
              ?>
            </dd>
          </dl>
        </p>

      </div>
    </div>

    <!--  nev bar -->
    <?php include "nev_bar.php" ?>

  </body>
</html>
