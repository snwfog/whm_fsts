<?php

namespace WHM\Controller\Ajax;


class PostalCode
{
    /**
     * Sole purpose is to return the postal code to region mapping as json object
     */
    public function get_xhr()
    {
        $postalCodeJSON = file_get_contents(SITE_ROOT . '/assets/json/postal-code-regions.json');
        echo $postalCodeJSON;
    }
}