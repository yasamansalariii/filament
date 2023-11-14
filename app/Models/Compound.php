<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Compound;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Compound extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','product_id'];

    
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
