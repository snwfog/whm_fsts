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
        $headers = apache_request_headers();

        $geoip = "Unidentified";
        $requestURI = str_replace($_SERVER['HTTP_ORIGIN'], "", $_SERVER['HTTP_REFERER']);

        echo "<pre>";
        if (array_key_exists("geoip", $_POST))
        {
            echo "GEOIP: {$_POST['geoip']}<br />";
            $geoip = $_POST['geoip'];
        }

        foreach ($headers as $header => $value)
        {
            echo "{$header}: {$value}<br />";
        }

        print_r($_SERVER);
        echo "</pre>";

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
        $query = "INSERT INTO log (agent
            , ip
            , request_uri ) VALUES ('"
            . mysql_real_escape_string($_SERVER['HTTP_USER_AGENT']) . "', '"
            . $geoip . "', '"
            . $requestURI . "')";

        if (!$result = $mysqli->query($query))
            printf("There was an error in the query: %s\n", $mysqli->error);

    }
}