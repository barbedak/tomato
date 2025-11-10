<?php

namespace App\Console\Commands;

use App\HttpClients\PostHttpClient;
use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws \Exception
     */
    public function handle()
    {

        $res = PostHttpClient::make()->login()->indexPosts();
        dd($res->json());
        foreach ($res->collect() as $item) {
            Post::firstOrCreate([
                'title' => $item['title'],
            ]);
        }
    }
}
