<?php

    namespace FEMR\Http\Requests\Admin\Json;

    use Illuminate\Foundation\Http\FormRequest;

    class LocationRequest extends FormRequest
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
                'start_date'                  => 'required|date_format:Y-m-d',
                'end_date'                    => 'required|date_format:Y-m-d',
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
