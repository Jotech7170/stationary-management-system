<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Salle;
use App\Models\StockProduct;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class SallesController extends Controller
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
        $stock = 0;
        $product = 0;
        $from = 0;
        $to = 0;
        $fromTo = [$from, $to];

        $salles = Salle::with('stock', 'products')
            ->latest()
            ->get()
            ->where('deleted', 0);
        $stocks = Stock::latest()
            ->get()
            ->where('deleted', 0);
        $products = Product::latest()
            ->get()
            ->where('deleted', 0);
        $quantity_sold = Salle::latest()
            ->get()
            ->where('deleted', 0)
            ->sum('quantity');
        $total_price_sold = Salle::latest()
            ->get()
            ->where('deleted', 0)
            ->sum('price');
        $quantity_products = StockProduct::latest()
            ->get()
            ->where('deleted', 0)
            ->sum('quantity');
        $total_cost_products = StockProduct::latest()
            ->get()
            ->where('deleted', 0)
            ->sum('buying_price');
        $loss_or_profit = $total_price_sold - $total_cost_products;
        //        dd($salles[0]->stock->products);
        return view('pages.report')
            ->with('salles', $salles)
            ->with('stocks', $stocks)
            ->with('products', $products)
            ->with('quantity_sold', $quantity_sold)
            ->with('total_price_sold', $total_price_sold)
            ->with('quantity_products', $quantity_products)
            ->with('total_cost_products', $total_cost_products)
            ->with('loss_or_profit', $loss_or_profit)
            ->with('stock', $stock)
            ->with('product', $product)
            ->with('fromTo', $fromTo);
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
            'stock_id' => 'required',
            'product_id' => 'required',
            'stock_product_id' => 'required',
            'quantity' => 'required',
        ]);

        // storing data
        $sell = new Salle();
        $sell->user_id = Auth::user()->id;
        $sell->stock_id = \request()->input('stock_id');
        $sell->product_id = \request()->input('product_id');
        $sell->stock_product_id = \request()->input('stock_product_id');
        $sell->quantity = \request()->input('quantity');
        $sell->price = \request()->input('price') * $sell->quantity;
        //        dd($sell);
        $sell->save();
        return redirect()
            ->back()
            ->with('success', 'Sells recorded successfully!'); //Filtering datas entered by user
        $data = request()->validate([
            'stock_id' => 'required',
            'product_id' => 'required',
            'stock_product_id' => 'required',
            'quantity' => 'required',
        ]);

        // storing data
        $sell = new Salle();
        $sell->user_id = Auth::user()->id;
        $sell->stock_id = \request()->input('stock_id');
        $sell->product_id = \request()->input('product_id');
        $sell->stock_product_id = \request()->input('stock_product_id');
        $sell->quantity = \request()->input('quantity');
        $sell->price = \request()->input('price') * $sell->quantity;
        //        dd($sell);
        $sell->save();
        return redirect()
            ->back()
            ->with('success', 'Sells recorded successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = StockProduct::with(
            'products',
            'salles',
            'stock'
        )->findOrFail($id);
        $sold = Salle::where('stock_product_id', $id)
            ->where('deleted', 0)
            ->where('stock_id', $product->stock_id)
            ->sum('quantity');
        //    dd($sold);
        $remaining_products = $product->quantity - $sold;
        //    dd($remaining_products);
        return view('pages.sell_product')
            ->with('product', $product)
            ->with('remaining_products', $remaining_products);
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
    public function deletesells($id)
    {
        $sells = Salle::findOrfail($id);
        // $sells->deleted = request()->input('deleted');
        // $sells->save();
        $sells->delete();
        return redirect()
            ->back()
            ->with('edit', 'Changes saved successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filters()
    {
        // obtaining filter values from the inputs
        $stock = $_GET['stock_id'];
        $product = $_GET['product_id'];
        $from = $_GET['from_date'];
        $to = $_GET['to_date'];
        $fromTo = [$from, $to];

        // checking if filter values contains 0 value
        if ($stock == 0) {
            $stock = null;
        }
        if ($product == 0) {
            $product = null;
        }
        if ($fromTo[0] == 0) {
            $from = null;
        }
        if ($fromTo[1] == 0) {
            $to = null;
        }

        // Filtering datas
        if ($stock && $product && $from && $to) {
            $salles = Salle::with('stock', 'products')
                ->where('stock_id', $stock)
                ->where('deleted', 0)
                ->where('product_id', $product)
                ->whereBetween('created_at', $fromTo)
                ->get();
            $quantity_sold = Salle::with('stock', 'products')
                ->where('stock_id', $stock)
                ->where('deleted', 0)
                ->where('product_id', $product)
                ->whereBetween('created_at', $fromTo)
                ->sum('quantity');
            $total_price_sold = Salle::with('stock', 'products')
                ->where('stock_id', $stock)
                ->where('deleted', 0)
                ->where('product_id', $product)
                ->whereBetween('created_at', $fromTo)
                ->sum('price');
            $quantity_products = StockProduct::where('stock_id', $stock)
                ->where('product_id', $product)
                ->whereBetween('created_at', $fromTo)
                ->sum('quantity');
            $total_cost_products = StockProduct::where('stock_id', $stock)
                ->where('product_id', $product)
                ->whereBetween('created_at', $fromTo)
                ->sum('buying_price');
            $loss_or_profit = $total_price_sold - $total_cost_products;
        } elseif ($from && $to) {
            $salles = Salle::with('stock', 'products')
                ->where('deleted', 0)
                ->where('stock_id', 'like', '%' . $stock . '%')
                ->where('product_id', 'like', '%' . $product . '%')
                ->whereBetween('created_at', $fromTo)
                ->get();
            $quantity_sold = Salle::with('stock', 'products')
                ->where('deleted', 0)
                ->where('stock_id', 'like', '%' . $stock . '%')
                ->where('product_id', 'like', '%' . $product . '%')
                ->whereBetween('created_at', $fromTo)
                ->sum('quantity');
            $total_price_sold = Salle::with('stock', 'products')
                ->where('deleted', 0)
                ->where('stock_id', 'like', '%' . $stock . '%')
                ->where('product_id', 'like', '%' . $product . '%')
                ->whereBetween('created_at', $fromTo)
                ->sum('price');
            $quantity_products = StockProduct::where(
                'stock_id',
                'like',
                '%' . $stock . '%'
            )
                ->where('product_id', 'like', '%' . $product . '%')
                ->whereBetween('created_at', $fromTo)
                ->sum('quantity');
            $total_cost_products = StockProduct::where(
                'stock_id',
                'like',
                '%' . $stock . '%'
            )
                ->where('product_id', 'like', '%' . $product . '%')
                ->whereBetween('created_at', $fromTo)
                ->sum('buying_price');
            $loss_or_profit = $total_price_sold - $total_cost_products;
        } else {
            $salles = Salle::with('stock', 'products')
                ->where('deleted', 0)
                ->where('stock_id', 'like', '%' . $stock . '%')
                ->where('product_id', 'like', '%' . $product . '%')
                ->where('created_at', 'like', '%' . $fromTo[0] . '%')
                ->where('created_at', 'like', '%' . $fromTo[1] . '%')
                ->get();
            $quantity_sold = Salle::with('stock', 'products')
                ->where('deleted', 0)
                ->where('stock_id', 'like', '%' . $stock . '%')
                ->where('product_id', 'like', '%' . $product . '%')
                ->where('created_at', 'like', '%' . $fromTo[0] . '%')
                ->where('created_at', 'like', '%' . $fromTo[1] . '%')
                ->sum('quantity');
            $total_price_sold = Salle::with('stock', 'products')
                ->where('deleted', 0)
                ->where('stock_id', 'like', '%' . $stock . '%')
                ->where('product_id', 'like', '%' . $product . '%')
                ->where('created_at', 'like', '%' . $fromTo[0] . '%')
                ->where('created_at', 'like', '%' . $fromTo[1] . '%')
                ->sum('price');
            $quantity_products = StockProduct::where(
                'stock_id',
                'like',
                '%' . $stock . '%'
            )
                ->where('product_id', 'like', '%' . $product . '%')
                ->where('created_at', 'like', '%' . $fromTo[0] . '%')
                ->where('created_at', 'like', '%' . $fromTo[1] . '%')
                ->sum('quantity');
            $total_cost_products = StockProduct::where(
                'stock_id',
                'like',
                '%' . $stock . '%'
            )
                ->where('product_id', 'like', '%' . $product . '%')
                ->where('created_at', 'like', '%' . $fromTo[0] . '%')
                ->where('created_at', 'like', '%' . $fromTo[1] . '%')
                ->sum('buying_price');
            $loss_or_profit = $total_price_sold - $total_cost_products;
        }

        $stocks = Stock::latest()
            ->where('deleted', 0)
            ->get();
        $products = Product::latest()
            ->where('deleted', 0)
            ->get();

        // returning NULL filter values to 0
        if ($stock == null) {
            $stock = 0;
        }
        if ($product == null) {
            $product = 0;
        }
        if ($fromTo[0] == null) {
            $fromTo[0] = 0;
        }
        if ($fromTo[1] == null) {
            $fromTo[1] = 0;
        }
        return view('pages.report')
            ->with('salles', $salles)
            ->with('stocks', $stocks)
            ->with('products', $products)
            ->with('quantity_sold', $quantity_sold)
            ->with('total_price_sold', $total_price_sold)
            ->with('quantity_products', $quantity_products)
            ->with('total_cost_products', $total_cost_products)
            ->with('loss_or_profit', $loss_or_profit)
            ->with('stock', $stock)
            ->with('product', $product)
            ->with('fromTo', $fromTo);
    }

    public function download($stock, $product, $from, $to)
    {
        // checking if filter values contains 0 value
        if ($stock == 0) {
            $stock = null;
        }
        if ($product == 0) {
            $product = null;
        }
        if ($from == 0) {
            $from = null;
        }
        if ($to == 0) {
            $to = null;
        }
        // dd("Inside");
        if ($stock == 0 && $product == 0 && $from == 0 && $to == 0) {
            $salles = Salle::with('stock', 'products')->get();
            $quantity_sold = Salle::latest()
                ->get()
                ->where('deleted', 0)
                ->sum('quantity');
            $total_price_sold = Salle::latest()
                ->where('deleted', 0)
                ->get()
                ->sum('price');
            $quantity_products = StockProduct::latest()
                ->get()
                ->sum('quantity');
            $total_cost_products = StockProduct::latest()
                ->get()
                ->sum('buying_price');
            $loss_or_profit = $total_price_sold - $total_cost_products;

            // $paper_size = array(0,0,360,360);
            // ->setPaper($paper_size, 'potrait')

            $pdf = PDF::loadView('pages/print', [
                'salles' => $salles,
                'quantity_sold' => $quantity_sold,
                'total_price_sold' => $total_price_sold,
                'quantity_products' => $quantity_products,
                'total_cost_products' => $total_cost_products,
                'loss_or_profit' => $loss_or_profit,
            ]);
            // dd($pdf);
            return $pdf->download('report-salles.pdf');
        } elseif ($from != 0 && $to != 0) {
            $fromTo = [$from, $to];
            $salles = Salle::with('stock', 'products')
                ->where('deleted', 0)
                ->where('stock_id', 'like', '%' . $stock . '%')
                ->where('product_id', 'like', '%' . $product . '%')
                ->whereBetween('created_at', $fromTo)
                ->latest()
                ->get();
            $quantity_sold = Salle::with('stock', 'products')
                ->where('deleted', 0)
                ->where('stock_id', 'like', '%' . $stock . '%')
                ->where('product_id', 'like', '%' . $product . '%')
                ->whereBetween('created_at', $fromTo)
                ->sum('quantity');
            $total_price_sold = Salle::with('stock', 'products')
                ->where('deleted', 0)
                ->where('stock_id', 'like', '%' . $stock . '%')
                ->where('product_id', 'like', '%' . $product . '%')
                ->whereBetween('created_at', $fromTo)
                ->sum('price');
            $quantity_products = StockProduct::where(
                'stock_id',
                'like',
                '%' . $stock . '%'
            )
                ->where('product_id', 'like', '%' . $product . '%')
                ->whereBetween('created_at', $fromTo)
                ->sum('quantity');
            $total_cost_products = StockProduct::where(
                'stock_id',
                'like',
                '%' . $stock . '%'
            )
                ->where('product_id', 'like', '%' . $product . '%')
                ->whereBetween('created_at', $fromTo)
                ->sum('buying_price');
            $loss_or_profit = $total_price_sold - $total_cost_products;

            $pdf = PDF::loadView('pages/print', [
                'salles' => $salles,
                'quantity_sold' => $quantity_sold,
                'total_price_sold' => $total_price_sold,
                'quantity_products' => $quantity_products,
                'total_cost_products' => $total_cost_products,
                'loss_or_profit' => $loss_or_profit,
            ]);
            // dd($pdf);
            return $pdf->download('report-salles.pdf');
        } else {
            $salles = Salle::with('stock', 'products')
                ->where('deleted', 0)
                ->where('stock_id', 'like', '%' . $stock . '%')
                ->where('product_id', 'like', '%' . $product . '%')
                ->where('created_at', 'like', '%' . $from . '%')
                ->where('created_at', 'like', '%' . $to . '%')
                ->latest()
                ->get();
            $quantity_sold = Salle::with('stock', 'products')
                ->where('deleted', 0)
                ->where('stock_id', 'like', '%' . $stock . '%')
                ->where('product_id', 'like', '%' . $product . '%')
                ->where('created_at', 'like', '%' . $from . '%')
                ->where('created_at', 'like', '%' . $to . '%')
                ->sum('quantity');
            $total_price_sold = Salle::with('stock', 'products')
                ->where('deleted', 0)
                ->where('stock_id', 'like', '%' . $stock . '%')
                ->where('product_id', 'like', '%' . $product . '%')
                ->where('created_at', 'like', '%' . $from . '%')
                ->where('created_at', 'like', '%' . $to . '%')
                ->sum('price');
            $quantity_products = StockProduct::where(
                'stock_id',
                'like',
                '%' . $stock . '%'
            )
                ->where('product_id', 'like', '%' . $product . '%')
                ->where('created_at', 'like', '%' . $from . '%')
                ->where('created_at', 'like', '%' . $to . '%')
                ->sum('quantity');
            $total_cost_products = StockProduct::where(
                'stock_id',
                'like',
                '%' . $stock . '%'
            )
                ->where('product_id', 'like', '%' . $product . '%')
                ->where('created_at', 'like', '%' . $from . '%')
                ->where('created_at', 'like', '%' . $to . '%')
                ->sum('buying_price');
            $loss_or_profit = $total_price_sold - $total_cost_products;

            $pdf = PDF::loadView('pages/print', [
                'salles' => $salles,
                'quantity_sold' => $quantity_sold,
                'total_price_sold' => $total_price_sold,
                'quantity_products' => $quantity_products,
                'total_cost_products' => $total_cost_products,
                'loss_or_profit' => $loss_or_profit,
            ]);
            return $pdf->download('report-salles.pdf');
        }
    }
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
        //
    }
}
