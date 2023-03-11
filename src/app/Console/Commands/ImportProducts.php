<?php

namespace App\Console\Commands;

use App\Jobs\ImportProduct;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Throwable;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $importProducts = collect(json_decode(file_get_contents($_ENV['IMPORT_PRODUCTS_URL'])));

        Bus::batch($importProducts->map(fn($product) => new ImportProduct($product)))
            ->then(function (Batch $batch) {
                // All jobs completed successfully...
            })->catch(function (Batch $batch, Throwable $e) {
                // First batch job failure detected...
            })->finally(function (Batch $batch) {
                // The batch has finished executing...
            })->name('import products')->dispatch();
    }
}
