<?php
class Setup
{
    public $currentStep = 0;
    public $setupEbabled = false;

    function __construct()
    {
        $this->loadConfigInfo();
    }

    protected function loadConfigInfo()
    {
        global $config;

        $this->currentStep = (isset($config['setup_step']))
            ? $config['setup_step']
            : 0;
        $this->setupEnabled = (isset($config['setup_enabled']) &&
            $config['setup_enabled'] === true);
    }

    public function requireSetupEnabled()
    {
        global $config;

        // Throw error if setup is disabled in config.
        if ($config['setup_enabled'] !== true) {
            $parent = dirname($_SERVER['REQUEST_URI']);
            header("Location: $parent/");
        }
    }
}
