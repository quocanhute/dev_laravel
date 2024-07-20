<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return AnonymousResourceCollection
   */
  public function index(): AnonymousResourceCollection
  {
    return UserResource::collection(User::query()->orderBy('id', 'desc')->paginate(10));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param StoreUserRequest $request
   * @return Response
   */
  public function store(StoreUserRequest $request): Response
  {
    $data = $request->validated();
    $data['password'] = bcrypt($data['password']);
    $user = User::create($data);

    return response(new UserResource($user) , 201);
  }

  /**
   * Display the specified resource.
   *
   * @param User $user
   * @return UserResource
   */
  public function show(User $user): UserResource
  {
    return new UserResource($user);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param UpdateUserRequest $request
   * @param User $user
   * @return UserResource
   */
  public function update(UpdateUserRequest $request, User $user): UserResource
  {
    $data = $request->validated();
    if (isset($data['password'])) {
      $data['password'] = bcrypt($data['password']);
    }
    $user->update($data);

    return new UserResource($user);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param User $user
   * @return Response
   */
  public function destroy(User $user): Response
  {
    $user->delete();

    return response("", 204);
  }
}
