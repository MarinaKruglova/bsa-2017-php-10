<?php

namespace App\Manager;

use App\Request\Contract\SaveUserRequest;
use App\Entity\User;
use Illuminate\Support\Collection;
use App\Manager\Contract\UserManager as UserManagerContract;

class UserManager implements UserManagerContract
{

    public function findAll(): Collection
    {
        return User::all();
    }

    public function findById(int $id)
    {
        return User::find($id);
    }

    public function findActive(): Collection
    {
        return User::where('is_active', true)->get();
    }

    public function saveUser(SaveUserRequest $request): User
    {
        $user = $request->getUser();
        $user->first_name = $request->getFirstName();
        $user->last_name = $request->getLastName();
        $user->is_active = $request->getIsActive();
        $user->save();

        return $user;
    }

    public function deleteUser(int $userId)
    {
        $user = $this->findById($userId);
        if ($user !== null) {
            $user->delete();
        } else {
            return;
        }
    }
}
