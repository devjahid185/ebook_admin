<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\BookPart;
use App\Models\BookReview;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'author_id',
        'image',
        'overview',
        'views',
        'rating',
        'review',
        'category_id',
        'is_active',
        'notes'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'views' => 'integer',
        'rating' => 'float',
        'review' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function parts()
    {
        return $this->hasMany(BookPart::class)->orderBy('position');
    }

    public function userReviews()
    {
        return $this->hasMany(BookReview::class);
    }

    public function updateRatingStats()
    {
        $this->rating = $this->userReviews()->avg('rating') ?? 0;
        $this->review = $this->userReviews()->count();
        $this->save();
    }

    public function banners()
    {
        return $this->hasMany(Banner::class);
    }

    public function authorUser()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    
}
