<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductTag;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ProductController extends Controller
{

    public function index(): View
    {
        $topTenTags = ProductTag::query()
            ->withSum('stocks', 'stock')
            ->orderBy('stocks_sum_stock', 'desc')
            ->limit(10)
            ->get();

        $products = Product::query()->with(['tags'])->withSum('stocks', 'stock')->paginate(6);

        return view('products', compact('products', 'topTenTags'));
    }

    public function show(string $sku): View
    {
        $key = "product_{$sku}";

        if (!Cache::has("product_{$sku}")) {
            Cache::rememberForever($key, function () use ($sku) {
                return Product::query()->with(['tags'])->findOrFail($sku);
            });
        }

        $product = Cache::get("product_{$sku}");

        return view('product', compact('product'));
    }
}
