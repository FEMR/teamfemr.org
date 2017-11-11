<?php

namespace FEMR\Http\Requests\API;

use FEMR\Data\Models\OutreachProgram;
use FEMR\Data\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class SurveyRequest extends FormRequest
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

            "name" => [
                "required",
                "string"
            ],
            "school_name" => "string",
            "uses_emr" => [
                "required",
                "boolean"
            ],
            "year_initiated" => "string",
            "yearly_outreach_participants" => "string",
            "months_of_travel" => "array",
            "matriculants_per_class" => "string"
        ];
    }

    public function survey(){

        return $this->only([

            "name",
            "school_name",
            "uses_emr",
            "year_initiated",
            "yearly_outreach_participants",
            "months_of_travel",
            "matriculants_per_class",
            "comments"
        ]);
    }
}
