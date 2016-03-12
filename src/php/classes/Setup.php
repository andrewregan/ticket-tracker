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

        // throw error if setup is disabled in config
        if ($config['setup_enabled'] !== true) {
            $parent = dirname($_SERVER['REQUEST_URI']);
            header("Location: $parent/");
        }
    }

    public function saveConfigFile($config_new, $config_template)
    {
        // loop through each configuration entry
        foreach ($config_new as $key => $value) {
            // check if there are any subkeys
            if (gettype($value) == "array") {
                foreach ($value as $subkey => $subval) {
                    if (gettype($subval) == "boolean") {
                        $subval = ($subval) ? 'true' : 'false';
                    }

                    $config_template = str_replace(
                        '!' . $key . '_' . $subkey,
                        $subval,
                        $config_template
                    );
                }
            } else {
                if (gettype($value) == "boolean") {
                    $value = ($value) ? 'true' : 'false';
                }

                $config_template = str_replace(
                    "!$key",
                    $value,
                    $config_template
                );
            }
        }

        // save the configuration file
        $success = save_file(
            dirname(__FILE__) . '/../config.json',
            $config_template
        );

        return $success;
    }
}
