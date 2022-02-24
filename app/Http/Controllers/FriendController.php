<?php

namespace App\Http\Controllers;

use App\Http\Requests\FriendStoreRequest;
use App\Http\Requests\FriendUpdateRequest;
use App\Http\Resources\FriendCollection;
use App\Http\Resources\FriendResource;
use App\Models\Friend;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\FriendCollection
     */
    public function index(Request $request)
    {
        $friends = Friend::all();

        return new FriendCollection($friends);
    }

    /**
     * @param \App\Http\Requests\FriendStoreRequest $request
     * @return \App\Http\Resources\FriendResource
     */
    public function store(FriendStoreRequest $request)
    {
        $friend = Friend::create($request->validated());

        return new FriendResource($friend);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Friend $friend
     * @return \App\Http\Resources\FriendResource
     */
    public function show(Request $request, Friend $friend)
    {
        return new FriendResource($friend);
    }

    /**
     * @param \App\Http\Requests\FriendUpdateRequest $request
     * @param \App\Models\Friend $friend
     * @return \App\Http\Resources\FriendResource
     */
    public function update(FriendUpdateRequest $request, Friend $friend)
    {
        $friend->update($request->validated());

        return new FriendResource($friend);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Friend $friend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Friend $friend)
    {
        $friend->delete();

        return response()->noContent();
    }
}
