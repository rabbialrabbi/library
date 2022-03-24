<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'book_no',
        'title_id',
        'language_id',
        'jamaat_id',
        'image',
        'self_id',
        'taak',
        'part',
        'price',
        'borrow_status',
        'book_status',
        'purchase_at',
        'lost_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = ['author_id' => 'array'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function author()
    {
        return $this->belongsToMany(Author::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookSelf()
    {
        return $this->belongsTo(BookSelf::class,'self_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function member()
    {
        return $this->belongsToMany(Member::class,'book_borrow','book_id','member_id');
    }

    public function returnByMember()
    {
        return $this->belongsToMany(Member::class,'book_borrow','book_id','member_id')->wherePivotNull('return_at');
    }

    public function jamaat()
    {
        return $this->belongsTo(Jamaat::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);

    }

    public function getCurrentBorrowerAttribute()
    {
        return $this->returnByMember()->first();
    }
}
