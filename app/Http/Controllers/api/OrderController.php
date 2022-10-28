<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_order = Order::with(['order_detail' => function ($query) {
            $query->with(['product' => function ($query) {
                $query->with('media');
            }]);
        }])->paginate(10);
        $response = [
            'list_order' => $list_order,
            'success' => true,
            'message' => "success",
        ];

        return response($response, 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $list_items =  json_decode($request['list_item']);
        $new_order = new Order;
        $new_order->user_id = $request['user_id'];
        $new_order->discount_code_id = $request['discount_code_id'];
        $new_order->address_order_id = $request['address_order_id'];
        $new_order->payment_method = $request['payment_method'];
        $new_order->total_payment = $request['total_payment'];
        $new_order->total_payment_sale = $request['total_payment_sale'];
        $new_order->description = $request['description'];
        $new_order->status = $request['status'];
        $new_order->save();
        if ($new_order) {
            //order_meta
            foreach ($list_items as $key => $value) {
                $new_OrderDetail = new OrderDetail();
                $new_OrderDetail -> order_id = $new_order->id;
                $new_OrderDetail -> product_id = $value->product_id;
                $new_OrderDetail -> quantity = $value->quantity;
                $new_OrderDetail -> price = $value->price;
                $new_OrderDetail ->save();
            }
            $order = $new_order->with(['order_detail' => function ($query) {
                $query->with(['product' => function ($query) {
                    $query->with('media');
                }]);
            }])->first();

            $response = [
                'order' => $order,
                'success' => true,
                'message' => " create order success",
            ];

            return response($response, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
