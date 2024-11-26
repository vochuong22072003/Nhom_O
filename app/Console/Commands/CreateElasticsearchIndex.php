<?php

namespace App\Console\Commands;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Console\Command;

class CreateElasticsearchIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * Tên lệnh Artisan
     */
    protected $signature = 'elasticsearch:create-index {index=posts2}';

    /**
     * The console command description.
     * Mô tả của lệnh
     * @var string
     */
    protected $description = 'Create an Elasticsearch index for posts';

    /**
     * Execute the console command.
     */
    protected $elasticsearch;

    public function __construct()
    {
        parent::__construct();
        
         $this->elasticsearch = app('elasticsearch');
    }

    public function handle()
    {
        $indexName = $this->argument('index'); // Tên index (mặc định là "posts")

        // Cấu hình index
        $params = [
            'index' => $indexName,
            'body' => [
                'settings' => [
                    'number_of_shards' => 1,
                    'number_of_replicas' => 0,
                ],
                'mappings' => [
                    'properties' => [
                        'post_name' => [
                            'type' => 'text',
                            'analyzer' => 'standard', // Tìm kiếm toàn văn
                        ],
                        'post_content' => [
                            'type' => 'text',
                            'analyzer' => 'standard',
                        ],
                        'post_excerpt' => [
                            'type' => 'text',
                            'analyzer' => 'standard',
                        ],
                        'user_id' => [
                            'type' => 'keyword', // Tìm kiếm chính xác
                        ],
                        'image' => [  // Thêm trường image
                            'type' => 'text',  // Hoặc 'keyword' nếu bạn lưu URL
                        ],
                    ],
                ],
            ],
        ];

        // Kiểm tra nếu index đã tồn tại
        // if ($this->elasticsearch->indices()->exists(['index' => $indexName])) {
        //     $this->warn("Index '{$indexName}' already exists.");
        //     return;
        // }

        // Tạo index
        $response = $this->elasticsearch->indices()->create($params);

        // Thông báo kết quả
        if (isset($response['acknowledged']) && $response['acknowledged']) {
            $this->info("Index '{$indexName}' created successfully!");
        } else {
            $this->error("Failed to create index '{$indexName}'.");
        }
    }
}
