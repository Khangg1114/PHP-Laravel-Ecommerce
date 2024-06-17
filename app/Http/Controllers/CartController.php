<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;


class CartController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cartItems','totalPrice'));
    }

    public function addToCart(Request $request)
    {
        $taskId = $request->input('task_id');
        $task = Task::find($taskId);

        if (!$task) {
            return back()->with('error', 'Công việc không tồn tại.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$taskId])) {
            $cart[$taskId]['quantity']++;
        } else {
            $cart[$taskId] = [
                'name' => $task->name,
                'price' => $task->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Công việc đã được thêm vào giỏ hàng.');
    }

    public function checkout()
    {
        $cartItems = session()->get('cart', []);

        $total = array_sum(array_column($cartItems, 'price'));

        // Xử lý đặt hàng và xóa giỏ hàng sau khi đặt hàng thành công
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Đặt hàng thành công. Tổng tiền: $' . $total);
    }
    public function decreaseItem($taskId)
    {
        $cart = session()->get('cart');

        if (isset($cart[$taskId])) {
            if ($cart[$taskId]['quantity'] > 1) {
                $cart[$taskId]['quantity']--;
                session()->put('cart', $cart);
            }
        }

        return redirect()->back()->with('success', 'Đã giảm số lượng thành công.');
    }
    public function increaseItem($taskId)
    {
        $cart = session()->get('cart');

        if (isset($cart[$taskId])) {
            $cart[$taskId]['quantity']++;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Đã tăng số lượng thành công.');
    }
    public function removeItem($taskId)
    {
        $cart = session()->get('cart');

        if (isset($cart[$taskId])) {
            unset($cart[$taskId]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Đã xóa mục khỏi giỏ hàng.');
    }
    public function getTotal()
    {
        $cartItems = session()->get('cart', []);
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        return response()->json(['totalPrice' => $totalPrice]);
    }

}
