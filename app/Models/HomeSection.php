<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_key',
        'title',
        'subtitle',
        'description',
        'image',
        'image_alt',
        'image_position',
        'button_text',
        'button_link',
        'background_color',
        'text_color',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Accessor for image URL (robust across storage/public paths)
    public function getImageUrlAttribute()
    {
        $img = $this->image;
        if (!$img) {
            return null;
        }

        // Full external URL
        if (filter_var($img, FILTER_VALIDATE_URL)) {
            return $img;
        }

        // Normalize leading slash
        $img = ltrim($img, '/');

        // Already points to public storage (no duplicate "storage/")
        if (str_starts_with($img, 'storage/')) {
            return asset($img);
        }

        // Stored via disk('public') => convert "public/" to web-accessible "storage/"
        if (str_starts_with($img, 'public/')) {
            return asset('storage/' . substr($img, 7));
        }

        // Relative path (e.g., "home-sections/hero.jpg")
        return asset('storage/' . $img);
    }
}