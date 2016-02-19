<?php
class Setup {
  public $currentPage = 0;

  function __construct() {

  }

  function requireSetupEnabled() {
    global $config;

    // Throw error if setup is disabled in config.
    if ($config['setup_enabled'] !== true) {
      $parent = dirname($_SERVER['REQUEST_URI']);
      header("Location: $parent/");
    }
  }

  function echoPageCode() {
  }
}
