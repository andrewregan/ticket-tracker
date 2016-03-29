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

    public function deleteShow($id)
    {
        $connect = new Connect();
        $connect->simpleDelete(
            'shows',
            'id',
            $id
        );
        $connect->simpleDelete(
            'orders',
            'show_id',
            $id
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
            // strip escape characters to prevent mysql injection attacks
            $show_id = $connect->real_escape_string($value['id']);

            // create a custom query to count the total number of seats sold
            $query = "SELECT SUM(IF(`show_id` = '" . $show_id . "', `seat_num`, 0)) AS `total` FROM `orders`";
            $result = $connect->query($query);
            $row = $result->fetch_assoc();
            $seat_sales = $row['total'];
            
            $this->table[$key]['seat_sales'] = $seat_sales;
        }

        $connect->close();
    }

    public function verifyShow($id)
    {
        $connect = new Connect();
        $show_count = $connect->simpleSelectCount(
            'shows',
            'id',
            $id
        );
        if ($show_count > 0) {
            $show_enabled = $connect->simpleSelect(
                'shows',
                'id',
                $id,
                'enabled'
            );
        }
        $connect->close();

        return ($show_count > 0 && $show_enabled);
    }
}
