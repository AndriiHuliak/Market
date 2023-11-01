<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','summary','description','stock','brand_id','cat_id','child_cat_id','photo','price','offer_price','discount','size','condition','vendor_id','status'];

    public function brands()
    {
        return $this->belongsTo(Brand::class);
    }

    public function rel_prods()
    {
        return $this->hasMany(Product::class, 'cat_id', 'cat_id')->where('status', 'active')->limit(10);
    }
}
