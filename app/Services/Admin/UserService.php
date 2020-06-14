<?php

namespace App\Services\Admin;

use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Service class for authentication handling
 */
class UserService extends BaseService
{
    public function getList()
    {
        return User::all();
    }

    public function store(array $inputs)
    {
    	try {
    		User::create(array_merge($inputs, [
    			'password' => Hash::make('password'),
    		]));
    	} catch (Exception $e) {
    		report($e);
    	}
    }

    public function getUser($id)
    {
    	return User::findOrFail($id);
    }

    public function update(array $inputs, $id)
    {
    	$user = User::findOrFail($id);
    	$user->update($inputs);
    }

    public function delete($id)
    {
    	$user = User::findOrFail($id);
    	$user->delete();
    }
}
