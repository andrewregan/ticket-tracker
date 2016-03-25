<?php
include(dirname(__FILE__) . '/../../resources/prepend.php');

$login = new Login();
$login->requireLoggedIn(true, true);
?>
<!doctype html>
<html lang="en-us">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ticket Tracker</title>

    <!-- CSS dependencies -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/view.css" rel="stylesheet">
  </head>
  <body>
    <?php include(dirname(__FILE__) . '/../../resources/navbar.php'); ?>

    <div class="container" id="content">
      <div class="panel panel-primary">
        <div class="panel-heading">View Tickets</div>
        <div class="panel-body">
          <table class="table table-condensed">
            <thead>
              <tr>
                <td>
                  <div class="form-group form-group-sm">
                    <select class="form-control" id="showSortBy">
                      <option>Newest to Oldest</option>
                      <option>Oldest to Newest</option>
                      <option>Fist Name</option>
                      <option>Last Name</option>
                    </select>
                  </div>
                </td>
                <td>
                  <div class="form-group form-group-sm">
                    <select class="form-control" id="showNumber">
                      <option>10</option>
                      <option>25</option>
                      <option>50</option>
                      <option>100</option>
                    </select>
                  </div>
                </td>
                <td>
                  <div class="form-group form-group-sm">
                    <select class="form-control" id="showName">
                      <option>All</option>
                    </select>
                  </div>
                </td>
                <td>
                  <div class="form-group form-group-sm">
                    <input class="form-control" id="showSearch" type="text" placeholder="Search">
                  </div>
                </td>
              </tr>
            </thead>
          </table>
        </div>
        <div class="panel-footer">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Show</th>
                <th>Seats</th>
                <th>Price</th>
                <th>Comments</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Last</td>
                <td>First</td>
                <td>Example Show - Thursday</td>
                <td>5</td>
                <td>$50</td>
                <td><span class="label label-info">Yes</span></td>
                <td>
                  <div class="pull-right">
                    <a class="btn btn-sm btn-info"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></a>
                    <a class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                    <a class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-notify.min.js"></script>
    <script src="../js/view.js"></script>
  </body>
</html>
