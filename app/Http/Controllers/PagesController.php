<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Salle;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $users = User::all();
        $products = Product::all()->where('deleted', 0);
        $stock = Stock::all()->where('deleted', 0);
        // dd($users);
        return view('pages.dashboard')
            ->with('users', $users)
            ->with('products', $products)
            ->with('stock', $stock);
    }
    // public function products()
    // {
    //     return view('pages.products');
    // }
    // public function createstock()
    // {
    //     return view('pages.createstock');
    // }
    // public function managestock()
    // {
    //     return view('pages.managestock');
    // }
    public function report()
    {
        return view('pages.report');
    }
    public function users()
    {
        $users = User::latest()->get();
        return view('pages.users')->with('users', $users);
    }
    public function edit($id)
    {
        $users = User::findOrfail($id);
        return view('pages.useredit')->with('users', $users);
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
        // $data = request()->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        // ]);

        // // storing data
        // $user = User::findOrfail($id);
        // $user->name = request()->input('name');
        // $user->email = request()->input('email');
        // $user->password = Hash::make(request()->input('email'));
        // $user->save();
        // return redirect('users')->with('edit', 'Changes saved successfully!');
    }

    public function createuser(Request $request)
    {
        // $data = request()->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => [
        //         'required',
        //         'string',
        //         'email',
        //         'max:255',
        //         'unique:users',
        //     ],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        // ]);

        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);
    }
}
