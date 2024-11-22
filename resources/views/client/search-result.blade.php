@extends('client.layouts.layout')

@section('title', 'Detail')

@section('main')
    <!-- Post -->
    <section class="bg0 p-b-55">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12 p-b-80">
                    <div class="p-r-10 p-r-0-sr991">
                        <div class="m-t--40 p-b-40">
                            @if($results->isNotEmpty())
                            @foreach($results as $result)
                            <!-- Item post -->
                            <div class="flex-wr-sb-s p-t-40 p-b-15 how-bor2">
                                <a href="{{ route('client.detail', $result->encrypted_id) }}" class="size-w-8 wrap-pic-w hov1 trans-03 w-full-sr575 m-b-25">
                                    <img src="{{ asset($result->image) }}" alt="IMG">
                                </a>

                                <div class="size-w-9 w-full-sr575 m-b-25">
                                    <h5 class="p-b-12">
                                        <a href="{{ route('client.detail', $result->encrypted_id) }}" class="f1-l-1 cl2 hov-cl10 trans-03 respon2">
                                           {{ $result->post_name }}
                                        </a>
                                    </h5>

                                    <div class="cl8 p-b-18">
                                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                            by {{  $result->userInfo->name }}
                                        </a>

                                        <span class="f1-s-3 m-rl-3">
                                            -
                                        </span>

                                        <span class="f1-s-3">
                                            {{ \Carbon\Carbon::parse($result->created_at)->format('d/m/Y') }}
                                        </span>
                                    </div>

                                    <p class="result-post-excerpt">
                                       {!! $result->post_excerpt  !!}
                                    </p>

                                    <a href="{{ route('client.detail', $result->encrypted_id) }}" class="f1-s-1 cl9 hov-cl10 trans-03">
                                        Read More
                                        <i class="m-l-2 fa fa-long-arrow-alt-right"></i>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <h2 class="no-search-result">Không có dữ liệu</h2>
                            @endif
                            
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
@endsection
