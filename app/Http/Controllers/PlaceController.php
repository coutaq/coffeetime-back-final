<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceStoreRequest;
use App\Http\Requests\PlaceUpdateRequest;
use App\Http\Resources\PlaceCollection;
use App\Http\Resources\PlaceResource;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\PlaceCollection
     */
    public function index(Request $request)
    {
        $places = Place::all();

        return new PlaceCollection($places);
    }

    /**
     * @param \App\Http\Requests\PlaceStoreRequest $request
     * @return \App\Http\Resources\PlaceResource
     */
    public function store(PlaceStoreRequest $request)
    {
        $place = Place::create($request->validated());

        return new PlaceResource($place);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Place $place
     * @return \App\Http\Resources\PlaceResource
     */
    public function show(Request $request, Place $place)
    {
        return new PlaceResource($place);
    }

    /**
     * @param \App\Http\Requests\PlaceUpdateRequest $request
     * @param \App\Models\Place $place
     * @return \App\Http\Resources\PlaceResource
     */
    public function update(PlaceUpdateRequest $request, Place $place)
    {
        $place->update($request->validated());

        return new PlaceResource($place);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Place $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Place $place)
    {
        $place->delete();

        return response()->noContent();
    }
}
