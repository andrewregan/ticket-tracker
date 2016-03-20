<?php
    include(dirname(__FILE__) . '/../resources/prepend.php');
?>
<!doctype html>
<html lang="en-us">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ticket Tracker</title>

    <!-- CSS dependencies -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/default.css" rel="stylesheet">
  </head>
  <body>
    <?php include(dirname(__FILE__) . '/../resources/navbar.php'); ?>

    <div class="container" id="content">
      <div class="panel panel-default no-border">
        <div class="panel-body no-padding">
          <img class="img-thumbnail" id="mainImage" src="img/background.jpg" alt="...">
          <div style="position: relative">
            <div class="image-overlay">
              <h1>Theater Name</h1>
              <p class="lead">I am some frendly text, please like me!</p>
            </div>
          </div>
        </div>
        <div class="panel-footer" style="padding: 5px; border: none;">
          <div class="row">
            <div class="col-md-3" style="margin-bottom: 5px;">
              <a class="btn btn-danger btn-lg btn-block" href="#cancelTickets">Cancel Tickets</a>
            </div>
            <div class="col-md-9">
              <a class="btn btn-primary btn-lg btn-block" href="#orderTickets">Reserve Tickets</a>
            </div>
          </div>
        </div>
      </div>

      <a name="orderTickets"></a>
      <div class="panel panel-primary large-margin">
        <div class="panel-heading">Order Tickets:</div>
        <div class="panel-body">
          <div style="padding: 1000px;"></div>
        </div>
      </div>
    </div>
  </body>
</html>
