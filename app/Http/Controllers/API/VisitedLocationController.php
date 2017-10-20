<?php

namespace FEMR\Http\Controllers\API;

use FEMR\Data\Models\VisitedLocation;
use FEMR\Http\Controllers\Controller;

class VisitedLocationController extends Controller
{
    /**
     *
     * @return mixed
     */
    public function index()
    {
        return VisitedLocation::with([

                    'outreachProgram.fields',
                    'outreachProgram.papers',
                    'outreachProgram.schoolClasses',
                    'outreachProgram.partnerOrganizations'
                ])
                ->get();
    }
}
