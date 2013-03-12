<?php

namespace WHM\Controller\Ajax;

class Country
{
    public function get_xhr()
    {
        $countryListJSON = file_get_contents(SITE_ROOT . '/assets/json/countries-short.json');
        echo $countryListJSON;
    }
}