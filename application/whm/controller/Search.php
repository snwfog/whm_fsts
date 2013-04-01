<?php

namespace WHM\Controller;

use \WHM\Controller;
use \WHM\Model\ManageSearch;

/**
 * Class Search
 *
 * Ajax Search algorith. This class uses native mysqli to direct query the database for speed.
 *
 * @package WHM\Controller
 */
class Search extends Controller
{
    protected $manager;

    public function __construct()
    {
        parent::__construct();
        $this->manager = new ManageSearch();
    }

    public function get()
    {
        echo "http get";
    }

    public function get_xhr($argv)
    {
//        echo "(get_xhr) Called";
//        echo "<pre>";
//        print_r($argv);
//        echo "<br />";

        // Check the content of the request see if it has numerics or letters
        // Its gonna be with digits
        if (!preg_match('/[\d]+/i', $argv))
        {
            // Its gonna be without digits
            echo $this->json($this->manager->searchMemberByName($argv));
        }
        else
        {
            echo $this->json($this->manager->searchMemberByMcare($argv));
        }
//        echo "</pre>";
    }

    public function json($dqlArray)
    {
        if (!empty($dqlArray))
        {
            $json = array();
            foreach ($dqlArray as $row)
                $json[] = $row;


            return json_encode($json);
        }
    }
}
