<?php

namespace FEMR\Http\Controllers\Json;

use FEMR\Http\Controllers\Controller;
use FEMR\Data\Models\City;

class CityController extends Controller
{

    /**
     * @return mixed
     */
    public function random()
    {
        return City::orderByRaw( 'RAND()' )->take( 100 )->get();
    }
}
