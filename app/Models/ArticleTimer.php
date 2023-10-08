<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleTimer extends Model
{
    use HasFactory;
    protected $fillable = [
        'last_run',
    ];
}
