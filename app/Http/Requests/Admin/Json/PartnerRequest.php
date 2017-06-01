<?php

    namespace FEMR\Http\Requests\Admin\Json;

    use Illuminate\Foundation\Http\FormRequest;

    class PartnerRequest extends FormRequest
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
                'name'    => 'required|string',
                'website' => 'required|string|url'
            ];
        }
    }
