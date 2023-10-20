<?php

namespace Mmantai\VarDumper;


class VarDumper
{
    public static function dump($var)
    {
        print "<pre>";
        var_dump($var);
        print "</pre>";
    }
}