<?php

class Shows
{
    public $table;

    public function __construct($load_table = true)
    {
        if ($load_table) $this->loadShowList();
    }

    public function createShow(
        $show_title,
        $seat_total,
        $seat_cost,
        $enabled
    ) {
        // add the new row to the database
        $connect = new Connect();
        $connect->simpleInsert(
            'shows',
            [
                'show_title' => $show_title,
                'seat_total' => $seat_total,
                'seat_cost' => $seat_cost,
                'enabled' => $enabled
            ]
        );
        $connect->close();
    }

    public function editShow(
        $id,
        $show_title,
        $seat_total,
        $seat_cost,
        $enabled
    ) {
        // add the new row to the database
        $connect = new Connect();
        $connect->advUpdate(
            'shows',
            [
                'show_title' => $show_title,
                'seat_total' => $seat_total,
                'seat_cost' => $seat_cost,
                'enabled' => $enabled
            ],
            [
                'id' => $id
            ]
        );
        $connect->close();
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
