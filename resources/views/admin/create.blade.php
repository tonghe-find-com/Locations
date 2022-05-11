@extends('core::admin.master')

@section('title', __('New location'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'locations'])
        <h1 class="header-title">@lang('New location')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-locations'))->multipart()->role('form') !!}
        @include('locations::admin._form')
    {!! BootForm::close() !!}

@endsection
