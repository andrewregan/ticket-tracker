<?php
include(dirname(__FILE__) . '/../resources/prepend.php');

$login = new Login();
$settings = new Settings();
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

    <!-- Cancel ticket modal -->
    <div class="modal fade" id="cancelTicketModal" role="dialog" aria-labelledby="cancelTicketModal" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal" type="button" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Cancel Ticket</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="cancelEmail">Email address</label>
              <input class="form-control" id="cancelEmail" type="email" placeholder="address@mail.com">
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
            <button class="btn btn-primary" type="button">Cancel Tickets</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Reserve ticket modal -->
    <div class="modal fade" id="reserveTicketModal" role="dialog" aria-labelledby="reserveTicketModal" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal" type="button" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Reserve Ticket</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Name</label>
              <div class="row">
                <div class="col-sm-6">
                  <input class="form-control" id="reserveFirstName" type="text" placeholder="First Name">
                </div>
                <div class="col-sm-6">
                  <input class="form-control" id="reserveLastName" type="text" placeholder="Last Name">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="reservePhone">Phone number</label>
              <input class="form-control" id="reservePhone" type="tel">
            </div>
            <div class="form-group">
              <label for="reserveEmail">Email address</label>
              <input class="form-control" id="reserveEmail" type="email" placeholder="address@mail.com">
            </div>
            <hr>
            <div class="form-group">
              <label for="reserveShow">Show</label>
              <select class="form-control" id="reserveShow">
              </select>
            </div>
            <div class="form-group">
              <label for="reserveSeats">Seats</label>
              <div class="row">
                <div class="col-sm-10">
                  <input class="form-control" id="reserveSeats" type="number" value="1" min="1" max="12">
                </div>
                <div class="col-sm-2">
                  <input class="form-control" id="reserveSeatsCost" readonly>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="reserveComments">Comments</label>
              <textarea class="form-control" id="reserveComments" rows="3"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
            <button class="btn btn-success" id="reserveTicketSave" type="button">Reserve Tickets</button>
          </div>
        </div>
      </div>
    </div>

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
          <a class="btn btn-success btn-lg btn-block" id="reserveTicketButton">Reserve Ticket</a>
          <!--div class="row">
            <div class="col-md-3" style="margin-bottom: 5px;">
              <a class="btn btn-danger btn-lg btn-block" data-target="#cancelTicketModal" data-toggle="modal" type="button">Cancel Ticket</a>
            </div>
            <div class="col-md-9">
              <a class="btn btn-success btn-lg btn-block" data-target="#reserveTicketModal" data-toggle="modal" type="button">Reserve Ticket</a>
            </div>
          </div-->
        </div>
      </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-notify.min.js"></script>
    <script src="js/default.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
