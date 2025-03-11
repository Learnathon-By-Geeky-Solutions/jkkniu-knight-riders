<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CMS extends Model
{
    use HasFactory;
    protected $fillable = [
        'page',             // Page enum or string (e.g., home_page)
        'section',          // Section name (e.g., banner, about_us)
        'title',            // Title of the section
        'sub_title',        // Subtitle of the section
        'image',            // Image URL or path
        'icon',             // Icon URL or path
        'bg',               // Background Image URL or path
        'description',      // Main description text
        'sub_description',  // Additional description text
        'btn_text',         // Text for any button in the section
        'btn_link',         // URL link for the button or other purpose
        'status',           // Status of the section (e.g., active, inactive)
    ];
    
}
