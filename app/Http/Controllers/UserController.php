<?php

namespace App\Http\Controllers;

use App\Actions\RefreshRolesAction;
use App\Actions\Users\UpdateUserAction;
use App\Http\Requests\Users\UpdateUsersRequest;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index() : View
    {
        $this->authorize('viewAny', new User());
        $users = User::paginate();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user) : View
    {
        $this->authorize('view', new User());
        $roles = $user->getRoleNames();
        return view('users.show',compact(['user', 'roles']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function edit(User $user) : View
    {
        $this->authorize('edit', new User());
        $roles = Role::pluck('name','id');
        return view('users.edit', compact(['user', 'roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUsersRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUsersRequest $request, User $user, UpdateUserAction $updateUserAction) : RedirectResponse
    {
        $updateUserAction->execute($request->validated(), $user);
        return redirect()->route('users.show', compact('user'))->with('message', trans('users.messages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return RedirectResponse
     */
    public function update_roles(User $user, Request $request, RefreshRolesAction $refreshRolesAction)
    {
        $this->authorize('update', new User());
        $roles = Role::all();
        if ($roles->contains($request['rol'])) {
            $refreshRolesAction->execute($user, $request['rol']);
        } else {
            return back()->with('error', 'The role does not exist');
        }
        return redirect()->route('users.show', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
