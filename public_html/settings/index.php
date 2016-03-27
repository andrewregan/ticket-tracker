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
    <link href="../css/settings.css" rel="stylesheet">
  </head>
  <body>
    <?php include(dirname(__FILE__) . '/../../resources/navbar.php'); ?>

    <div class="container" id="content">
      <div class="row">
        <div class="col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">Settings</div>
            <div class="panel-body">
              <div class="form-group">
                <label for="settingsTitle">Site Title</label>
                <input class="form-control" id="settingsTitle" type="text" placeholder="Enter Title Here">
              </div>
              <div class="form-group">
                <label for="settingsTheme">Site Theme</label>
                <select class="form-control" id="settingsTheme">
                  <option value="bootstrap">Default</option>
                </select>
              </div>
              <div class="form-group">
                <label for="settingsImage">Image</label>
                <div class="row">
                  <div class="col-md-9">
                    <input class="form-control" id="settingsImage" type="text" readonly>
                  </div>
                  <div class="col-md-3">
                    <a class="btn btn-default btn-block" data-target="#uploadImageModal" data-toggle="modal">Upload</a>
                  </div>
                </div>
              </div>
              <div class="checkbox">
                <label>
                  <input id="settingsDisableSite" type="checkbox"> Disable Site
                </label>
              </div>
              <a class="btn btn-primary pull-right" id="settingsSave">Save Changes</a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-info">
            <div class="panel-heading">Shows</div>
            <div class="panel-body">
              <table class="table">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Seats</th>
                    <th>Cost</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="showTable">
                  <tr id="showTemplate">
                    <td>Example Show - Tuesday</td>
                    <td>10/256</td>
                    <td>$15</td>
                    <td>
                      <div class="pull-right">
                        <a class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        <a class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <a class="btn btn-default pull-right" data-target="#createShowModal" data-toggle="modal">Create Show</a>
            </div>
          </div>
          <div class="panel panel-info">
            <div class="panel-heading">Accounts</div>
            <div class="panel-body">
              <table class="table">
                <thead>
                  <tr>
                    <th>Email</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="accountTable">
                  <tr id="accountTemplate">
                    <td><!--email--></td>
                    <td>
                      <div class="pull-right">
                        <a class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        <a class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <a class="btn btn-default pull-right" data-target="#createAccountModal" data-toggle="modal">Create Account</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-notify.min.js"></script>
    <script src="../js/default.js"></script>
    <script src="../js/settings.js"></script>
  </body>
</html>
