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

    public function getSetting($name)
    {
        $connect = new Connect();
        $row = $connect->simpleSelect(
            'settings',
            'name',
            $name,
            'value'
        );
        $connect->close();

        return $row['value'];
    }
}
