<?php
namespace App\RequestGate;

class RequestTemplate
{
    private $code;

    public function __get(String $var = 'code') :String
    {
        return $this->$var;
    }

    public function __set(String $var = 'code', String $val):void
    {
        $this->code = $val;
    }
}
?>
