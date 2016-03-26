<?php

class Shows
{
    public $table;

    public function __construct($load_table = true)
    {
        if ($load_table) $this->loadShowList();
    }

    public function loadShowList()
    {
        $connect = new Connect();
        $this->table = $connect->advSelect('shows');
        $connect->close();
    }
}
