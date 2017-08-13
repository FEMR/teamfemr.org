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
                'start_date'                  => 'sometimes',
                'end_date'                    => 'sometimes',
                'address'                     => 'sometimes|string',
                'address_ext'                 => 'sometimes|string',
                'locality'                    => 'required|string',
                'administrative_area_level_1' => 'sometimes|string',
                'administrative_area_level_2' => 'sometimes|string',
                'postal_code'                 => 'sometimes|string',
                'country'                     => 'required|string',
                'latitude'                    => 'sometimes|numeric',
                'longitude'                   => 'sometimes|numeric',
                'notes'                       => 'sometimes|string'
            ];
        }

        /**
         * @return array|mixed
         */
        public function all()
        {
            $data = parent::all();

            // make sure empty dates from the html5 date field are set to null
            if( $data['start_date'] == '-0001-11-30' ) $data['start_date'] = null;
            if( $data['end_date'] == '-0001-11-30' ) $data['end_date'] = null;

            return $data;
        }
    }
