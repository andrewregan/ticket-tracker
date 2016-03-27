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

        // loop through each show and add the number of seats sold
        foreach ($this->table as $key => $value) {
            $seat_sales = $connect->simpleSelectCount(
                'orders',
                'show_id',
                $value['id']
            );
            $this->table[$key]['seat_sales'] = $seat_sales;
        }

        $connect->close();
    }
}
