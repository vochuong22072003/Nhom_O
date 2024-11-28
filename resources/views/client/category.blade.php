@extends('client.layouts.layout')

@section('title', 'Category')
	
@section('main')

	<!-- Page heading -->
	<div class="container p-t-4 p-b-40">
		<h2 class="f1-l-1 cl2">
			{{ $categoryInfo }}
		</h2>
	</div>

	<!-- Post -->
	<section class="bg0 p-t-70 p-b-55">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-10 col-lg-8 p-b-80">
					<div class="row">				
						@if($category[0]->posts->isNotEmpty()) 
						@foreach($category as $cate)
						@foreach($cate->posts as $post)
						<div class="col-sm-6 p-r-25 p-r-15-sr991">
							<!-- Item latest -->	
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
									<h5 class="p-b-5" id="post_excerpt">									
											{!! $post->post_excerpt !!}					
									</h5>

									<span class="cl8">
										<a href="{{ route('client.detail', $post->encrypted_id) }}" class="f1-s-4 cl8 hov-cl10 trans-03">
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
						@endforeach
						@else
						<h1>Không có bài viết</h1>
						@endif
			
					</div>

					<!-- Pagination -->
					<div class="flex-wr-s-c m-rl--7 p-t-15">
						{{-- <a href="#" class="flex-c-c pagi-item hov-btn1 trans-03 m-all-7 pagi-active">1</a>
						<a href="#" class="flex-c-c pagi-item hov-btn1 trans-03 m-all-7">2</a> --}}
						{{-- {{ $paginatedPosts->links() }} --}}
					</div>
				</div>

				<div class="col-md-10 col-lg-4 p-b-80">
					@include('client.layouts.sidebar')
				</div>
			</div>
		</div>
	</section>
@endsection