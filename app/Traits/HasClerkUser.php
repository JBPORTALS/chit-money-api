<?php

namespace App\Traits;

use Clerk\Backend\Models\Components\User;
use Illuminate\Http\Request;

trait HasClerkUser
{
    public function getUser(Request $request): User
    {
        return $request->attributes->get('user');
    }
}
