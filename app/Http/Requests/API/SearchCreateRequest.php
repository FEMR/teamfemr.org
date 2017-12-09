<?php

namespace FEMR\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class SearchCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'search_by' => 'sometimes|string',
            'name'      => 'sometimes|string',
            'latitude'  => 'sometimes|required_if:search_by,location|numeric',
            'longitude' => 'sometimes|required_if:search_by,location|numeric'
        ];
    }
}
