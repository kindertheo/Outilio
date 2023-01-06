<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Order as MailOrder;

class OrderController extends Controller
{
    public function all()
    {
        return Order::with('products')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'order' => 'required'
        ]);

        $order = Order::create([
            'date' => Carbon::createFromTimeString($request->order['date'])->toDateString(),
            'delivery_option' => $request->order['deliveryOption'],
            'is_accepted' => $request->order['isAccepted'],
            'is_processed' => $request->order['isProcessed'],
            'customer_phone' => $request->order['customerPhone'],
            'customer_email' => $request->order['customerEmail'],
            'customer_firstname' => $request->order['customerFirstname'],
            'customer_lastname' => $request->order['customerLastname'],
            'price' => $request->order['price'],
            'created_at' => Carbon::now()
        ]);

        foreach ($request->order['products'] as $product)
            $order->products()->attach($product['id']);

//        Mail::to('jhon.doe.mns@gmail.com')
//            ->send(new MailOrder($order));
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $this->validate($request, [
            'order' => 'required'
        ]);

        $order->update([
            'date' => Carbon::createFromTimeString($request->order['date'])->toDateString(),
            'delivery_option' => $request->order['deliveryOption'],
            'is_accepted' => $request->order['isAccepted'],
            'is_processed' => $request->order['isProcessed'],
            'customer_email' => $request->order['customerEmail'],
            'customer_firstname' => $request->order['customerFirstname'],
            'customer_lastname' => $request->order['customerLastname'],
            'price' => $request->order['price'],
            'updated_at' => Carbon::now()
        ]);

        return json_encode(['order' => $order], 201);
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
