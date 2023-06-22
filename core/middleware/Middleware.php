<?php

namespace core\middleware;

class Middleware{
    public const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class
    ];

    public static function resolve($key){

        if(!$key){
            return;
        }

        $middleware = static::MAP[$key] ?? false;

        if(!$middleware){
            throw new \Exception('no matching middleware found');
        }
        
        (new $middleware())->handle();
    }
}