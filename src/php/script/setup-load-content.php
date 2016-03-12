<?php
require_once(dirname(__FILE__) . '/../prepend.php');

// manually load and execute config file
// config.php not loading normally because of a cache issue?
if (file_exists(dirname(__FILE__) . '/../config.php')) {
    $settings = file_get_contents(dirname(__FILE__) . '/../config.php');
    $settings = str_replace('<?php', '', $settings);
    eval($settings);
    unset($settings);
}

$setup = new Setup();
$setup->requireSetupEnabled();

$title[] = "License Agreement";
$step[] = <<<HTML
<form class="form-horizontal">
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

  <br>
  <div class="form-group">
    <div class="col-sm-12">
      <a class="btn btn-primary pull-right" id="nextStep">Agree</a>
    </div>
  </div>
</form>
HTML;

$title[] = "<b>Step 1 of 3: </b> Connect to a MySQL server";
$step[] = <<<HTML
<form class="form-horizontal" autocomplete="off">
  <div class="form-group">
    <label class="col-sm-3 control-label" for="inputHost">Host:</label>
    <div class="col-sm-9">
      <input class="form-control" id="inputHost" type="text" value="localhost" placeholder="localhost">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label" for="inputPort">Port:</label>
    <div class="col-sm-9">
      <input class="form-control" id="inputPort" type="number" value="3306" placeholder="3306">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label" for="inputTable">Table:</label>
    <div class="col-sm-9">
      <input class="form-control" id="inputTable" type="text">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label" for="inputUsername">Username:</label>
    <div class="col-sm-9">
      <input class="form-control" id="inputUsername" type="text">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label" for="inputPassword">Password:</label>
    <div class="col-sm-9">
      <input class="form-control" id="inputPassword" type="password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <a class="btn btn-primary pull-right" id="nextStep">Step 2 <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></a>
    </div>
  </div>
</form>
HTML;

$title[] = "<b>Step 2 of 3: </b> Connect to an email server";
$step[] = <<<HTML
<div class="alert alert-warning" role="alert">
  This email account will be used to send out all ticket confirmation emails.
  <br><strong>Do enter a personal email account!</strong>
</div>
<form class="form-horizontal" autocomplete="off">
  <div class="form-group">
    <label class="col-sm-3 control-label" for="inputHost">Host:</label>
    <div class="col-sm-9">
      <input class="form-control" id="inputHost" type="text" placeholder="imap.google.com">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label" for="inputPort">Port:</label>
    <div class="col-sm-9">
      <input class="form-control" id="inputPort" type="number" value="993" placeholder="993">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label" for="inputUsername">Username:</label>
    <div class="col-sm-9">
      <input class="form-control" id="inputUsername" type="email" placeholder="user@example.com">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label" for="inputPassword">Password:</label>
    <div class="col-sm-9">
      <input class="form-control" id="inputPassword" type="password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <a class="btn btn-primary pull-right" id="nextStep">Step 3 <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></a>
    </div>
  </div>
</form>
HTML;

$title[] = "<b>Step 3 of 3: </b> Create an account";
$step[] = <<<HTML
<form class="form-horizontal">
  <div class="form-group">
    <label class="col-sm-3 control-label" for="inputUsername">Username:</label>
    <div class="col-sm-9">
      <input class="form-control" id="inputUsername" type="email" placeholder="user@example.com">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label" for="inputPassword">Password:</label>
    <div class="col-sm-9">
      <input class="form-control" id="inputPassword" type="password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <a class="btn btn-primary pull-right" id="nextStep">Finish</a>
    </div>
  </div>
</form>
HTML;

// exit if the current step is too high or low
if ($setup->currentStep + 1 > count($step)) return_json();
if ($setup->currentStep + 1 > count($title)) return_json();
if ($setup->currentStep < 0) return_json();

// set variables to return to user
$json['code'] = $step[$setup->currentStep];
$json['step'] = $setup->currentStep;
$json['title'] = $title[$setup->currentStep];

$json['success'] = ($json['code'] != '');

return_json($json);
