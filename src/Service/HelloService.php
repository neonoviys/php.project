<?php

namespace App\Service;

class HelloService
{
    private const MIN_LUCKY_NUMBER = 1;
    private const MAX_LUCKY_NUMBER = 2;


    public function generateLuckyNumber() : string
    {
        return rand(self::MIN_LUCKY_NUMBER, self::MAX_LUCKY_NUMBER);
    }
}