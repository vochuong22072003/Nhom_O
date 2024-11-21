@extends('client.layouts.layout')


@section('title', 'myactives')



 @section('main')
 <section class="bg0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 p-b-20">
                <div class="how2 how2-cl4 flex-s-c m-r-10 m-r-0-sr991">
                    <h3 class="f1-m-2 cl3 tab01-title">
                        Các bài viết liên quan đến tag: {{ $tag->tag_name }}
                    </h3>
                </div>

                <div class="row p-t-35">
                    @foreach ($posts as $post)
                    <div class="col-sm-6 p-r-25 p-r-15-sr991">
                        <!-- Item bài viết -->
                        <div class="m-b-45">
                            <a href="{{ route('client.detail', $post->encrypted_id) }}" class="wrap-pic-w hov1 trans-03">
                                <img src="{{ asset($post->image) }}" alt="IMG">
                            </a>

                            <div class="p-t-16">
                                <h5 class="p-b-5">
                                    <a href="{{ route('client.detail', $post->encrypted_id) }}" class="f1-m-3 cl2 hov-cl10 trans-03">
                                        {{ $post->post_name }}
                                    </a>
                                </h5>

                                <span class="cl8">
                                    <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                        by {{ $post->userInfo->name }}
                                    </a>

                                    <span class="f1-s-3 m-rl-3">
                                        -
                                    </span>

                                    <span class="f1-s-3">
                                        {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

 @endsection