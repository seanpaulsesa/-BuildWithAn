<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'photo', 'taglien'];
    public function Products()
    {
        return $this->hasMany(Product::class);
    }
    public function getPhotoAtribute($value)
    {
        if (!$value)
        {
            return null;
        }
        return url(Storage::url($value));
    }
}
