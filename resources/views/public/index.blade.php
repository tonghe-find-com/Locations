@extends('pages::public.master')

@isset($model)
    @section('title',$model->meta_title==""?$model->title:$model->meta_title)
    @section('keywords',$model->meta_keywords)
    @section('description',$model->meta_description)
@else
    @section('title',$page->meta_title==""?$page->title:$page->meta_title)
    @section('keywords',$page->meta_keywords)
    @section('description',$page->meta_description)
@endisset


@push('css')

@endpush

@push('js')

@endpush

@push('banner')
    @include('template.banner')
@endpush

@section('content')
    <section>

        <div class="wrapper-B wrapper-location">
            <div class="wrapper-B__ball1"></div>
            <div class="wrapper-B__ball2"></div>
            <div class="container">
                <div class="flexLC mb-md-sm-d mb-lg">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{TypiCMS::homeUrl() }}">首頁</a></li>
                            <li aria-current="page" class="breadcrumb-item active">常見問題</li>
                        </ol>
                    </nav>
                </div>
                <div class="flexCC">
                    <h1 class="heading"><i class="fas fa-map-marked-alt"></i>服務據點</h1>
                </div>

                <div class="locationbox-group">
                    @foreach ($list as $item)
                    <div class="locationbox wow fadeInUp">
                        <div class="locationbox__pic" style="background-image: url('{{ $item->present()->image() }}')">
                            <!-- <div class="locationbox__pic-inner">

                            </div> -->
                            <div class="locationbox__bigtitle">{{$item->area}}</div>

                        </div>
                        <div class="locationbox__right">
                            <h2 class="locationbox__title">{{$item->title}}</h2>
                            <a class="locationbox__item" href="tel:{{ $item->phone }}">電話: <span>{{ $item->phone }}</span></a>
                            <a class="locationbox__item" href="{{ $item->address_link }}">地址: <span>{{ $item->address }}</span></a>
                            <a class="locationbox__item" href="mailto:{{ $item->email }}">Email: <span>{{ $item->email }}</span></a>
                        </div>
                    </div>
                    @endforeach
                </div>


            </div>
        </div>



    </section>
@endsection
