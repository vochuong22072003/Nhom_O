@extends('client.layouts.layout')


@section('title', 'Home')

@section('main')
    <!-- Feature post -->
    <section class="bg0">
        <div class="container">
            <div class="row m-rl--1">
                <div class="col-md-6 p-rl-1 p-b-2">
                    <?php
                        // Lấy bài viết đầu tiên
                        if ($lastestNews->isNotEmpty()) {
                            $firstPost = $lastestNews->get(0); // Lấy bài viết đầu tiên
                            if (!is_null($firstPost->postCatalogueParent)){
                    ?>

                    <div class="bg-img1 size-a-3 how1 pos-relative"
                        style="background-image: url({{ asset($firstPost->image) }});">
                        <a href="{{ route('client.detail', $firstPost->encrypted_id) }}"
                            class="dis-block how1-child1 trans-03"></a>

                        <div class="flex-col-e-s s-full p-rl-25 p-tb-20">
                            <a href="{{ route('client.detail', $firstPost->encrypted_id) }}"
                                class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
                                {{ $firstPost->postCatalogueParent->post_catalogue_parent_name }}
                            </a>
                            <h3 class="how1-child2 m-t-14 m-b-10">
                                <a href="{{ route('client.detail', $firstPost->encrypted_id) }}"
                                    class="how-txt1 size-a-6 f1-l-1 cl0 hov-cl10 trans-03">
                                    {{ $firstPost->post_name }}
                                </a>
                            </h3>

                            <span class="how1-child2">
                                <span class="f1-s-4 cl11">
                                    {{ $firstPost->userInfo->name }}
                                </span>

                                <span class="f1-s-3 cl11 m-rl-3">
                                    -
                                </span>

                                <span class="f1-s-3 cl11">
                                    {{ \Carbon\Carbon::parse($firstPost->created_at)->format('d/m/Y') }}
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <?php 
                        }   
                    }
                    else { ?>
                <h2>Không có dữ liệu</h2>
                <?php } ?>


                <div class="col-md-6 p-rl-1">
                    <div class="row m-rl--1">
                        <?php
            // Lấy bài viết thứ 2 đến thứ 4 và hiển thị chúng
            for ($i = 1; $i <= 3; $i++) {
                $post = $lastestNews->get($i);
                if ($post && !is_null($post->postCatalogueParent)) {
                    // Gán id riêng cho 2 phần tử col-sm-6
                    $colId = '';
                    if ($i === 2) {
                        $colId = 'first-col-sm-6';
                    } elseif ($i === 3) {
                        $colId = 'second-col-sm-6';
                    }
        ?>
                        <div class="col-<?= $i === 1 ? '12' : 'sm-6' ?> p-rl-1 p-b-2" <?= $colId ? "id='$colId'" : '' ?>>
                            <div class="bg-img1 size-<?= $i === 1 ? 'a-4' : 'a-5' ?> how1 pos-relative"
                                style="background-image: url({{ asset($post->image) }});">
                                <a href="{{ route('client.detail', $post->encrypted_id) }}"
                                    class="dis-block how1-child1 trans-03"></a>

                                <div class="flex-col-e-s s-full p-rl-25 p-tb-<?= $i === 1 ? '24' : '20' ?>">
                                    <a href="#" aria-disabled="true"
                                        class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
                                        {{ $post->postCatalogueParent->post_catalogue_parent_name }}
                                    </a>
                                    <h3 class="how1-child2 m-t-14">
                                        <a href="{{ route('client.detail', $post->encrypted_id) }}"
                                            class="how-txt1 <?= $i === 1 ? 'size-a-7' : 'size-h-1' ?> f1-l-2 cl0 hov-cl10 trans-03">
                                            {{ $post->post_name }}
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <?php
                }
            }
        ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


    <section class="bg0 p-t-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12">
                    <div id="result"></div>
                </div>
            </div>
        </div>
    </section>


    <!-- Post -->
    <section class="bg0 p-t-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="p-b-20">
                        @if (count($getCatalogue) > 0)
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($getCatalogue as $cateParent)
                                @if ($count == 2)
                                @break
                            @endif
                            <div class="tab01 p-b-20">
                                <div class="tab01-head how2 how2-cl1 bocl12 flex-s-c m-r-10 m-r-0-sr991">
                                    <h3 class="f1-m-2 cl12 tab01-title">
                                        {{ $cateParent->post_catalogue_parent_name }}
                                    </h3>
                                    @if (count($cateParent->post_catalogue_children) > 0)
                                        <ul class="nav nav-tabs" role="tablist">
                                            @php $count2 = 0; @endphp
                                            @foreach ($cateParent->post_catalogue_children as $cateChildren)
                                                @if ($count2 == 5)
                                                @break
                                            @endif
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                    href="{{ route('client.category', ['id' => $cateChildren->encrypted_id, 'model' => 'children']) }}">{{ $cateChildren->post_catalogue_children_name }}</a>
                                            </li>
                                            @php $count2++; @endphp
                                        @endforeach
                                    </ul>
                                @else
                                    <li class="nav-item">
                                        <p class="nav-link">Không có danh mục</p>
                                    </li>
                                @endif

                                @if (count($cateParent->post_catalogue_children) > 5)
                                    <div class="dropdown">
                                        <a class="tab01-link f1-s-1 cl9 hov-cl10 trans-03 dropdown-toggle"
                                            href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-expanded="false">
                                            Xem thêm
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            @foreach ($cateParent->post_catalogue_children as $cateChildren)
                                                <li><a class="dropdown-item"
                                                        href="{{ route('client.category', ['id' => $cateChildren->encrypted_id, 'model' => 'children']) }}">{{ $cateChildren->post_catalogue_children_name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <!-- Tab panes -->
                            <div class="tab-content p-t-35">
                                <!-- - -->
                                <div class="tab-pane fade show active" id="tab1-1" role="tabpanel">
                                    <div class="row">
                                        @if (count($results))
                                            @foreach ($results as $key => $val)
                                                @if ($key == $count && !empty($val[0]))
                                                    <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                                        <!-- Item post -->
                                                        <div class="m-b-30">
                                                            <a href="{{ route('client.detail', $val[0]->encrypted_id) }}"
                                                                class="wrap-pic-w hov1 trans-03">
                                                                <img src="{{ isset($val[0]->image) ? asset($val[0]->image) : '' }}"
                                                                    alt="IMG">
                                                            </a>

                                                            <div class="p-t-20">
                                                                <h5 class="p-b-5">
                                                                    <a href="{{ route('client.detail', $val[0]->encrypted_id) }}"
                                                                        class="f1-m-3 cl2 hov-cl10 trans-03">
                                                                        {{ isset($val[0]->post_name) ? $val[0]->post_name : '' }}
                                                                    </a>
                                                                </h5>

                                                                <span class="cl8">
                                                                    <a href="#"
                                                                        class="f1-s-4 cl8 hov-cl10 trans-03">
                                                                        {{ isset($val[0]->postCatalogueChildren->post_catalogue_children_name) ? $val[0]->postCatalogueChildren->post_catalogue_children_name : '' }}
                                                                    </a>

                                                                    <span class="f1-s-3 m-rl-3">
                                                                        {{ isset($val[0]->postCatalogueChildren->post_catalogue_children_name) ? '-' : '' }}
                                                                    </span>

                                                                    <span class="f1-s-3">
                                                                        {{ isset($val[0]->created_at) ? \Carbon\Carbon::parse($val[0]->created_at)->format('d/m/Y') : '' }}

                                                                    </span>
                                                                </span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @break
                                            @endif
                                        @endforeach
                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">

                                            @foreach ($results as $key => $val)
                                                @if ($key == $count)
                                                    @foreach ($val->all() as $ke => $va)
                                                        @if ($ke >= 1)
                                                            <!-- Item post -->
                                                            <div class="flex-wr-sb-s m-b-30">
                                                                <a href="{{ route('client.detail', $val[$ke]->encrypted_id) }}"
                                                                    class="size-w-1 wrap-pic-w hov1 trans-03">
                                                                    <img src="{{ isset($val[$ke]->image) ? asset($val[$ke]->image) : '' }}"
                                                                        alt="IMG">
                                                                </a>

                                                                <div class="size-w-2">
                                                                    <h5 class="p-b-5">
                                                                        <a href="{{ route('client.detail', $val[$ke]->encrypted_id) }}"
                                                                            class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                            {{ isset($val[$ke]->post_name) ? $val[$ke]->post_name : '' }}
                                                                        </a>
                                                                    </h5>

                                                                    <span class="cl8">
                                                                        <a href="#"
                                                                            class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                            {{ isset($val[$ke]->postCatalogueChildren->post_catalogue_children_name) ? $val[$ke]->postCatalogueChildren->post_catalogue_children_name : '' }}
                                                                        </a>

                                                                        <span class="f1-s-3 m-rl-3">
                                                                            -
                                                                        </span>

                                                                        <span class="f1-s-3">
                                                                            {{ isset($val[$ke]->created_at) ? \Carbon\Carbon::parse($val[$ke]->created_at)->format('d/m/Y') : '' }}
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @php $count++; @endphp
                @endforeach
            @else
                <h2>Không có dữ liệu</h2>
            @endif
        </div>
    </div>



    <div class="col-md-10 col-lg-4">
        
        @include('client.layouts.sidebar')
    </div>
    
</div>
</div>
</section>


<!-- Latest -->
<section class="bg0 p-t-60 p-b-35">
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8 p-b-20">
        <div class="how2 how2-cl4 flex-s-c m-r-10 m-r-0-sr991">
            <h3 class="f1-m-2 cl3 tab01-title">
                Các bài viết nhiều lượt thích
            </h3>
        </div>

        <div class="row p-t-35">
            @if ($posts->isNotEmpty())
                @foreach ($posts as $post)
                    <div class="col-sm-6 p-r-25 p-r-15-sr991">
                        <!-- Item latest -->
                        <div class="m-b-45">
                            <a href="{{ route('client.detail', $post->encrypted_id) }}"
                                class="wrap-pic-w hov1 trans-03">
                                <h1>{{ $post->encrypted_idaa }}</h1>
                                <img src="{{ asset($post->image) }}" alt="IMG">
                            </a>

                            <div class="p-t-16">
                                <h5 class="p-b-5">
                                    <a href="{{ route('client.detail', $post->encrypted_id) }}"
                                        class="f1-m-3 cl2 hov-cl10 trans-03">
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
            @else
                <h2>Không có dữ liệu</h2>
            @endif
        </div>
    </div>

    <div class="col-md-10 col-lg-4">
        <div class="p-l-10 p-rl-0-sr991 p-b-20">
        </div>
    </div>



</div>
</div>
</section>



<section class="bg0 ">
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8 p-b-20">
        <div class="how2 how2-cl4 flex-s-c m-r-10 m-r-0-sr991">
            <h3 class="f1-m-2 cl3 tab01-title">
                Các bài viết được xem nhiều nhất
            </h3>
        </div>

        <div class="row p-t-35">
            @if ($view->isNotEmpty())
                @foreach ($view as $views)
                    <div class="col-sm-4 p-r-25 p-r-15-sr991">
                        <!-- Item latest -->
                        <div class="m-b-45">
                            <a href="{{ route('client.detail', $views->encrypted_id) }}"
                                class="wrap-pic-w hov1 trans-03">
                                <img src="{{ asset($views->image) }}" alt="IMG">
                            </a>

                            <div class="p-t-16">
                                <h5 class="p-b-5">
                                    <a href="{{ route('client.detail', $views->id) }}"
                                        class="f1-m-3 cl2 hov-cl10 trans-03">
                                        {{ $views->post_name }}
                                    </a>
                                </h5>

                                <span class="cl8">
                                    <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                        by {{ $views->userInfo->name }}
                                    </a>

                                    <span class="f1-s-3 m-rl-3">
                                        -
                                    </span>

                                    <span class="f1-s-3">
                                        {{ \Carbon\Carbon::parse($views->created_at)->format('d/m/Y') }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h2>Không có dữ liệu</h2>
            @endif
        </div>
    </div>
    <div class="col-md-10 col-lg-4">
        <div class="p-l-10 p-rl-0-sr991 p-b-20">
        </div>
    </div>
    
</div>
</div>
</section>
@endsection
