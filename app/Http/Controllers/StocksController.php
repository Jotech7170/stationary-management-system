<?php

namespace App\Http\Controllers;

use App\Models\StockProduct;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Salle;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $products = Product::latest()
            ->get()
            ->where('deleted', 0);
        return view('pages.createstock')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Filtering datas entered by user
        $data = request()->validate([
            'name' => 'required',
            'stock_in_date' => 'required',
            'end_of_stock' => 'required',
            'total_cost_of_stock' => 'required',
        ]);

        //    dd($request);
        //        Creating Stock
        $stock = new Stock();
        $stock->name = \request()->input('name');
        $stock->stock_in_date = \request()->input('stock_in_date');
        $stock->end_of_stock = \request()->input('end_of_stock');
        $stock->total_cost_of_stock = \request()->input('total_cost_of_stock');
        $stock->save();

        //        Adding Products in a stock
        //        dd($stock_products_items);
        $products = \request()->input('products');
        $quantity = \request()->input('quantity');
        $buying_price = \request()->input('buying_price');
        $selling_price = \request()->input('selling_price');
        $expire_date = \request()->input('expire_date');

        //    dd($quantity);

        for ($i = 0; $i < count($products); $i++) {
            $product = new StockProduct();
            if (
                $products[$i] != null &&
                $quantity[$i] != null &&
                $buying_price[$i] != null &&
                $selling_price[$i] != null &&
                $expire_date[$i] != null
            ) {
                $product->stock_id = $stock->id;
                $product->product_id = $products[$i];
                $product->quantity = $quantity[$i];
                $product->buying_price = $buying_price[$i];
                $product->selling_price = $selling_price[$i];
                $product->expire_date = $expire_date[$i];
                //            dd($product);
                $product->save();
            }
        }

        return redirect('managestock')->with(
            'success',
            'Stock added successfully!'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stock = Stock::with('stock_products.products')->find($id);
        //        dd($stock);
        $total_products = StockProduct::latest()
            ->get()
            ->where('stock_id', $id)
            ->sum('quantity');
        $total_sold = Salle::latest()
            ->get()
            ->where('stock_id', $id)
            ->sum('quantity');
        //        dd($total_sold);
        return view('pages.viewstock')
            ->with('stock', $stock)
            ->with('total_products', $total_products)
            ->with('total_sold', $total_sold);
    }
    public function deletestockproduct($id)
    {
        $stockproduct = StockProduct::findOrfail($id);
        $stockproduct->delete();
        return redirect()
            ->back()
            ->with('edit', 'Changes saved successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock = Stock::findOrfail($id);
        $stock->deleted = request()->input('deleted');
        $stock->save();
        return redirect('managestock')->with(
            'edit',
            'Changes saved successfully!'
        );
    }
    public function manage_stocks()
    {
        $stocks = Stock::where('deleted', 0)
            ->latest()
            ->get();
        return view('pages.managestock')->with('stocks', $stocks);
    }
}
