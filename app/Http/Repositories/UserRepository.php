<?php

namespace App\Http\Repositories;

use App\Models\User;

class UserRepository
{
    public function delete($id){
        $user = User::find($id);
        $user->delete();
    }
}
