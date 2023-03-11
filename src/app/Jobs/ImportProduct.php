<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\ProductTag;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class ImportProduct implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public object $product)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $product = Product::query()->create([
            'sku' => $this->product->sku,
            'description' => $this->product->description,
            'photo' => $this->product->photo,
            'size' => $this->product->size,
            'updated_at' => $this->product->updated_at,
        ]);

        foreach ($this->product->tags as $productTag) {
            $tag = ProductTag::query()->firstOrCreate([
                'title' => $productTag->title
            ], [
                'title' => $productTag->title
            ]);

            $product->tags()->attach($tag);
        }

        Cache::forget("product_{$product->sku}");
    }
}
