<?php

namespace App\Services;

use App\Services\Interfaces\HomeServiceInterface;
use App\Repositories\Interfaces\HomeRepositoryInterface as HomeRepository;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use Illuminate\Support\Facades\DB;
use App\Models\Like;



class HomeService implements HomeServiceInterface
{
    protected $homeRepository;
    protected $postRepository;

    public function __construct(HomeRepository $homeRepository, PostRepository  $postRepository)
    {
        $this->homeRepository = $homeRepository;
        $this->postRepository =  $postRepository;
    }

    public function getLastestNew(int $limit = 4, array $relations = [], array $conditions = [], array $orderBy = ['created_at', 'desc'])
    {
        return $this->homeRepository->getLastestNew($limit, $relations, $conditions, $orderBy);
    }
    
    public function getActiveParentCategoriesWithChildren() {
        return $this->homeRepository->getActiveParentCategoriesWithChildren();
    }
    public function getPostsByCategory($id, $model) {
        return $this->homeRepository->getPostsByCategory($id, $model);
    }
    public function getCategoryInfo($id, $model) {
        return $this->homeRepository->getCategoryInfo($id, $model);
    }
    public function getPost($id) {
        return $this->homeRepository->getPost($id);
    }
    public function getPostsBySearch($request) {
        $condition = [
            [
                'post_name','LIKE',$request
            ]
        ];
        $results = $this->postRepository->findByConditions($condition);
        return $results;
    }
    public function getPostByLike()
    {
        $topLikedPosts = Like::select('post_id', DB::raw('COUNT(post_id) as like_count'))
        ->groupBy('post_id')
        ->orderBy('like_count', 'desc')
        ->take(3)
        ->get();
        // dd($topLikedPosts);
        foreach ($topLikedPosts as $topLikedPost) {
            $post_ids[] = $topLikedPost->post_id;
        }
        // dd($post_ids);

        foreach ($topLikedPosts as $topLikedPost) {
            $post_counts[] = $topLikedPost->like_count;
        }
        // dd($post_counts);
        if(!empty($post_ids)){
            $topLikedPosts = $this->postRepository->findWhereInByOrder('id', $post_ids);
            // dd($topLikedPosts);
            foreach ($topLikedPosts as $topLikedPost) {
                $topLikedPost->encrypted_id = $this->encryptId($topLikedPost->id);
            }

            foreach ($topLikedPosts as $index => $topLikedPost) {
                $topLikedPost->like_count = $post_counts[$index] ?? 0;
            }
            
            // dd($topLikedPosts);
        }else{
            $topLikedPosts = null;
        }

        return $topLikedPosts;
    }
    public function encryptId($id)
    {
        $salt = "chuoi_noi_voi_id";
        return base64_encode($id . $salt);
    }
}
