@extends('client.layouts.layout')


@section('title', 'myactives')



 @section('main')
 <div class="container">
    <h2>Bài viết bạn đã thích</h2>
    {{-- @if($likedPosts->isEmpty())
        <p>Chưa có bài viết nào bạn đã thích.</p>
    @else --}}
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên bài viết</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Ngày đăng</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            {{-- <tbody>
                @foreach($likedPosts as $post)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $post->post_name }}</td>
                        <td>{{ $post->post_excerpt }}</td>
                        <td>{{ $post->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm">Xem</a>
                        </td>
                    </tr>
                @endforeach
            </tbody> --}}
        </table>
    {{-- @endif --}}
</div>
 @endsection
