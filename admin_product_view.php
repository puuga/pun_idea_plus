<?php include "include/include_pre.php" ?>
<?php
  requireSignin(true);
  requireLevel(0);
  $conn = connect_db($db_server, $db_username, $db_password, $db_dbname);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'include/include_head.php'; ?>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/jasny-bootstrap.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="js/jasny-bootstrap.min.js"></script>

    <title><?= $s_product_dashboard; ?></title>

    <style>
      .img_container {
        position: relative;
        display: inline-block;
        text-align: center;
        /*border: 1px solid red;*/
        /* background:url('http://jsfiddle.net/img/initializing.png') no-repeat;
        width:186px;
        height:157px;*/
      }

      .btn-delete {
        position: absolute;
        top: 10px;
        right: 10px;
      }
    </style>

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
            <dt>barcode</dt>
            <dd>
              <img src="barcode/sample-gd.php?code=<?= $product["barcode"]; ?>" alt="<?= $product["barcode"]; ?>" />
            </dd>
          </dl>
        </p>

        <p>
          <dl class="dl-horizontal">
            <dt>photos</dt>
            <dd>
              <?php foreach ($product["photos"] as $photo) { ?>
                <div class="img_container">
                  <img src='photos/<?= $photo["name"]; ?>'
                  class='img-responsive img-rounded' alt='Responsive image'
                  style='max-width: 200px; max-height: 200px;'>
                  <button class="btn btn-danger btn-delete"
                  onclick="deletePhoto(<?= $photo["id"]; ?>, '<?= $photo["name"]; ?>', <?= $product["id"]; ?>)">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                  </button>
                </div>
              <?php } ?>
            </dd>
          </dl>
        </p>

      </div>

      <hr/>

      <div class="row">
        <form action="admin_upload_photo_process.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="product_id" value="<?= $product["id"]; ?>">

          <div class="form-group">
            <div class="fileinput fileinput-new" data-provides="fileinput">
              <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="max-width: 200px; max-height: 200px;"></div>
              <div>
                <span class="btn btn-default btn-file">
                  <span class="fileinput-new">Select image</span>
                  <span class="fileinput-exists">Change</span>
                  <input type="file" name="fileToUpload">
                </span>
                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
              </div>
            </div>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary">
              <span class="glyphicon glyphicon-upload" aria-hidden="true"></span>
              Upload Photo
            </button>
          </div>
        </form>
      </div>
    </div>

    <script type="text/javascript">
      function deletePhoto(photoId, photoName, productId) {
        // alert(id);
        var c = confirm("Delete ?");

        if (c) {
          // alert();
          window.location = "admin_delete_photo_process.php?photo_id="+photoId
          +"&photo_name="+photoName
          +"&product_id="+productId;
        }
      }
    </script>

    <!--  nev bar -->
    <?php include "nev_bar.php" ?>

  </body>
</html>
