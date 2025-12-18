<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AddressRequest;
use App\Services\User\AddressService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AddressController extends Controller
{
    public function __construct(
            protected AddressService $service,
        )
    {
    }
    public function __invoke(AddressRequest $request): RedirectResponse
    {

        $this->service->updateAddress($request->all());

        return Redirect::route('dashboard', app()->getLocale());

    }
}
