<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    /**
     * Get the products for the category.
     */
    public function products() // Changed method name to plural form
    {
        return $this->hasMany(Product::class);
    }
}
