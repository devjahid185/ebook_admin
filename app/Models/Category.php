<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'is_active',
        'position',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'position' => 'integer',
    ];

    // Auto-generate slug if not provided
    public static function booted()
    {
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = static::createUniqueSlug($category->name);
            }
        });

        static::updating(function ($category) {
            // regenerate slug if name changed and slug not manually set
            if ($category->isDirty('name') && (!$category->slug || $category->slug === null)) {
                $category->slug = static::createUniqueSlug($category->name, $category->id);
            }
        });
    }

    public static function createUniqueSlug($name, $ignoreId = null)
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 1;
        while (static::where('slug', $slug)->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $i++;
        }
        return $slug;
    }
}
