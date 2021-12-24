<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTitle extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = ['author_id' => 'array'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookSelf()
    {
        return $this->belongsTo(BookSelf::class,'self_id','id');
    }

    public function book()
    {
        return $this->hasMany(Book::class,'title_id');
    }
}
