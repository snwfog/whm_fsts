<?php

namespace WHM\Controller\Ajax;

class Language
{
    public function get_xhr()
    {
        $languageJSON = file_get_contents(SITE_ROOT . '/assets/json/world-languages.json');
        echo $languageJSON;
    }
}