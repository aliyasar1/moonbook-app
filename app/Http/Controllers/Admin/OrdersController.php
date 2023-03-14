<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\OrderStatuses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    public function getOrders(OrderStatuses $status)
    {
        $orders = Orders::query()
            ->whereHas('siparis_detaylari', function ($q) use ($status) {
                $q->where('status_id', $status->id)
                    ->whereHas('kitap', function ($q2) {
                        $q2->where('satici_id', Auth::user()->id);
                    });
            })
            ->with(['siparis_detaylari', 'sepet'])
            ->get();

        return view('admin.books.orders', compact('orders', 'status'));

    }

    public function getOrderDetail(OrderStatuses $status, Orders $order)
    {
        $orderDetail = OrderDetails::query()
            ->with(['siparisler.sepet', 'siparisler.sepet.kullanicilar', 'kitap'])
            ->where('siparis_id', $order->id)
            ->where('status_id', $status->id)
            ->whereHas('kitap', function ($q) {
                $q->where('satici_id', Auth::user()->id);
            })->get();

        $orderStatuses = OrderStatuses::all();

        return view('admin.books.orderDetail', compact('order', 'orderDetail', 'orderStatuses'));
    }

    public function putOrderStatus(OrderDetails $orderDetails)
    {

        $validator = Validator::make(
            request()->all(),
            [
                'status_id' => 'required',
            ],
            [
                'status_id.required' => 'Sipariş durumu boş geçilemez.',
            ]
        );

        $inputs = $validator->validate();

        $orderDetails->update([
            'status_id' => $inputs['status_id']
        ]);

        return redirect()->route('seller.orders', $inputs['status_id']);
    }
}
