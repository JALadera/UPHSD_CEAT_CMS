<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $department_id
 * @property string $name
 * @property string $short_name
 * @property string $slug
 * @property string $degree_level
 * @property int $duration_years
 * @property string|null $description
 * @property string|null $objectives
 * @property string|null $career_opportunities
 * @property array<array-key, mixed>|null $curriculum_structure
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Department|null $department
 * @method static \Database\Factories\ProgramFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereCareerOpportunities($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereCurriculumStructure($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereDegreeLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereDurationYears($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereObjectives($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program withoutTrashed()
 * @mixin \Eloquent
 */
class Program extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'department_id',
        'name',
        'short_name',
        'slug',
        'degree_level',
        'duration_years',
        'description',
        'objectives',
        'career_opportunities',
        'curriculum_structure',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'curriculum_structure' => 'json',
        ];
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

}
