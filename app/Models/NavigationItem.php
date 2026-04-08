<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $label
 * @property string|null $url
 * @property string|null $icon
 * @property int|null $parent_id
 * @property int $sort_order
 * @property bool $is_active
 * @property bool $is_visible_to_guests
 * @property string $target
 * @property string|null $css_class
 * @property array|null $metadata
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read NavigationItem|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, NavigationItem> $children
 * @property-read int|null $children_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NavigationItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NavigationItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NavigationItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NavigationItem active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NavigationItem root()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NavigationItem visible()
 * @mixin \Eloquent
 */
class NavigationItem extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'label',
        'url',
        'icon',
        'parent_id',
        'sort_order',
        'is_active',
        'is_visible_to_guests',
        'target',
        'css_class',
        'metadata',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_visible_to_guests' => 'boolean',
            'metadata' => 'json',
        ];
    }

    /**
     * Get the parent navigation item.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(NavigationItem::class, 'parent_id');
    }

    /**
     * Get all children of this navigation item.
     */
    public function children(): HasMany
    {
        return $this->hasMany(NavigationItem::class, 'parent_id')
            ->orderBy('sort_order')
            ->orderBy('created_at');
    }

    /**
     * Get all descendants (children, grandchildren, etc.).
     */
    public function descendants(): HasMany
    {
        return $this->children()->with('descendants');
    }

    /**
     * Scope: Get only active items.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Get only root-level items (no parent).
     */
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope: Get items visible to guests.
     */
    public function scopeVisible($query)
    {
        return $query->where('is_visible_to_guests', true);
    }

    /**
     * Check if this item is a root item (top-level menu).
     */
    public function isRoot(): bool
    {
        return $this->parent_id === null;
    }

    /**
     * Check if this item has children.
     */
    public function hasChildren(): bool
    {
        return $this->children()->count() > 0;
    }

    /**
     * Get breadcrumb path for this item.
     *
     * @return array<int, array{label: string, url: string|null}>
     */
    public function getBreadcrumbs(): array
    {
        $breadcrumbs = [];
        $current = $this;

        while ($current !== null) {
            array_unshift($breadcrumbs, [
                'label' => $current->label,
                'url' => $current->url,
            ]);
            $current = $current->parent;
        }

        return $breadcrumbs;
    }

    /**
     * Get hierarchical tree of active items.
     *
     * @return array<int, array>
     */
    public static function getActiveTree(): array
    {
        return self::root()
            ->active()
            ->with('children')
            ->orderBy('sort_order')
            ->get()
            ->map(fn($item) => [
                'id' => $item->id,
                'label' => $item->label,
                'url' => $item->url,
                'icon' => $item->icon,
                'hasChildren' => $item->hasChildren(),
                'children' => $item->children
                    ->filter(fn($child) => $child->is_active)
                    ->map(fn($child) => [
                        'id' => $child->id,
                        'label' => $child->label,
                        'url' => $child->url,
                        'icon' => $child->icon,
                    ])
                    ->values()
                    ->toArray(),
            ])
            ->toArray();
    }
}
