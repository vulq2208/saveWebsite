<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveWebsite extends Model
{
    use HasFactory;

    protected $table = 'save_websites';

    protected $fillable = [
        'title',
        'content',
        'picture',
    ];
}
