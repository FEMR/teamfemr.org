<?php

namespace FEMR\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class SlackInviteRequest extends FormRequest
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

            'email'      => 'required|email',
            'first_name' => 'sometimes|string',
            'last_name'  => 'sometimes|string'
        ];
    }
}
