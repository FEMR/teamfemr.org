<?php

    namespace FEMR\Http\Requests\Admin;

    use Illuminate\Foundation\Http\FormRequest;

    class PaperRequest extends FormRequest
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
                'title'       => 'required|string',
                'url'         => 'required|string|url',
                'description' => 'required|string|max:65535'
            ];
        }
    }
