<?php

namespace App\Enums;

enum SectionEnum: string
{
    case HOME_BANNER = 'home_banner';

    public static function HomePage()
    {
        return [
            self::HOME_BANNER->value => ['item' => 1, 'type' => 'first'],
        ];
    }
    
}
