<?php

namespace WHM;
/*
 * BENCHMARK
 *
 * This class enables mark points and calculate the time
 * difference between markers. Memory consumption can
 * also be displayed.
 */
class Benchmark
{
    private $_marker = array();
    private $_time = array();

    public function mark($name)
    {
        $this->_marker[] = $name;
        $this->_time[] = microtime(true);
    }

    public function print_report()
    {
        $length = count($this->_marker);
        $result = "";

        for ($i = 1; $i < $length; $i++)
        {
            $marker_one = $this->_marker[$i - 1];
            $marker_two = $this->_marker[$i];
            $time_diff = $this->_time[$i - 1] - $this->_time[$i];

            $result .= "From <b>{$marker_one}</b> to <b>{$marker_two}</b>:
                {$time_diff} seconds.</br>";
        }

        $total_time = $this->_time[$i - 1] - $this->_time[0];
        $result .= "Total time: {$total_time} seconds.<br>";

        echo $result;
    }
}
