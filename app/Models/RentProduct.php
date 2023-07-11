<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Model\RentProduct
 *
 * @property integer $id
 * @property string $status
 * @property Carbon|null $expired_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @property-read Product $product
 * @method static Builder|RentProduct newModelQuery()
 * @method static Builder|RentProduct newQuery()
 * @method static Builder|RentProduct query()
 * @method static Builder|RentProduct whereCreatedAt($value)
 * @method static Builder|RentProduct whereId($value)
 * @method static Builder|RentProduct whereStatus($value)
 * @method static Builder|RentProduct whereProduct($value)
 * @method static Builder|RentProduct whereUser($value)
 * @method static Builder|RentProduct get()
 */
class RentProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'user_id',
        'product_id',
        'expired_at',
    ];

    protected $casts = [
        'expired_at' => 'datetime'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }
}
