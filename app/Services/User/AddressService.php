<?php

namespace App\Services\User;

use App\Interfaces\Users\AddressInterface;
use App\Interfaces\Users\UserInterface;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

class AddressService extends BaseService
{
    public function __construct(AddressInterface $repository)
    {
         parent::__construct($repository);
    }

    public function updateAddress(array $data)
    {
        $user = Auth::user();

        if ($user->address) {
            $user->address->update($data);
        } else {
            $user->address()->create($data);
        }

        return $user->load('address');
    }

}
