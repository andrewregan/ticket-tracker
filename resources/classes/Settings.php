<?php
class Settings
{
    public function __construct($load_settings = true)
    {

    }

    public function changeSetting($name, $new_value)
    {
        $connect = new Connect();

        $connect->simpleUpdate(
            'settings',
            'value',
            $new_value,
            'name',
            $name
        );

        $connect->close();
    }
}

?>
