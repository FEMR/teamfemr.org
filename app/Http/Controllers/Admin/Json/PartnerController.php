<?php

    namespace FEMR\Http\Controllers\Admin\Json;

    use FEMR\Data\Models\OutreachProgram;
    use FEMR\Data\Models\PartnerOrganization;
    use FEMR\Http\Controllers\Controller;
    use FEMR\Http\Requests\Admin\Json\PartnerRequest;

    class PartnerController extends Controller
    {

        /**
         * @param $program_id
         * @return mixed
         */
        public function index( $program_id )
        {
            return PartnerOrganization::whereHas( 'outreachPrograms', function( $query ) use( $program_id )
                    {
                        $query->where( 'id', '=', $program_id );
                    })
                    ->get();
        }

        /**
         * @param $program_id
         * @param PartnerRequest $request
         * @return mixed
         */
        public function store( $program_id, PartnerRequest $request )
        {
            $program = OutreachProgram::findOrFail( $program_id );
            return $program->partnerOrganizations()->create( $request->all() );
        }

        /**
         * @param $program_id
         * @param $partner_id
         * @param PartnerRequest $request
         * @return mixed
         */
        public function update( $program_id, $partner_id, PartnerRequest $request )
        {
            $partner = PartnerOrganization::whereHas( 'outreachPrograms', function( $query ) use( $program_id )
                        {
                            $query->where( 'id', '=', $program_id );
                        })
                        ->findOrFail( $partner_id );
            return [

                'status' => $partner->update( $request->all() )
            ];
        }

        /**
         * @param $program_id
         * @param $partner_id
         * @return mixed
         */
        public function destroy( $program_id, $partner_id )
        {
            return [

                'status' => PartnerOrganization::whereHas( 'outreachPrograms', function( $query ) use( $program_id )
                            {
                                $query->where( 'id', '=', $program_id );
                            })
                            ->findOrFail( $partner_id )->delete()
            ];
        }

        /**
         * @param $program_id
         * @param $partner_id
         * @return mixed
         */
        public function restore( $program_id, $partner_id )
        {
            $partner = PartnerOrganization::whereHas( 'outreachPrograms', function( $query ) use( $program_id )
                        {
                            $query->where( 'id', '=', $program_id );
                        })
                        ->withTrashed()
                        ->findOrFail( $partner_id );

            return $partner->restore();
        }
    }