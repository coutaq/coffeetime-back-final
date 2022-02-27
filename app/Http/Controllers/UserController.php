<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Services\PhoneService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\App\Models\UserCollection
     */
    public function index(Request $request)
    {
        $users = User::all();

        return new UserCollection($users);
    }

    /**
     * @param \App\Http\Requests\App\Models\UserStoreRequest $request
     * @return \App\Http\Resources\App\Models\UserResource
     */
    public function store(PhoneService $ps, UserStoreRequest $request)
    {
        $user = User::firstOrNew($request->validated());
        $user->code = $ps->createAndSendCode($user->phone);
        $user->role_id = Role::where('slug', 'user')->first()->id;
        $user->save();

        return new UserResource($user);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\App\Models\user $user
     * @return \App\Http\Resources\App\Models\UserResource
     */
    public function show(Request $request, User $user)
    {
        return new UserResource($user);
    }

    /**
     * @param \App\Http\Requests\App\Models\UserUpdateRequest $request
     * @param \App\App\Models\user $user
     * @return \App\Http\Resources\App\Models\UserResource
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());

        return new UserResource($user);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\App\Models\user $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $user->delete();

        return response()->noContent();
    }
}
