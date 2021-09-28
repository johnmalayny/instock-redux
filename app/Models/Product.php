<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function watchlist()
    {
        return $this->belongsToMany(Watchlist::class);
    }

    public function retailers()
    {
        return $this->belongsToMany(Retailer::class)->withPivot([
            'retailer_product_page_url'
        ]);
    }
}
