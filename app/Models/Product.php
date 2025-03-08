<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property float $price
 * @property int $category_id
 * @property int $quantity
 * @property int $status_id
 * @property int $seller_id
 *
 * @property-read Category $category
 * @property-read User $seller
 * @property-read Status $status
 * @property-read Image<Collection> $images
 * @property-read Review<Collection> $reviews
 */
class Product extends Model
{
    protected $guarded = ['id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
