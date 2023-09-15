<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Category extends Model implements HasMedia
{

    use HasFactory, SoftDeletes;
    use HasRecursiveRelationships;
    use InteractsWithMedia;


    protected $fillable = [
        'name',
    ];

    protected $appends = [
        'count_sub_category'
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function getParentNameAttribute(): ?string
    {
        if ($this->parent_id !== null) {
            return $this->parent->name;
        }

        return null;
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }


    public function getCountSubCategoryAttribute(): ?string
    {

        return $this->descendants()->count();
    }
}
