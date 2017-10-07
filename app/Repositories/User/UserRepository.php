<?php

namespace App\Repositories\User;

use App\Models\Profile;
use App\Models\User;
use App\Traits\CaptureIpTrait;
use Illuminate\Support\Facades\DB;
use jeremykenedy\LaravelRoles\Models\Role;
use Illuminate\Http\Request;

class UserRepository implements UserInterface
{
    public function getAll()
    {
        $query = "SELECT
                        users.*,
                        roles.name as role_name,
                        roles.id as role_id
                    FROM users
                    LEFT JOIN role_user ON role_user.user_id = users.id
                    LEFT JOIN roles ON role_user.role_id = roles.id
                    where users.deleted_at is NULL";

        return DB::select($query);
    }

    public function find($id)
    {
        $query = "SELECT
                        users.*,
                        roles.name as role_name,
                        roles.id as role_id
                    FROM users
                    LEFT JOIN role_user ON role_user.user_id = users.id
                    LEFT JOIN roles ON role_user.role_id = roles.id
                    where users.id={$id} limit 1";

        return DB::select($query);
    }

    public function delete($id)
    {
        $user                     = User::find($id);
        $ipAddress                = new CaptureIpTrait();
        $user->deleted_ip_address = $ipAddress->getClientIp();
        $user->save();
        $user->delete();
    }

    public function userRoles()
    {
        return Role::all();
    }

    public function updateUserData($id, Request $request)
    {
        $user      = User::find($id);
        $ipAddress = new CaptureIpTrait();

        $user->name       = $request->input('name');
        $user->first_name = $request->input('first_name');
        $user->last_name  = $request->input('last_name');
        $user->email      = $request->input('email');
        if ($request->input('password') != null) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->detachAllRoles();
        $user->attachRole($request->input('role'));
        $user->updated_ip_address = $ipAddress->getClientIp();
        $user->save();
    }

    public function createUser(Request $request)
    {
        $ipAddress = new CaptureIpTrait();
        $profile   = new Profile();

        $user = User::create([
            'name' => $request->input('name'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'token' => str_random(64),
            'admin_ip_address' => $ipAddress->getClientIp(),
            'activated' => 1,
        ]);
        $user->profile()->save($profile);
        $user->attachRole($request->input('role'));
        $user->save();
    }
}
