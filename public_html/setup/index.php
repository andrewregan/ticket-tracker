<?php
require_once(dirname(__FILE__) . '/../../resources/prepend.php');

$setup = new Setup();
$setup->requireSetupEnabled(true);
?>
<!doctype html>
<html lang="en-us">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Andrew Regan">

    <title>Ticket Tracker Setup</title>

    <!-- CSS dependencies -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/setup.css" rel="stylesheet">
  </head>
  <body>
    <!-- License modal -->
    <div class="modal fade" id="licenseModal" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal" type="button" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">License Information</h4>
          </div>
          <div class="modal-body">
            <h4>The MIT License (MIT)</h4>
            <p>Copyright (c) 2016 Andrew Regan</p>
            <p>
              Permission is hereby granted, free of charge, to any person obtaining a copy
              of this software and associated documentation files (the "Software"), to deal
              in the Software without restriction, including without limitation the rights
              to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
              copies of the Software, and to permit persons to whom the Software is
              furnished to do so, subject to the following conditions:
            </p>
            <p>
              The above copyright notice and this permission notice shall be included in all
              copies or substantial portions of the Software.
            </p>
            <p>
              THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
              IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
              FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
              AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
              LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
              OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
              SOFTWARE.
            </p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="container" id="content">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div id="stepWarning"></div>
          <div class="panel panel-primary">
            <div class="panel-heading" id="stepTitle"></div>
            <div class="panel-body" id="stepContent"></div>
            <div class="panel-footer">
              Created by <a href="https://github.com/andrewregan" target="_blank">Andrew Regan</a>, licensed under the <a data-toggle="modal" data-target="#licenseModal" href="">MIT License</a>.
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- JavaScript dependencies -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/setup.js"></script>
  </body>
</html>
