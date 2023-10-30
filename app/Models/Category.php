<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'photo', 'is_parent', 'summary', 'parent_id', 'status'];

    public static function shiftChild($cat_id){
        return Category::whereIn('id', $cat_id)->update(['is_parent'=>1]);
    }

    public static function getChildByParentID($id){
        return Category::where('parent_id', $id)->pluck('title', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'cat_id', 'id');
    }
}
