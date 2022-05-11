@extends('core::admin.master')

@section('title', __('Locations'))

@section('content')

<item-list
    url-base="/api/locations"
    locale="{{ config('typicms.content_locale') }}"
    fields="id,image_id,status,title,position,updated_at"
    table="locations"
    title="locations"
    include="image"
    appends="thumb"
    :exportable="false"
    :searchable="['title']"
    :sorting="['position']">

    <template slot="add-button" v-if="$can('create locations')">
        @include('core::admin._button-create', ['module' => 'locations'])
    </template>

    <template slot="columns" slot-scope="{ sortArray }">
        <item-list-column-header name="checkbox" v-if="$can('update locations')||$can('delete locations')"></item-list-column-header>
        <item-list-column-header name="edit" v-if="$can('update locations')"></item-list-column-header>
        <item-list-column-header name="status_translated" sortable :sort-array="sortArray" :label="$t('Status')"></item-list-column-header>
        <item-list-column-header name="image" :label="$t('Image')"></item-list-column-header>
        <item-list-column-header name="position" sortable :sort-array="sortArray" :label="$t('Position')"></item-list-column-header>
        <item-list-column-header name="title_translated" sortable :sort-array="sortArray" :label="$t('Title')"></item-list-column-header>
        <item-list-column-header :label="$t('Last Update Time')"></item-list-column-header>
    </template>

    <template slot="table-row" slot-scope="{ model, checkedModels, loading }">
        <td class="checkbox" v-if="$can('update locations')||$can('delete locations')"><item-list-checkbox :model="model" :checked-models-prop="checkedModels" :loading="loading"></item-list-checkbox></td>
        <td v-if="$can('update locations')">@include('core::admin._button-edit', ['module' => 'locations'])</td>
        <td><item-list-status-button :model="model"></item-list-status-button></td>
        <td><img :src="model.thumb" alt="" height="27"></td>
        <td><item-list-position-input :model="model"></item-list-position-input></td>
        <td v-html="model.title_translated"></td>
        <td>@{{ getMoment(model.updated_at ) }}</td>
    </template>

</item-list>

@endsection
