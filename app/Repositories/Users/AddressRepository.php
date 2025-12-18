<?php

namespace App\Repositories\Users;

use App\Interfaces\Users\AddressInterface;
use App\Models\UserAddress;
use App\Repositories\BaseRepository;

class AddressRepository extends BaseRepository implements AddressInterface
{
    public function __construct()
    {
        parent::__construct(new UserAddress());
    }


}
