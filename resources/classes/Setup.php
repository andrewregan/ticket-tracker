<?php
class Setup
{
    public $currentStep = 0;
    public $setupEbabled = false;

    public function __construct($reload_config = false)
    {
        // config.php not loading normally because of a cache issue?
        if ($reload_config) $this->reloadConfig();

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

    protected function reloadConfig()
    {
        global $config;

        // manually load and execute config file
        if (file_exists(dirname(__FILE__) . '/../config.php')) {
            $settings = file_get_contents(dirname(__FILE__) . '/../config.php');
            $settings = str_replace('<?php', '', $settings);
            eval($settings);
            unset($settings);
        }
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
        $success = (file_put_contents(
            dirname(__FILE__) . '/../config.php',
            $config_template
        ) !== false);

        return $success;
    }
}
