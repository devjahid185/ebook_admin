<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'image',
        'position',
        'is_active',
        'sort_order',
        'book_id'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
