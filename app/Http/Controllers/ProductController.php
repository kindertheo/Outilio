<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
            'product' => 'required'
        ]);

        $product = Product::create([
            'name' => $request->product['name'],
            'sluggy_name' => Str::slug($request->product['name'], '-'),
            'description' => $request->product['description'],
            'price_by_day' => $request->product['priceByDay'] * 100,
            'created_at' => Carbon::now()
        ]);

        return json_encode(['product' => $product], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Display all the products.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $this->validate($request, [
            'date' => 'required'
        ]);

        $date = Carbon::createFromTimeString($request->date)->toDateString();

        $productsAvailables = Product::whereRelation('orders', 'date', '!=', $date)
            ->orWhereDoesntHave('orders')
            ->select(
                'id',
                'name',
                'description',
                'price_by_day'
            )
            ->addSelect(DB::raw('1 as is_available'))
            ->get();

        $productsNotAvailables = Product::whereRelation('orders', 'date', '=', $date)
            ->whereRelation('orders', 'is_accepted', true)
            ->select(
                'id',
                'name',
                'description',
                'price_by_day'
            )
            ->addSelect(DB::raw('0 as is_available'))
            ->get();

        return $productsAvailables->merge($productsNotAvailables);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'product' => 'required'
        ]);

        $product->update([
            'name' => $request->product['name'],
            'sluggy_name' => Str::slug($request->product['name'], '-'),
            'description' => $request->product['description'],
            'price_by_day' => $request->product['priceByDay'] * 100,
            'updated_at' => Carbon::now()
        ]);

        return json_encode(['product' => $product], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }
}
