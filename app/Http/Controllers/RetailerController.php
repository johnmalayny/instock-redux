<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Retailer;
use Illuminate\Http\Request;

class RetailerController extends Controller
{
    public function addProduct(Request $request)
    {
        $validated = $request->validate([
            'retailer_id' => 'required',
            'product_id' => 'required',
            'retailer_product_page_url' => 'required'
        ]);

        $retailer = Retailer::where('id', $validated['retailer_id'])->firstOrFail();

        $product = Product::where('id', $validated['product_id'])->firstOrFail();

        $retailer->products()->save($product, [
            'retailer_product_page_url' => $validated['retailer_product_page_url']
        ]);

        return redirect()->route('watchlists.index');
    }
}
