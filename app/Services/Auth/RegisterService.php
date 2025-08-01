<?php

namespace App\Services\Auth;

use App\Interfaces\Users\UserInterface;
use App\Mail\VerifyEmail;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

use Mail;
class RegisterService extends BaseService
{
    public function __construct(UserInterface $repository)
    {
        parent::__construct($repository);
    }

    public function store($dto): mixed
    {

        $user = parent::store($dto->toArray());

        $user->assignRole('user');

        Mail::to($user->email)->send(new VerifyEmail($user));

        Auth::login($user);

        return $user;
    }


}
