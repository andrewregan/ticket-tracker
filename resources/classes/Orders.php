<?php

class Orders
{
    public function __construct()
    {

    }

    public function createOrder(
        $first_name,
        $last_name,
        $phone,
        $email,
        $show_id,
        $seat_num,
        $comments
    ) {
        $connect = new Connect();
        $connect->simpleInsert(
            'orders',
            [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'phone' => $phone,
                'email' => $email,
                'show_id' => $show_id,
                'seat_num' => $seat_num,
                'comments' => $comments
            ]
        );
        $connect->close();
    }
}
