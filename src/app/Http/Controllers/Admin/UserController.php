<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository\all();
        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = $this->userRepository\findById($id);
        return view('admin.users.show', compact('user'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->userRepository\save(new User($data));
        return redirect()->route('admin.users.index');
    }

    public function edit($id)
    {
        $user = $this->userRepository\findById($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = $this->userRepository\findById($id);
        $user->update($request->all());
        $this->userRepository\save($user);
        return redirect()->route('admin.users.index');
    }

    public function destroy($id)
    {
        $user = $this->userRepository\findById($id);
        $this->userRepository\delete($user);
        return redirect()->route('admin.users.index');
    }
}
