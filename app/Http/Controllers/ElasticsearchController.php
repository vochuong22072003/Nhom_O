<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use Elasticsearch\ClientBuilder;

class ElasticsearchController extends Controller
{
    // Khởi tạo Elasticsearch client
    protected $elasticsearch;

    public function __construct()
    {
        // Khởi tạo Elasticsearch client
        $this->elasticsearch = app('elasticsearch');
    }
    public function syncDataToElasticsearch()
    {
        // Lấy tất cả các bài viết từ MySQL
        $posts = Post::all();  // Lấy tất cả dữ liệu từ bảng 'posts'

        // Đổ dữ liệu vào Elasticsearch
        foreach ($posts as $post) {
            $params = [
                'index' => 'posts2', // Tên index Elasticsearch
                'id'    => $post->id, // ID của bài viết
                'body'  => [
                    'post_name'    => $post->post_name,
                    'post_content' => $post->post_content,
                    'user_id'      => $post->user_id,
                    'image'        => $post->image,
                    'post_excerpt'  => $post->post_excerpt
                ]
            ];

            // Gửi dữ liệu vào Elasticsearch
            $this->elasticsearch->index($params);
        }

        return response()->json(['message' => 'Data synced to Elasticsearch successfully']);
    }

    public function search(Request $request)
    {
        $template = 'client.search-result';
        $config = $this->config(); // Nếu cần cấu hình

        // Nhận từ khóa tìm kiếm từ request
        $requestInput = $request->input('search');

        // Tạo truy vấn tìm kiếm trong Elasticsearch
        $params = [
            'index' => 'posts2', // Tên index Elasticsearch
            'body'  => [
                'query' => [
                    'multi_match' => [
                        'query' => $requestInput, // Từ khóa tìm kiếm
                        'fields' => ['post_name^2', 'post_content', 'user_id'] // Tìm kiếm trên các trường
                    ]
                ]
            ]
        ];

        // Thực hiện tìm kiếm trong Elasticsearch
        $response = $this->elasticsearch->search($params);

        // Lấy kết quả tìm kiếm
        $results = collect();
        if (isset($response['hits']['hits'])) {
            // Mảng kết quả tìm kiếm từ Elasticsearch
            $results = collect($response['hits']['hits'])->map(function ($hit) {
                // Lấy dữ liệu bài viết từ Elasticsearch và thêm trường `encrypted_id`
                $hit['_source']['encrypted_id'] = $this->encryptId($hit['_id']); // Mã hóa ID của bài viết
                return (object)$hit['_source']; // Trả về dữ liệu dưới dạng object
            });
        }

        // dd($results);

        // Trả kết quả về view
        return view($template, compact('config', 'results'));
    }

    private function config()
    {
        return [
            'js' => [
                'client/vendor/jquery/jquery-3.2.1.min.js',
                'client/vendor/animsition/js/animsition.min.js',
                'client/vendor/bootstrap/js/popper.js',
                'client/vendor/bootstrap/js/bootstrap.min.js',
                'client/js/main.js',
                'https://solascore.io/js/matches.js?v=<?=time();?>',
                'Backend/libary/client/comment.js',
            ],
            'css' => [
                'client/vendor/bootstrap/css/bootstrap.min.css',
                'client/fonts/fontawesome-5.0.8/css/fontawesome-all.min.css',
                'client/fonts/iconic/css/material-design-iconic-font.min.css',
                'client/vendor/animate/animate.css',
                'client/vendor/css-hamburgers/hamburgers.min.css',
                'client/vendor/animsition/css/animsition.min.css',
                'client/css/util.min.css',
                'client/css/main.css',
                'https://solascore.io/css/style.css?v=<?=time();?>',
            ],
        ];
    }
}
