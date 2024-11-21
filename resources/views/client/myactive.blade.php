@extends('client.layouts.layout')


@section('title', 'myactives')



 @section('main')
 <div class="container">
    <h2>Bài viết bạn đã thích</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Tên bài viết</th>
                <th>Ngày tạo</th>
                <th>Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($likes as $like)
                <tr>
                    
                    <td>{{ $like->post_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($like->created_at)->format('d/m/Y') }}</td>
                    <td><a href="{{ route('client.detail', $like->encrypted_id) }}" class="btn">Xem chi tiết</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    <h1 style="text-align: center; color:">Các thư mục đã lưu</h1>
    <div class="container mt-4">
        <!-- Bảng danh sách thư mục -->
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Tên thư mục</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($savedFolders as $folderId => $folderGroup)
                    <tr>
                        <td>
                            <a href="#folder{{ $folderId }}" data-toggle="collapse" class="btn btn-link" data-folder-id="{{ $folderId }}">
                                {{ $folderGroup[0]->folder_name }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <!-- Danh sách bài viết trong từng thư mục -->
        @foreach ($savedFolders as $folderId => $folderGroup)
            <div id="folder{{ $folderId }}" class="saved-posts collapse">
                <table class="table table-striped table-bordered mt-3">
                    <thead>
                        <tr>
                            <th colspan="2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Bài viết trong thư mục: <strong>{{ $folderGroup[0]->folder_name }}</strong></span>
                                    <form action="{{ route('folders.delete', $folderId) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa thư mục này không?')" class="ml-auto">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Xóa thư mục</button>
                                    </form>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($folderGroup as $savedPost)
                            <tr>
                                <td>
                                    <a href="{{ route('client.detail', $savedPost->encrypted_post_id) }}">
                                        {{ $savedPost->post_name }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('folders.posts.delete', ['folderId' => $folderId, 'postId' => $savedPost->post_id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này khỏi thư mục không?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-warning btn-sm">Xóa bài viết</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
    
</div>
</div>
 @endsection
