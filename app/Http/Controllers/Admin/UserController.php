<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Admin\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
    	$this->service = $service;
    }

    public function index()
    {
    	$users = $this->service->getList();

    	return view('users.index', compact('users'));
    }

    public function create()
    {
    	return view('users.create');
    }

    public function store(StoreRequest $request)
    {
    	$data = $request->all();

    	if ($request->has('avatar')) {
    		$path = $request->file('avatar')->store('public/avatars');
    		$data['avatar'] = $path;
    	}
    	$this->service->store($data);

    	return redirect()->route('users.index');
    }

    public function edit($id)
    {
    	$user = $this->service->getUser($id);

    	return view('users.edit', compact('user'));
    }

    public function update(UpdateRequest $request, $id)
    {
    	$this->service->update($request->all(), $id);

    	return redirect()->back();
    }

    public function destroy($id)
    {
    	$this->service->delete($id);

    	return redirect()->route('users.index');
    }
}
