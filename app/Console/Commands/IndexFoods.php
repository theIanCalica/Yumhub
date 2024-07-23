<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Algolia\AlgoliaSearch\SearchClient;
use App\Models\Food;

class IndexFoods extends Command
{

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'algolia:index-foods';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index all foods to Algolia';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = SearchClient::create(config('services.algolia.id'), config('services.algolia.secret'));
        $index = $client->initIndex('foods');

        $foods = Food::with('category', 'cuisine')->get()->map(function ($food) {
            return [
                'objectID' => $food->id,
                'name' => $food->name,
                'category' => $food->category->name,
                'cusine' => $food->cuisine->name,
                'price' => $food->price,
                'filePath' => $food->filePath,
            ];
        })->toArray();

        $index->saveObjects($foods);

        $this->info('Foods indexed successfully!');
    }
}
