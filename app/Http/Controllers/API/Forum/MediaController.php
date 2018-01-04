<?php

namespace FEMR\Http\Controllers\API\Forum;

use FEMR\Data\Models\ChatterMedia;
use FEMR\Http\Controllers\Controller;
use FEMR\Http\Requests\API\MediaCreateRequest;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * @param MediaCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create( MediaCreateRequest $request )
    {
        $path = $request->file( 'media' )->store( 'forum/uploads' );

        if( $path )
        {
            $media = ChatterMedia::create([

                        'user_id' => auth()->guard( 'api' )->user()->id,
                        'file'    => $path,
                        'alt'     => $request->input( 'alt' )
                  ]);

            return response()->json([
                    'success' => true,
                    'url' => Storage::url( $media->file )
                ]);
        }
        else
        {
            return response()->json([ 'success' => false ]);
        }

    }
}
