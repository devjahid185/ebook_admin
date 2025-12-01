<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class BookPart extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'title',
        'details',
        'thumbnail',
        'rating',
        'review_count',
        'views',
        'is_active',
        'notes',
        'position',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rating' => 'float',
        'review_count' => 'integer',
        'views' => 'integer',
        'position' => 'integer',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    
}
