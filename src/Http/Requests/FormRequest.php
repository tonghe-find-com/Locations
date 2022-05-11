<?php

namespace TypiCMS\Modules\Locations\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'image_id' => 'nullable|integer',
            'title.*' => 'nullable|max:255',
            'area.*' => 'nullable|max:255',
            'phone.*' => 'nullable|max:255',
            'address.*' => 'nullable|max:255',
            'address_link.*' => 'nullable|max:255',
            'email.*' => 'nullable|max:255',
            'show_homepage.*' => 'boolean',
            'status.*' => 'boolean',
        ];
    }
}
