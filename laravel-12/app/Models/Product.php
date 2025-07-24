<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //

    use SoftDeletes;

    protected $fillable = ['name', 'thumbnail', 'about', 'price', 'category_id', 'is_popular'];

    public  function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function merchants()
    {
        return $this->belongsToMany(Merchant::class, 'merchant_product')
                    ->withPivot('stok')
                    ->withTimestamps();
    }
    public function warehouse()
    {
        return $this->belongsToMany(Warehouse::class, 'warehouse_products')
                    ->withPivot('stok')
                    ->withTimestamps();
    }
    public function transactions()
    {
        return $this->hasMany(TransactionProduct::class);
    }
    public function getWarehouseProductStock(): int
    {
        return $this->warehouse()->sum('stock');
    }
    public function getMerchantProductStock(): int
    {
        return $this->merchants()->sum('stok');
    }
    public function getThumbnailAttribute($value)
    {
        if (!$value)
        {
            return null; // No image available
        }
       return url(Storage::url($value)); // domain.com/storage/products/nama-photo.png
    }
}
