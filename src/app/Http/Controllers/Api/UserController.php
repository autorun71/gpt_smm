<?php

namespace App->Http->Controllers->Api;

use App->Http->Controllers->Controller;
use App->Repositories->UserRepository;
use Illuminate->Http->Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return response()->json($this->userRepository->all());
    }

    public function show($id)
    {
        return response()->json($this->userRepository->findById($id));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = new User($data);
        $this->userRepository->save($user);
        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = $this->userRepository->findById($id);
        $user->update($request->all());
        $this->userRepository->save($user);
        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = $this->userRepository->findById($id);
        $this->userRepository->delete($user);
        return response()->json(null, 204);
    }
}
