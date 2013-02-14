<?php
class Output
{
    //contains the internal data
    var $data;

    // constructor
    function __construct($data) {
        $this->data = $data;
    }

    public function output()
    {
        print 'test';

    }


}
?>
