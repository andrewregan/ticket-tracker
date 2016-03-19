<?php
class Connect extends mysqli
{
    public function __construct()
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

    public function simpleInsert($table, $array)
    {
        // strip escape characters to prevent sql injection attacks
        $table = $this->real_escape_string($table);

        $safe_array = [];
        foreach ($array as $key => $value) {
            // strip escape characters to prevent sql injection attacks
            $key = $this->real_escape_string($key);
            $value = $this->real_escape_string($value);

            $safe_array[$key] = $value;
        }

        $query = "INSERT INTO `$table` (`" .
            implode('`,`', array_keys($safe_array)) . '`) VALUES (\'' .
            implode('\',\'', array_values($safe_array)) . '\');';

        $this->query($query);
    }

    public function simpleSelect($table, $find_col, $find_val, $select = '')
    {
        // strip escape characters to prevent sql injection attacks
        $table = $this->real_escape_string($table);
        $find_col = $this->real_escape_string($find_col);
        $find_val = $this->real_escape_string($find_val);
        $select = $this->real_escape_string($select);

        // send the query to the server and get the result
        $query = "SELECT " . (($select == '') ? '* ' : "`$select` ") .
            "FROM `$table` WHERE `$find_col` = '$find_val' LIMIT 1";
        $result = $this->query($query);

        // get the row of data
        return (($result->num_rows > 0) ? $result->fetch_assoc() : []);
    }

    public function simpleUpdate(
        $table,
        $set_col,
        $set_val,
        $find_col,
        $find_val
    ) {
        // strip escape characters to prevent sql injection attacks
        $table = $this->real_escape_string($table);
        $set_col = $this->real_escape_string($set_col);
        $set_val = $this->real_escape_string($set_val);
        $find_col = $this->real_escape_string($find_col);
        $find_val = $this->real_escape_string($find_val);

        $query = "UPDATE `$table`" .
            " SET `$set_col` = '$set_val'" .
            " WHERE `$find_col` = '$find_val';";

        $this->query($query);
    }
}

?>
