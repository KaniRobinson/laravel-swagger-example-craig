<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @OA\Get(
     *  path="/api/users",
     *  summary="Fetch all users",
     *  description="Returns a list of users",
     *  operationId="index",
     *  tags={"user"},
     *  @OA\Response(response=200, description="successful operation", @OA\JsonContent(ref="#/components/schemas/User")),
     * )
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return UserResource::collection($users);
    }

    /**
     * Store a newly created user in storage.
     *
     * @OA\Post(
     *  path="/api/users",
     *  summary="Create a user",
     *  description="Create a user",
     *  operationId="store",
     *  tags={"user"},
     *  @OA\RequestBody(
     *   description="User to add to database",
     *   required=true,
     *   @OA\MediaType(
     *    mediaType="multipart/form-data",
     *    @OA\Schema(ref="#/components/schemas/User")
     *   )
     *  ),
     *  @OA\Response(response=201, description="successful operation", @OA\JsonContent(ref="#/components/schemas/User")),
     *  @OA\Response(response=422, description="validation error"),
     * )
     *
     * @param  UserStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        return new UserResource($user);
    }

    /**
     * Returns a single user resource.
     *
     * @OA\Get(
     *  path="/api/users/{user}",
     *  summary="Find user by id",
     *  description="Returns a single user",
     *  operationId="show",
     *  tags={"user"},
     *  @OA\Parameter(
     *   description="ID of user to fetch",
     *   in="path",
     *   name="user",
     *   required=true,
     *   @OA\Schema(
     *    type="integer",
     *    format="int64",
     *   )
     *  ),
     *  @OA\Response(response=200, description="successful operation", @OA\JsonContent(ref="#/components/schemas/User")),
     *  @OA\Response(response="404", description="User not found"),
     * )
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }
}
