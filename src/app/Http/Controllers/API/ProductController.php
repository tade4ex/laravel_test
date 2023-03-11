<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductController extends Controller
{

    public function index(): JsonResource
    {
        $products = Product::query()->with(['tags', 'stocks'])->get();

        return new ProductCollection($products);
    }
}
