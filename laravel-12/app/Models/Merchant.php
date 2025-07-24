<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchant extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'addres', 'photo', 'phone', 'keeper_id'];
    public function keeper()
    {
        return $this->belongsTo(User::class, 'merchant_products')
                    ->withPivot('stock')
                    ->withPivot('warehouse_id')
                    ->withTimestamps();
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function getPhotoAttribute($value)
    {
        if (!$value)
        {
            return null; // No image available
        }
        return url(Storage::url($value));
    }
}
