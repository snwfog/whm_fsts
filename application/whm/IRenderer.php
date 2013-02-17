<?php

namespace WHM;

interface IRenderer
{
    public function display($view, $data = array());
}
