<?php

namespace App\Enums;

enum SectionEnum: string
{
    case SITE_INFO = 'site_info';
    case HOME_BANNER = 'home_banner';

    public static function HomePage()
    {
        return [
            self::HOME_BANNER->value => ['item' => 1, 'type' => 'first'],
            self::SITE_INFO->value => ['item' => 1, 'type' => 'first'],
        ];
    }
    
}
