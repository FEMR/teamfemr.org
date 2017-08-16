<?php

namespace FEMR\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SchoolRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'name'                        => 'required|string',
            'slug'                        => 'sometimes|string',
            'address'                     => 'sometimes|string',
            'address_ext'                 => 'sometimes|string',
            'locality'                    => 'sometimes|string',
            'administrative_area_level_1' => 'sometimes|string',
            'administrative_area_level_2' => 'sometimes|string',
            'postal_code'                 => 'sometimes|string',
            'country'                     => 'sometimes|string',
            'latitude'                    => 'sometimes|numeric',
            'longitude'                   => 'sometimes|numeric',
            'notes'                       => 'sometimes|string'
        ];
    }
}
