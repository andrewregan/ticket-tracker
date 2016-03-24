<?php
    include(dirname(__FILE__) . '/../../resources/prepend.php');
?>
<!doctype html>
<html lang="en-us">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ticket Tracker</title>

    <!-- CSS dependencies -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/default.css" rel="stylesheet">
  </head>
  <body>
    <?php include(dirname(__FILE__) . '/../../resources/navbar.php'); ?>

    <div class="container" id="content">
      <div class="row">
        <div class="col-md-offset-3 col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">Log in</div>
            <div class="panel-body">
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-notify.min.js"></script>
    <script src="../js/login.js"></script>
  </body>
</html>
