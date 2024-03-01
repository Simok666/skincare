<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
       'category_name'
    ];

    /*     
    * Get the item that owns the category
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

}
