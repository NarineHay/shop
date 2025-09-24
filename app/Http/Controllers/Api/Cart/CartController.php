<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Services\Products\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // public function __construct(protected CartService $service)
    // {
    // }
      // Получаем активную корзину пользователя
    private function getActiveCart()
    {
        return Cart::firstOrCreate(
            ['user_id' => Auth::id(), 'status' => 'active'],
            ['status' => 'active']
        );
    }

    // Получить корзину
    public function index()
    {
        $cart = $this->getActiveCart()->load('items.product');

        return response()->json([
            'items' => $cart->items->map(fn($i) => [
                'id' => $i->product_id,
                'qty' => $i->quantity,
                'price' => $i->price,
                'discount' => $i->discount,
                'attributes' => $i->attributes,
                'product' => $i->product,
            ]),
            'total' => $cart->items->sum(fn($i) => $i->quantity * $i->price),
        ]);
    }

    // Заменить корзину полностью
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|integer|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        $cart = $this->getActiveCart();
        $cart->items()->delete();

        foreach ($request->items as $item) {
            $cart->items()->create([
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price'] ?? 0,
                'discount' => $item['discount'] ?? null,
                'attributes' => $item['attributes'] ?? null,
            ]);
        }

        $cart->load('items.product');

        return response()->json([
            'items' => $cart->items,
            'total' => $cart->items->sum(fn($i) => $i->quantity * $i->price),
        ]);
    }

    // Слить локальную корзину с корзиной пользователя
    public function merge(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|integer|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        $cart = $this->getActiveCart();

        foreach ($request->items as $item) {

            // $cartItem = $cart->items()
            //     ->where('product_id', $item['id'])
            //     ->where('attributes', json_encode($item['params'] ?? null))
            //     ->first();

            $cartItem = $cart->items->first(function($cartItem) use ($item) {
                return $cartItem->product_id == $item['id'] &&
                    json_encode($cartItem->attributes ?? []) === json_encode($item['params'] ?? []);
            });

            if ($cartItem) {
                // Берём максимум между количеством из localStorage и текущим количеством в БД
                $cartItem->quantity = max($cartItem->quantity, $item['qty']);
                $cartItem->save();
            } else {
                // Создаём новый элемент
                $cart->items()->create([
                    'product_id' => $item['id'],
                    'quantity' => $item['qty'],
                    'price' => $item['price'] ?? 0,
                    'discount' => $item['discount'] ?? null,
                    'attributes' => $item['params'] ?? null,
                ]);
            }
        }

        // $cart->load('items.product');

        // return response()->json([
        //     'items' => $cart->items,
        //     'total' => $cart->items->sum(fn($i) => $i->quantity * $i->price),
        // ]);
         return response()->json(['message' => 'Cart merged']);
    }

    // Увеличить количество товара
    public function increase(Request $request, $itemId)
    {
        $cart = $this->getActiveCart();
        $item = $cart->items()->findOrFail($itemId);

        $item->quantity++;
        $item->save();

        $cart->load('items.product');

        return response()->json([
            'items' => $cart->items,
            'total' => $cart->items->sum(fn($i) => $i->quantity * $i->price),
        ]);
    }

    // Уменьшить количество товара (не ниже 1)
    public function decrease(Request $request, $itemId)
    {
        $cart = $this->getActiveCart();
        $item = $cart->items()->findOrFail($itemId);

        $item->quantity = max(1, $item->quantity - 1);
        $item->save();

        $cart->load('items.product');

        return response()->json([
            'items' => $cart->items,
            'total' => $cart->items->sum(fn($i) => $i->quantity * $i->price),
        ]);
    }

    // Удалить товар
    public function remove(Request $request, $itemId)
    {
        $cart = $this->getActiveCart();
        $item = $cart->items()->findOrFail($itemId);

        $item->delete();

        $cart->load('items.product');

        return response()->json([
            'items' => $cart->items,
            'total' => $cart->items->sum(fn($i) => $i->quantity * $i->price),
        ]);
    }

    // Очистить корзину
    public function clear()
    {
        $cart = $this->getActiveCart();
        $cart->items()->delete();

        return response()->json([
            'items' => [],
            'total' => 0,
        ]);
    }
}
