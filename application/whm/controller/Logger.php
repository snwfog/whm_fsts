<?php

namespace WHM\Controller;

use \WHM\Model\Log;

class Logger
{
    private $dbconfig = array
    (
        'name' => 'snwfog_soen390',
        'host' => 'charlescy.com',
        'user' => 'snwfog_soen390',
        'pass' => 'QqT9tR'
    );

    public function get_xhr()
    {
        $this->post_xhr();
    }

    public function post_xhr()
    {
        $logger = new Logger();

        $mysqli = new \mysqli
        (
            $this->dbconfig['host'],
            $this->dbconfig['user'],
            $this->dbconfig['pass'],
            $this->dbconfig['name']
        );

        if (mysqli_connect_errno())
        {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        // Insert some information
        $query = "INSERT INTO log (agent) VALUES ('" . mysql_real_escape_string($_SERVER['HTTP_USER_AGENT']) . "')";

        if (!$result = $mysqli->query($query))
            printf("There was an error in the query: %s\n", $mysqli->error);

        $headers = apache_request_headers();

        echo "<pre>";
        foreach ($headers as $header => $value)
        {
            echo "{$header}: {$value}<br />";
        }

        print_r($_SERVER);
        echo "</pre>";
    }
}