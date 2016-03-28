<?php
include(dirname(__FILE__) . '/../../resources/prepend.php');

$login = new Login();
$login->requireLoggedIn(true, true);

$settings = new Settings();
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

    <!-- Edit show  -->
    <div class="modal fade" id="editShowModal" role="dialog" aria-labelledby="editShowModal" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal" type="button" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Show</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="editShowName">Show Name</label>
              <input class="form-control" id="editShowName" type="text" placeholder="Wicked - Friday, March 4">
            </div>
            <div class="form-group">
              <label for="editShowSeats">Seats</label>
              <input class="form-control" id="editShowSeats" type="number" value="0" min="0" max="20000">
            </div>
            <div class="form-group">
              <label for="editShowPrice">Ticket Price</label>
              <div class="input-group">
                <span class="input-group-addon">$</span>
                <input class="form-control" id="editShowPrice" type="number" value="5" min="0" max="2000">
                <span class="input-group-addon">.00</span>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input id="editShowEnable" type="checkbox"> Allow Reservations
                </label>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
            <button class="btn btn-primary" id="editShowSave" type="button">Save Changes</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Delete show  -->
    <div class="modal fade" id="deleteShowModal" role="dialog" aria-labelledby="deleteShowModal" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal" type="button" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Delete Show</h4>
          </div>
          <div class="modal-body">
            <p>Are you sure that you would like to delete &quot;<span id="deleteShowName"></span>&quot;?</p>
            <p><span id="deleteShowSeats"></span> tickets have been registered.</p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
            <button class="btn btn-danger" id="deleteShowConfirm" type="button">Delete Show</button>
          </div>
        </div>
      </div>
    </div>

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
                    <td><!--name--></td>
                    <td><!--seats--></td>
                    <td><!--price--></td>
                    <td>
                      <div class="pull-right">
                        <a class="btn btn-sm btn-primary show-edit-btn"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        <a class="btn btn-sm btn-danger show-delete-btn"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <a class="btn btn-default pull-right" id="createShowButton">Create Show</a>
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
                        <a class="btn btn-sm btn-primary account-edit-btn"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        <a class="btn btn-sm btn-danger account-delete-btn"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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
