<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @OA\Schema(
 *  title="User Model",
 *  description="User model",
 *  required={"name", "email", "password"},
 *  @OA\Xml(name="User"),
 *  @OA\Property(property="id", title="ID", description="ID", format="int64"),
 *  @OA\Property(property="name", title="Full Name", description="Full Name", format="string", example="John doe"),
 *  @OA\Property(property="email", title="Email Address", description="Email Address", format="string", example="john@doe.com"),
 *  @OA\Property(property="password", title="Password", description="Password", format="string", example="Password123!"),
 *  @OA\Property(property="created_at", title="created_at", description="created_at", format="string"),
 *  @OA\Property(property="updated_at", title="updated_at", description="updated_at", format="string")
 * )
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
