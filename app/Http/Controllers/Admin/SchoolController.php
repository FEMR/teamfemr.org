<?php

namespace FEMR\Http\Controllers\Admin;

use FEMR\Data\Models\School;
use FEMR\Http\Controllers\Controller;
use FEMR\Http\Requests\Admin\SchoolRequest;

class SchoolController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $schools = School::all();

        return view( 'admin.schools.index', [ 'schools' => $schools ] );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function archived()
    {
        $schools = School::onlyTrashed()->get();

        return view( 'admin.schools.archived', [ 'schools' => $schools ] );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view( 'admin.schools.create' );
    }

    /**
     * @param SchoolRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( SchoolRequest $request )
    {
        School::create( $request->all() );

        return redirect()->route( 'admin.schools.index' );
    }

    /**
     * @param School $school
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit( School $school )
    {
        return view( 'admin.schools.edit', [ 'school' => $school ] );
    }

    /**
     * @param School $school
     * @param SchoolRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( School $school, SchoolRequest $request )
    {
        $school->update( $request->all() );

        return redirect()->route( 'admin.schools.index' );
    }

    /**
     * @param School $school
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy( School $school )
    {
        $school->delete();

        return redirect()->route( 'admin.schools.index' );
    }

    /**
     * @param $school_id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function restore( $school_id )
    {
        $school = School::withTrashed()->findOrFail( $school_id );
        $school->restore();

        return redirect()->route( 'admin.schools.index' );
    }
}
