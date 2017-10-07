<?php

namespace App\Http\Controllers\API;

use App\Repositories\User\UserRepository;
use App\Services\GuzzleService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use jeremykenedy\LaravelRoles\Models\Role;

class UserAPIController extends BaseController
{
    protected $guzzleService;
    protected $userRepo;

    public function __construct(GuzzleService $guzzleService, UserRepository $userRepo)
    {
        $this->guzzleService = $guzzleService;
        $this->userRepo      = $userRepo;
    }

    public function getUsers()
    {
        $data       = [];
        $statusCode = 200;
        $response   = [
            'success' => true,
            'message' => 'Users List',
        ];
        try {
            $query = "SELECT
                        users.*,
                        roles.name as role_name
                    FROM users
                    LEFT JOIN role_user ON role_user.user_id = users.id
                    LEFT JOIN roles ON role_user.role_id = roles.id";
            $users  = DB::select($query);
            $roles  = Role::all();
            $data['users'] = $users;
            $data['roles'] = $roles;

        } catch (\Exception $e) {
            $statusCode = 500;
        }

        return $this
            ->setStatusCode($statusCode)
            ->setDataBag($data)
            ->respond($response);
    }

    public function getUser($slug)
    {
        $data       = [];
        $statusCode = 200;
        $response   = [
            'success' => true,
            'message' => 'Product Information',
        ];
        try {
//            $data['product'] = $this->productRepo->findSlug($slug);
        } catch (\Exception $e) {
            $statusCode = 500;
        }

        return $this
            ->setStatusCode($statusCode)
            ->setDataBag($data)
            ->respond($response);
    }
}
