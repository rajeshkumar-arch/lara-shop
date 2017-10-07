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
            $users         = $this->userRepo->getAll();
            $data['users'] = $users;

        } catch (\Exception $e) {
            $statusCode = 500;
        }

        return $this
            ->setStatusCode($statusCode)
            ->setDataBag($data)
            ->respond($response);
    }

    public function getUser($id)
    {
        $data       = [];
        $statusCode = 200;
        $response   = [
            'success' => true,
            'message' => 'User Information',
        ];
        try {
            $users         = $this->userRepo->find($id);
            $data['user']  = $users[0];
            $data['roles'] = $this->userRepo->userRoles();
        } catch (\Exception $e) {
            $statusCode = 500;
        }

        return $this
            ->setStatusCode($statusCode)
            ->setDataBag($data)
            ->respond($response);
    }

    public function deleteUser($id)
    {
        $data       = [];
        $statusCode = 200;
        $response   = [
            'success' => true,
            'message' => 'User Deleted',
        ];
        try {
            DB::beginTransaction();
            $this->userRepo->delete($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $statusCode = 500;
            $response   = [
                'success' => false,
                'message' => 'User Deletion Failed',
            ];
        }

        return $this
            ->setStatusCode($statusCode)
            ->setDataBag($data)
            ->respond($response);
    }

    public function updateUser(Request $request, $id)
    {
        $data       = [];
        $statusCode = 200;
        $response   = [
            'success' => true,
            'message' => 'User Updated',
        ];
        try {
            DB::beginTransaction();
            $this->userRepo->updateUserData($id, $request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $statusCode = 500;
            $response   = [
                'success' => false,
                'message' => 'User Updation Failed',
            ];
        }

        return $this
            ->setStatusCode($statusCode)
            ->setDataBag($data)
            ->respond($response);
    }

    public function createUser(Request $request)
    {
        $data       = [];
        $statusCode = 200;
        $response   = [
            'success' => true,
            'message' => 'User Created',
        ];
        try {
            DB::beginTransaction();
            $this->userRepo->createUser($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $statusCode = 500;
            $response   = [
                'success' => false,
                'message' => 'User Creation Failed',
            ];
        }

        return $this
            ->setStatusCode($statusCode)
            ->setDataBag($data)
            ->respond($response);
    }
}
