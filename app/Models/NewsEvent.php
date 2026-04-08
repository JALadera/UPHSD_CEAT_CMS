<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $department_id
 * @property string $title
 * @property string $slug
 * @property string $type
 * @property string|null $excerpt
 * @property string $content
 * @property string|null $featured_image
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $event_date
 * @property string|null $location
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Department|null $department
 * @method static \Database\Factories\NewsEventFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereEventDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereFeaturedImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsEvent withoutTrashed()
 * @mixin \Eloquent
 */
class NewsEvent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'department_id',
        'title',
        'slug',
        'type',
        'excerpt',
        'content',
        'featured_image',
        'published_at',
        'event_date',
        'location',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'event_date' => 'datetime',
        ];
    }

    /**
     * Get the featured image URL
     */
    public function getFeaturedImageAttribute($value)
    {
        if (!$value) {
            return null;
        }
        
        // If it's already a full URL, return it
        if (str_starts_with($value, 'http')) {
            return $value;
        }
        
        // Convert to asset URL for public disk
        return asset('storage/' . $value);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
