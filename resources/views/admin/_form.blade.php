@push('js')
    <script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}

<file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>
<file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>
<div class="row gx-3">
    <div class="col-md-6">
        {!! TranslatableBootForm::text(__('Title'), 'title') !!}
    </div>
    <div class="col-md-6">
        {!! TranslatableBootForm::text(__('Area'), 'area') !!}
    </div>
    <div class="col-md-6">
        {!! TranslatableBootForm::text(__('Phone'), 'phone') !!}
    </div>
    <div class="col-md-6">
        {!! TranslatableBootForm::text(__('Address'), 'address') !!}
    </div>
    <div class="col-md-6">
        {!! TranslatableBootForm::text(__('Address Link'), 'address_link') !!}
    </div>
    <div class="col-md-6">
        {!! TranslatableBootForm::text(__('Email'), 'email') !!}
    </div>
</div>
<div class="mb-3">
    {!! TranslatableBootForm::hidden('show_homepage')->value(0) !!}
    {!! TranslatableBootForm::checkbox(__('Show in Homepage'), 'show_homepage') !!}
</div>
<div class="mb-3">
    {!! TranslatableBootForm::hidden('status')->value(0) !!}
    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
</div>
