<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Item extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'item_name',
        'category_id',
        'qty_available',
        'item_description'
     ];

    /**
     * Get the category associated with the item.
     */
    public function category(): HasOne
    {
        return $this->hasOne(Category::class);
    }

    /**
     * Get the image items associated with the item.
     */
    public function image(): HasMany
    {
        return $this->hasMany(ItemImages::class);
    }
    
}
