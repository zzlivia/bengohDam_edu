<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    protected $table = 'admin_settings';

    protected $fillable = [
        'default_language',
        'notifications',
        'user_registration',
        'guest_access',
        'text_to_speech',
        'font_size',
        'announcements',
        'export_format',
        'allowed_file_types',
        'max_file_size',
        'video_resolution_limit'
    ];
}