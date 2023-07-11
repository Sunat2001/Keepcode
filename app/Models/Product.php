<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Product
 *
 * @property integer $id
 * @property string $title
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|RentProduct[] $rentProducts
 * @property-read Collection|SoldProduct[] $soldProducts
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereStatus($value)
 * @method static Builder|Product whereTitle($value)
 * @method static Builder|Product whereDescription($value)
 * @method static Builder|Product wherePrice($value)
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    protected $casts = [
        'price' => 'float'
    ];

    public function rentProducts(): HasMany {
        return $this->hasMany(RentProduct::class);
    }

    public function soldProducts(): BelongsToMany {
        return $this->belongsToMany(SoldProduct::class);
    }
}
