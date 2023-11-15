<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    const FILE_KEY = 'logo';
    const FOLDER_NAME = "client";

    protected $fillable = [
        'name',
        'logo',
        'website_link',
    ];
}
