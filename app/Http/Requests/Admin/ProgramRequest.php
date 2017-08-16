<?php

    namespace FEMR\Http\Requests\Admin;

    use Illuminate\Foundation\Http\FormRequest;

    class ProgramRequest extends FormRequest
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
                'school_id'                    => 'sometimes|min:1|exists:schools,id',
                'name'                         => 'required|string',
                'slug'                         => 'sometimes|string',
                'year_initiated'               => 'sometimes|numeric|min:1800',
                'yearly_outreach_participants' => 'sometimes|string',
                'matriculants_per_class'       => 'sometimes|string',
                'months_of_travel'             => 'sometimes|string',
                'uses_emr'                     => 'required|boolean'
            ];
        }

        public function messages()
        {
            return [

              'school_id.exists' => 'Please choose a School'
            ];
        }
    }
