<?php

namespace App\Repositories\Users;

use App\Interfaces\Users\UserInterface;
use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserInterface
{
    public function __construct()
    {
        parent::__construct(new User());
    }


}
