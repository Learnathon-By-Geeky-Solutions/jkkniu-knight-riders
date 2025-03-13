<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    protected $fillable = [
        'site_name',
        'address',
        'copyright_text',
        'phone', 
        'email',
        'socials',
    ];
}
