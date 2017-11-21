<?php

namespace FEMR\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class OutreachProgramRequest extends FormRequest
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

            'search_text' => 'sometimes|string',
            'latitude'    => 'required_with:longitude|float',
            'longitude'   => 'required_with:latitude|float'
        ];
    }

    public function filters(){

        return $this->only([

            'search_text',
            'latitude',
            'longitude'
       ]);
    }
}
