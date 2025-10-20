<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'type',
        'title',
        'description',
        'level',
        'year',
        'position',
        'participant_name',
        'notes',
        'is_active',
        'is_featured',
        'certificate_image',
        'photo'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'year' => 'integer'
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopePublished($query)
    {
        return $query->where('is_active', true);
    }

    // Accessors
    public function getTypeLabelAttribute()
    {
        $types = [
            'academic' => 'Akademik',
            'non_academic' => 'Non-Akademik'
        ];
        return $types[$this->type] ?? $this->type;
    }

    public function getLevelLabelAttribute()
    {
        $levels = [
            'kabupaten' => 'Kabupaten',
            'provinsi' => 'Provinsi',
            'nasional' => 'Nasional',
            'internasional' => 'Internasional'
        ];
        return $levels[$this->level] ?? $this->level;
    }
}
