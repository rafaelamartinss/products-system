<?php

namespace App\Policies;

use App\User;
use App\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;


    public function show(User $user)
    {
        return $user->is_admin === 1;
    }

    public function create(User $user)
    {
        return $user->is_admin === 1;
    }

    public function store(User $user)
    {
        return $user->is_admin === 1;
    }

    public function update(User $user)
    {
        return $user->is_admin === 1;
    }

    public function edit(User $user)
    {
        return $user->is_admin === 1;
    }

    public function delete(User $user)
    {
        return $user->is_admin === 1;
    }
}
