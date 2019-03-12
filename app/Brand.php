<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static orderBy(string $string, string $string1)
 */
class Brand extends Model
{
    protected $fillable = ['name', 'description', 'status'];
}
