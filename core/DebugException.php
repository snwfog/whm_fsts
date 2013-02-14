<?php
/**
 * File: DebugException.php
 * User: snw
 * Date: 2013-02-13
 */

namespace Core;


class DebugException extends \Exception
{
    private $_file;
    private $_method;

    public function __construct($message, $file, $method)
    {
        parent::__construct($message);
        $this->_file = $file;
        $this->_method = $method;

        echo $this;
    }

    public function __toString()
    {
        $message = "<h1>Runtime Error</h1>
            <p>At file <em>{$this->_file}</em>, method <em>{$this->_method
            }</em>. The problem was: {$this->message}.</p>";

        return $message;
    }
}