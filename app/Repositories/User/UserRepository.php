<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserInterface
{
    public function getAll()
    {
        return User::all();
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function delete($id)
    {
        return User::delete($id);
    }

}
