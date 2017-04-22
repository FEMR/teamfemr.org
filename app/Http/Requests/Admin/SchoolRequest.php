<?php

namespace FEMR\Http\Requests\Admin\School;

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
            'address'                     => 'required|string',
            'address_ext'                 => 'sometimes|string',
            'locality'                    => 'required|string',
            'administrative_area_level_1' => 'required|string',
            'administrative_area_level_2' => 'sometimes|string',
            'postal_code'                 => 'required|string',
            'country'                     => 'required|string',
            'latitude'                    => 'sometimes|numeric',
            'longitude'                   => 'sometimes|numeric',
            'notes'                       => 'sometimes|string'
        ];
    }
}
