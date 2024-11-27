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
        // 1. Validate từ khóa tìm kiếm
        $request->validate([
            'search' => [
                'required',                  // Từ khóa bắt buộc
                'min:3',                     // Tối thiểu 3 ký tự
                'max:150',                   // Tối đa 150 ký tự
                'not_regex:/[<>&]/',         // Không chứa ký tự đặc biệt: <, >, &
            ],
        ]);

        // 2. Lấy từ khóa tìm kiếm từ request
        $searchQuery = $request->input('search');

        // 3. Cấu hình query Elasticsearch
        $params = [
            'index' => 'posts2', // Tên index Elasticsearch
            'body'  => [
                'query' => [
                    'multi_match' => [
                        'query'     => $searchQuery,           // Từ khóa tìm kiếm
                        'fields'    => ['post_name^2', 'post_content'], // Trường tìm kiếm, ưu tiên 'post_name'
                        'fuzziness' => 'AUTO',                // Cho phép sai chính tả
                    ],
                ],
                'size' => 10, // Giới hạn trả về tối đa 10 kết quả
            ],
        ];

        // 4. Thực hiện truy vấn Elasticsearch
        try {
            $response = $this->elasticsearch->search($params);
        } catch (\Exception $e) {
            // Xử lý lỗi Elasticsearch không phản hồi
            return back()->withErrors(['search' => 'Lỗi hệ thống, vui lòng thử lại sau.']);
        }

        // 5. Xử lý kết quả trả về
        $results = collect();
        if (!empty($response['hits']['hits'])) {
            $results = collect($response['hits']['hits'])->map(function ($hit) {
                $hit['_source']['encrypted_id'] = $this->encryptId($hit['_id']); // Mã hóa ID bài viết
                return (object) $hit['_source']; // Chuyển thành object
            });
        }

        // 6. Trả về view với kết quả
        return view('client.search-result', [
            'config' => $this->config(), // Cấu hình nếu cần
            'results' => $results,       // Kết quả tìm kiếm
        ]);
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
