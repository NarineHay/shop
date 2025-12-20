<?php

namespace App\Http\Controllers\Web;

use App\Helpers\RegionsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // $products = $this->service->getMoreRows('id', $request->ids, ['category.translations', 'images', 'attributeValues.attribute']);

        // $attributes = AttributesHelper::getAll();
        $regions = RegionsHelper::getAll();

        return Inertia::render(
            'Checkout',
            [
                'regions' => $regions

                // 'products' => $products,
                // 'attributes' => $attributes
            ]
        );
    }

    public function store(CheckoutRequest $request)
    {
        $data = $request->validated();

        // Если выбрано "адрес акаунта"
        if ($request->boolean('use_account_address')) {

            $user = auth()->user();

            // Проверяем, заполнен ли адрес у пользователя
            if (!$user || !$user->address || !$user->region_id || !$user->phone) {
                return back()->withErrors([
                    'address' => __('messages.address_incomplete'),
                ]);
            }

            // подставляем из профиля
            $data['name']      = $user->name;
            $data['email']     = $user->email;
            $data['phone']     = $user->phone;
            $data['address']   = $user->address;
            $data['region_id'] = $user->region_id;
        }

        // TODO: создание заказа
    }
}
