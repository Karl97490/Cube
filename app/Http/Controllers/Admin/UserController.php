<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;
use function Illuminate\Events\queueable;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete',
            ['only'=>['index','store']]
        );
        $this->middleware(
            'permission:user-create',
            ['only'=>['create', 'store']]
        );
        $this->middleware(
            'permission:user-edit',
            ['only'=>['update', 'edit']]
        );
        $this->middleware(
            'permission:user-delete',
            ['only'=>['delete', 'destroy']]
        );
    }

    public function index()
    {
        if(!auth()){
            return redirect()->route('/dashboard');
        }



        $user = auth()->user();
        $roleName = $user->getRoleNames()[0];
        if($roleName === "astronaut"){
            $users = User::whereId($user->id)->get();


        }
        if($roleName === "manager"){
            $user = User::whereId($user->id)->get();
            $roleAstro = Role::findByName('astronaut');
            $astro = $roleAstro->users;
            $users = $user->merge($astro);


        }
        if($roleName === "admin"){
            $users = User::all();
        }
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('name','name')->all();
        return view('admin.users.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $request->validate(
            [
                'username'=>[
                    'required','string','max:225',
                ],
                'email'=>[
                    'required', 'string', 'email', 'max:225 ', 'email:rfc',
                    Rule::unique('users')->ignore($user),
                ],
                'password'=>(isset($request->password) && !is_null($request->password)? [
                    Password::min(4)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                ]:[null]),
            ]
        );
        $user = User::create ([
            'name'=> $request->input('username'),
            'password'=>$request->input('password'),
            'email'=>$request->input('email'),
            ]);
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')->with('success',
            'User created successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $role = User::pluck('name','name')->all();
        $userRoles = $user->roles->pluck('name','name')->all();
        return view('admin.users.update', compact(['user','userRoles','role']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        $request->validate(
            [
                'username'=>[
                    'required','string','max:225',
                ],
                'email'=>[
                    'required', 'string', 'email', 'max:225 ', 'email:rfc',
                    Rule::unique('users')->ignore($user),
                ],
                'password'=>(isset($request->password) && !is_null($request->password)? [
                    Password::min(4)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                ]:[null]),
            ]
        );
        if($request->input('username') !== $user->name){
            $user->name = $request->input('username');
        }
        if($request->input('email') !== $user->email){
            $user->email = $request->input('email');
        }
        if($request->input('password') !== null){
            if($request->input('password') !== $user->email){
                $user->password = $request->input('password');
            }
        }
        $user->save();
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $authUser = auth()->user();
        $roleName = $authUser->getRoleNames()[0];
        if($roleName === 'manager'){
            if($user->name !== $authUser->name){
                $user->delete();
            }
        }else{
            $user->delete();
        }
        return redirect(route('users.index'));
    }
}
