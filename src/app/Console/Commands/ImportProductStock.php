<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportProductStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:product-stocks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import product stocks';

    protected function addStock($stock): void
    {
        ProductStock::query()->updateOrCreate([
            'product_sku' => $stock['sku'],
            'city' => $stock['city'],
        ], [
            'product_sku' => $stock['sku'],
            'city' => $stock['city'],
            'stock' => $stock['stock'],
        ]);
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $skus = Product::query()->select('sku')->get('sku')->pluck('sku')->toArray();
        collect(json_decode(file_get_contents($_ENV['IMPORT_PRODUCT_STOCKS_URL']), true))
            ->filter(fn ($row) => in_array($row['sku'], $skus))
            ->map(fn ($stock) => $this->addStock($stock));
    }
}
