<?php

class FormSanitizer
{
    public static function sanitizeText($input)
    {
        $input = strip_tags($input);
        $input = trim($input);
        $input = ucfirst(strtolower($input));
        return $input;
    }

    public static function sanitizeUsername($input)
    {
        $input = strip_tags($input);
        $input = str_replace(" ", "", $input);
        return $input;
    }

    public static function sanitizePassword($input)
    {
        $input = strip_tags($input);
        return $input;
    }

    public static function sanitizeEmail($input)
    {
        $input = strip_tags($input);
        $input = str_replace(" ", "", $input);
        return $input;
    }
}
