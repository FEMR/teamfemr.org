<?php

    namespace FEMR\Http\Controllers\Admin\Json;

    use FEMR\Data\Models\OutreachProgram;
    use FEMR\Data\Models\VisitedLocation;
    use FEMR\Http\Controllers\Controller;
    use FEMR\Http\Requests\Admin\Json\LocationRequest;

    class LocationController extends Controller
    {

        /**
         * @param $program_id
         * @return mixed
         */
        public function index( $program_id )
        {
            return VisitedLocation::where( 'outreach_program_id', '=', $program_id )->get();
        }

        /**
         * @param $program_id
         * @param LocationRequest $request
         * @return mixed
         */
        public function store( $program_id, LocationRequest $request )
        {
            $program = OutreachProgram::findOrFail( $program_id );
            return $program->locations()->create( $request->all() );
        }

        /**
         * @param $program_id
         * @param $location_id
         * @param LocationRequest $request
         * @return mixed
         */
        public function update( $program_id, $location_id, LocationRequest $request )
        {
            $location = VisitedLocation::where( 'outreach_program_id', '=', $program_id )->findOrFail( $location_id );
            return [

                'status' => $location->update( $request->all() )
            ];
        }

        /**
         * @param $program_id
         * @param $location_id
         * @return mixed
         */
        public function destroy( $program_id, $location_id )
        {
            return [

                'status' => VisitedLocation::where( 'outreach_program_id', '=', $program_id )->findOrFail( $location_id )->delete()
            ];
        }

        /**
         * @param $program_id
         * @param $location_id
         * @return mixed
         */
        public function restore( $program_id, $location_id )
        {
            $location = VisitedLocation::where( 'outreach_program_id', '=', $program_id )
                        ->withTrashed()
                        ->findOrFail( $location_id );

            return $location->restore();
        }
    }