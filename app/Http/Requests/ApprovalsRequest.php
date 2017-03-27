<?php

namespace FEMR\Http\Requests;

use FEMR\Http\Requests\Request;

class ApprovalsRequest extends Request
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
        // approvals.* is used to let the validator know the field is an array
        return [

            'approvals.*' => 'integer'
        ];
    }
}
