<?php

namespace App\Helpers\Watchlist;

use App\Models\Product;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use App\Helpers\Profile\ProfileOwnsThisWatchlist;

class AddProductToWatchlist
{
    public static function handle(Request $request):bool
    {
        $validated = $request->validate([
            'watchlist_id' => 'required',
            'product_id' => 'required'
        ]);

        $watchlist = Watchlist::where('id', $validated['watchlist_id'])->firstOrFail();

        $product = Product::where('id', $validated['product_id'])->firstOrFail();

        if (ProfileOwnsThisWatchlist::check($request->user()->profile, $watchlist)) {
            $watchlist->products()->save($product);
            return true;
        }

        return false;
    }
}
