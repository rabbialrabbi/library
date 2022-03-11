<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookSelf extends Model
{
    use HasFactory;

    protected $casts = [
        'part_details' => 'array',
    ];

    protected $guarded = [];
}
