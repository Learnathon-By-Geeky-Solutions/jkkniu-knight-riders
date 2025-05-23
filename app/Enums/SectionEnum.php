<?php

namespace App\Enums;

enum SectionEnum: string
{
    case HOME_BANNER = 'home_banner';
    case HOME_BANNER_WHY_CHOOSE_US = 'home_banner_why_choose_us';
    case DEPARTMENTS = 'departments';
    case WHY_CHOOSE_US = 'why_choose_us';

    public static function HomePage()
    {
        return [
            self::HOME_BANNER->value => ['item' => 1, 'type' => 'first'],
            self::HOME_BANNER_WHY_CHOOSE_US->value => ['item' => 1, 'type' => 'first'],
            self::DEPARTMENTS->value => ['item' => 3, 'type' => 'get'],
            self::WHY_CHOOSE_US->value => ['item' => 3, 'type' => 'get'],
        ];
    }
    
}
