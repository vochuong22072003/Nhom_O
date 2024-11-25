@extends('client.layouts.layout')


@section('title', 'myactives')



 @section('main')
 <style>

    h2, h1 {
        text-align: center;
        color: #1dbfaf; 
        margin-bottom: 20px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin: 20px auto;
        background-color: #1e1e2f; 
        color: #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
    }

    table th, table td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #444;
    }

    table th {
        background-color: #2a2a3d;
        color: #1dbfaf; /* Màu nổi bật cho tiêu đề bảng */
        font-weight: bold;
    }

    table td a {
        color: #1dbfaf;
        text-decoration: none;
    }

    table td a:hover {
        text-decoration: underline;
    }

    .btn {
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        color: #fff;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-danger {
        background-color: #e63946;
    }

    .btn-danger:hover {
        background-color: #a32732;
    }

    .btn-warning {
        background-color: #f4a261;
    }

    .btn-warning:hover {
        background-color: #d18c4a;
    }

    .saved-posts {
        margin-top: 20px;
    }
</style>
 <div class="container">
    <h2>Bài viết bạn đã thích</h2>
    <table>
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
                    <td><a href="{{ route('client.detail', $like->encrypted_id) }}" class="btn btn-primary">Xem chi tiết</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h1>Các thư mục đã lưu</h1>
    <table>
        <thead>
            <tr>
                <th>Tên thư mục</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($savedFolders as $folderId => $folderGroup)
                <tr>
                    <td>
                        <a href="#folder{{ $folderId }}" data-toggle="collapse">{{ $folderGroup[0]->folder_name }}</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @foreach ($savedFolders as $folderId => $folderGroup)
        <div id="folder{{ $folderId }}" class="saved-posts collapse">
            <table>
                <thead>
                    <tr>
                        <th colspan="2">
                            Bài viết trong thư mục: <strong>{{ $folderGroup[0]->folder_name }}</strong>
                            <form action="{{ route('folders.delete', $folderId) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa thư mục này không?')" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa thư mục</button>
                            </form>
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
                            <td>
                                <form action="{{ route('folders.posts.delete', ['folderId' => $folderId, 'postId' => $savedPost->post_id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này khỏi thư mục không?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-warning">Xóa bài viết</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</div>
 @endsection
