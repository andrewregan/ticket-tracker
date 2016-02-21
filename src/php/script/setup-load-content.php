<?php
require_once(dirname(__FILE__) . '/../prepend.php');

$setup = new Setup();
$setup->requireSetupEnabled();

// define the HTML for each step
$step[] = <<<HTML
<form class="form-horizontal">
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
      <button class="btn btn-primary pull-right" type="submit">Step 2 <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></button>
    </div>
  </div>
</form>
HTML;

$step[] = <<<HTML
<p>This email account will be used to send out all ticket confirmation emails. <b>Do enter a personal email account!</b></p>
<form class="form-horizontal">
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
      <button class="btn btn-primary pull-right" type="submit">Step 3 <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></button>
    </div>
  </div>
</form>
HTML;

$json['step'] = $setup->currentStep;
$json['code'] = $step[$setup->currentStep];
$json['success'] = true;

return_json($json);
