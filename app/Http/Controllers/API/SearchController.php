<?php

namespace FEMR\Http\Controllers\API;

use FEMR\Data\Models\OutreachProgram;
use FEMR\Data\Models\VisitedLocation;
use FEMR\Http\Controllers\Controller;
use FEMR\Http\Requests\API\SearchCreateRequest;
use FEMR\Http\Resources\OutreachProgramResource;

class SearchController extends Controller
{
    public function create( SearchCreateRequest $request ) {

        if( $request->input( 'search_by' ) === 'location' )
        {
            $program_ids = VisitedLocation::nearbyLocation(
                                $request->input( 'latitude' ),
                                $request->input( 'longitude' )
                            )
                            ->pluck( 'outreach_program_id', 'id' );

            $programs = OutreachProgram::whereIn( 'id', $program_ids )
                            ->withAll()
                            ->has( 'visitedLocations' )
                            ->with([
                                'visitedLocations' => function( $query ) use ( $program_ids )
                                {
                                    $query->whereIn( 'id', $program_ids->keys() );
                                }
                            ])
                            ->paginate( 200 );
        }
        else if( $request->input( 'search_by' ) === 'name' && $request->has( 'name' ) )
        {
            $programs = OutreachProgram::withAll()->byName( $request->input( 'name' ) )->paginate( 200 );
        }
        else
        {
            $programs = OutreachProgram::withAll()->paginate( 200 );
        }

        return OutreachProgramResource::collection( $programs );
    }
}
