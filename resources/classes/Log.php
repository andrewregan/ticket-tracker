<?php

class Log
{
    public function __construct()
    {

    }

    public function getEventCountByIP($event, $ip, $hours = false)
    {
        $connect = new Connect();

        // strip escape characters to prevent sql injection attacks
        $event = $connect->real_escape_string($event);
        $ip = $connect->real_escape_string($ip);

        // start creating the query
        $query = "SELECT `id` FROM `log` " .
            " WHERE (`event`, `ip_address`) = ('$event', '$ip')";

        // check for date of number of hours set
        if ($hours !== false) {
            $hours = $connect->real_escape_string($hours);
            $query .= " AND `time` > DATE_SUB(NOW(), INTERVAL $hours HOUR)";
        }

        $result = $connect->query($query);
        $event_count = $result->num_rows;
        $connect->close();

        return $event_count;
    }

    public function logEvent($event, $data)
    {
        $connect = new Connect();
        $connect->simpleInsert(
            'log',
            [
                'event' => $event,
                'data' => $data,
                'ip_address' => $_SERVER['REMOTE_ADDR']
            ]
        );
        $connect->close();
    }
}
