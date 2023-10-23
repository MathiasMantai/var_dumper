<?php

namespace Mmantai\VarDumper;


class VarDumper
{

    public static function routing($var): string
    {
        $out = "";
        switch(gettype($var))
        {
            case "array": 
                {
                    $out .= self::displayArrayData($var);
                }
            break;
            case "object":
                {
                    $out .= self::displayObjectData($var);
                }
            break;
        }

        return $out;
    }

    public static function getType($var)    
    {
        return gettype($var);
    }
    public static function getVariableName($var): string|false
    { 
        foreach($GLOBALS as $varName => $value) 
        { 
            if ($value === $var) 
            { 
                return $varName; 
            } 
        } 
        return false;  
    }

    public static function displayArrayData(array $array): string
    {
        $out = self::displayArrayLength($array);
        $out .= "<br />";
        $out .= self::displayArrayElements($array); 
        return $out;
    }

    public static function displayArrayLength(array $array): string
    {
        $cnt = count($array);
        $out = "<table width='100%;'>";
        $out .= "<tr><td style='text-align: left;'>Length:</td><td style='text-align: right;'>{$cnt}</td></tr>";
        $out .= "</table>";

        return $out;
    }

    public static function displayArrayElements(array $array): string
    {
        $out = "";

        if(count($array) > 0)
        {
            $out = "<table width='100%;'><tr><td style='text-decoration: underline;'>Elements</td></tr>";

            foreach ($array as $key => $value) 
            {
                $out .= "<tr style='border-bottom: 1px solid black;'>";

                $type = gettype($value);
                $out .= "<td style='text-align:left;'>{$key} ({$type})</td>";

                $out .= "<td style='text-align:right;'>{$value}</td>";

                $out .= "</tr>";
            }

            $out .= "</table>";
        }

        return $out;
    }

    public static function displayObjectData(object $obj): string
    {   
        $properties = get_object_vars($obj);
        $methods = get_class_methods($obj);

        $out = "<table style='width: 100%;'>";
        
        $out .= self::displayObjectProperties($properties);

        $out .= self::displayObjectMethods($methods);

        $out .= "</table>";

        return $out;
    }

    public static function displayObjectProperties(array $properties): string
    {
        $out = "";
        if(count($properties) > 0)
        {
            $out = "<br />";
            $out .= "<tr><td style='text-decoration: underline'>Properties</td></tr>";

            foreach ($properties as $key => $value) 
            {
                $out .= "<tr>";

                $out .= "<td style='text-align:left;'>{$key}</td>";

                $out .= "<td style='text-align:right;'>{$value}</td>";

                $out .= "</tr>";
            }
        }

        return $out;
    }

    public static function displayObjectMethods(array $methods): string
    {
        $out = "";
        if(count($methods) > 0)
        {
            $out = "<tr><td></td></tr>";
            $out .= "<tr><td style='text-decoration: underline'>Methods</td></tr>";

            foreach ($methods as $method) 
            {
                $out .= "<tr>";

                $out .= "<td style=''>{$method}</td>";

                $out .= "</tr>";
            }
        }

        return $out;
    }

    public static function draw(mixed $var)
    {
        $data = [
            "varName" => self::getVariableName($var),
            "type" => self::getType($var),
            "objectData" => self::routing($var)  
        ];
        $out = "<table>";
        $out .= "<tr><td>Variable Name:</td><td style='text-align: right;'>{$data['varName']}</td></tr>";
        $out .= "<tr><td>Type:</td><td style='text-align: right;'>{$data["type"]}</td>"; 

        if($data["type"] === "object")
        {
            $className = get_class($var);
            $out .= "<tr><td>Class:</td><td style='text-align: right;'>{$className}</td></tr>";
        }
        $out .= "</table>";
        
        $out .= $data["objectData"];
        return $out;
    }



    public static function container($var)
    {
        $styles = 'border: 1px solid gray; border-radius: 4px; display: inline-block; padding: 10px;';
        return "<pre style='{$styles}'>" . $var ."</pre>";
    }

    public static function dump(mixed $var): void
    {
        print self::container(self::draw($var));
    }
}