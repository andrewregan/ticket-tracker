<?php
class Connect extends mysqli
{
    function __construct()
    {
        global $config;

        // connect to the mysql server
        parent::__construct(
            $config['sql']['host'],
            $config['sql']['username'],
            $config['sql']['password'],
            $config['sql']['database'],
            $config['sql']['port']
        );
    }

    function simpleUpdate($table, $set_col, $set_val, $find_col, $find_val)
    {
        // strip escape characters to prevent sql injection attacks
        $table = $this->real_escape_string($table);
        $set_col = $this->real_escape_string($set_col);
        $set_val = $this->real_escape_string($set_val);
        $find_col = $this->real_escape_string($find_col);
        $find_val = $this->real_escape_string($find_val);

        $query = "UPDATE `$table`" .
            " SET `$set_col` = '$set_val'" .
            " WHERE `$find_col` = '$find_val';"

        $this->query($query);
    }
}

?>
