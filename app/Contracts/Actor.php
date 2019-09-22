<?php

namespace App\Contracts;

interface Actor
{
    /**
     * Converse
     * @return string
     */
    public function converse();

    /**
     * Should Use
     * @param App\Models\Gamer $gamer
     * @param string $message
     * 
     * @return bool
     */
    public static function shouldUse($gamer, $message);
}