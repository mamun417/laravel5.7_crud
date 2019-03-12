<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static orderBy(string $string, string $string1)
 */
class Category extends Model
{
    protected $fillable = ['name', 'description', 'parent_id', 'image', 'status'];

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function childrens(){
        return $this->hasMany(Category::class, 'parent_id');
    }
}
