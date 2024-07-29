<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withTrashed()->with('roles')->orderBy('last_name');

        if (!is_null(request()->input('user_id'))) {
            $users->where('users.id', request()->input('user_id'));
        }
        if (!is_null(request()->input('role_id'))) {
            $users->whereHas("roles", function ($q) {
                $q->where("role_id", request()->input('role_id'));
            });
        }

        $users = $users->paginate(50)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $user = User::createWithRelations($request->all());
        return redirect()->route('admin.users.show', $user->id)
            ->with('status', 'success')
            ->with('msg', __('User created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $userHasRoles = array_column($user->roles->toArray(), 'id');
        return view('admin.users.show', compact('user', 'userHasRoles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $userHasRoles = array_column($user->roles->toArray(), 'id');
        return view('admin.users.edit', compact('user', 'userHasRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $request->merge(['roles' => $request->roles ?? []]);
        $user->updateWithRelations($request->all(), $user);
        return redirect()->route('admin.users.show', $user->id)
            ->with('status', 'success')
            ->with('msg', __('User updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('status', 'success')
            ->with('msg', __('User deleted successfully.'));
    }
}
