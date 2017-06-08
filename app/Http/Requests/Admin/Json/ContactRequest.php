<?php

    namespace FEMR\Http\Requests\Admin\Json;

    use Illuminate\Foundation\Http\FormRequest;

    class ContactRequest extends FormRequest
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

                'prefix'      => 'string|max:255',
                'first_name'  => 'required|string|max:255',
                'middle_name' => 'string|max:255',
                'last_name'   => 'string|max:255',
                'suffix'      => 'string|max:255',
                'title'       => 'string|max:255',
                'phone'       => 'string|max:255',
                'email'       => 'email',
                'notes'       => 'string'
            ];
        }
    }
