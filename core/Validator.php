<?php

namespace core;

class Validator{
    public static function string($value, $min = 1, $max = 200){
        $trimmed = trim($value);

        return strlen($trimmed) >= $min && strlen($trimmed) <= $max; 
    }

    public static function email($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}