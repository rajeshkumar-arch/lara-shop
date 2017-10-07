<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Services\GuzzleService;
use App\Traits\CaptureIpTrait;
use Auth;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;
use Validator;

class UsersManagementController extends Controller
{
    protected $guzzleService;

    public function __construct(GuzzleService $guzzleService)
    {
        $this->guzzleService = $guzzleService;
        $this->guzzleService->setHost(url('/'));
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url    = route('users.list');
        $result = $this->guzzleService->getGuzzleRequest($url);
        if ($result['status']['http_code'] == 200) {
            return view('usersmanagement.show-users')->with($result['data']);
        }

        return View('usersmanagement.show-users', []);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        $data = [
            'roles' => $roles,
        ];

        return view('usersmanagement.create-user')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255|unique:users',
                'first_name' => '',
                'last_name' => '',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|max:20|confirmed',
                'password_confirmation' => 'required|same:password',
                'role' => 'required',
            ],
            [
                'name.unique' => trans('auth.userNameTaken'),
                'name.required' => trans('auth.userNameRequired'),
                'first_name.required' => trans('auth.fNameRequired'),
                'last_name.required' => trans('auth.lNameRequired'),
                'email.required' => trans('auth.emailRequired'),
                'email.email' => trans('auth.emailInvalid'),
                'password.required' => trans('auth.passwordRequired'),
                'password.min' => trans('auth.PasswordMin'),
                'password.max' => trans('auth.PasswordMax'),
                'role.required' => trans('auth.roleRequired'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $data   = [
            'name' => $request->input('name'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'password' => $request->input('password'),
        ];
        $result = $this->guzzleService->postGuzzleRequest(route('user.create'), $data);
        if ($result['status']['http_code'] == 200) {
            return redirect('users')->with('success', trans('usersmanagement.createSuccess'));
        }

        return redirect('users')->with('error', 'User creation failed');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url    = route('user.info', $id);
        $result = $this->guzzleService->getGuzzleRequest($url);
        if ($result['status']['http_code'] == 200) {
            return view('usersmanagement.show-user')->with($result['data']);
        }

        return view('usersmanagement.show-user')->with([]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $url    = route('user.info', $id);
        $result = $this->guzzleService->getGuzzleRequest($url);
        if ($result['status']['http_code'] == 200) {
            $data = [
                'user' => $result['data']['user'],
                'roles' => $result['data']['roles'],
                'currentRole' => $result['data']['user']['role_id'],
            ];

            return view('usersmanagement.edit-user')->with($data);
        }

        return view('usersmanagement.edit-user')->with([]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'password' => 'nullable|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $data               = [];
        $data['name']       = $request->input('name');
        $data['first_name'] = $request->input('first_name');
        $data['last_name']  = $request->input('last_name');
        $data['email']      = $request->input('email');
        $data['role']       = $request->input('role');
        if ($request->input('password') != null) {
            $data['password'] = $request->input('password');
        }
        $result = $this->guzzleService->putGuzzleRequest(route('user.update', $id), $data);
        if ($result['status']['http_code'] == 200) {
            return back()->with('success', trans('usersmanagement.updateSuccess'));
        }

        return back()->with('success', 'Failed to Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currentUser   = Auth::user();
        $getUserUrl    = route('user.info', $id);
        $deleteUserUrl = route('user.delete', $id);

        $result = $this->guzzleService->getGuzzleRequest($getUserUrl);
        if ($result['status']['http_code'] == 200 && $currentUser->id != $result['data']['user']['id']) {
            $delResult = $this->guzzleService->deleteGuzzleRequest($deleteUserUrl);
            if ($delResult['status']['http_code'] == 200) {
                return redirect('users')->with('success', trans('usersmanagement.deleteSuccess'));
            }
        }

        return back()->with('error', trans('usersmanagement.deleteSelfError'));
    }
}
