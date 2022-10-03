<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('pages.dashboard');
// });

Auth::routes();

Route::get('/home', [PagesController::class, 'dashboard']);
Route::get('/', [PagesController::class, 'dashboard']);
Route::get('/report', [PagesController::class, 'report']);
Route::get('/users', [PagesController::class, 'users']);
Route::post('/create_user', [
    App\Http\Controllers\PagesController::class,
    'createuser',
])->name('create_user');

Route::post('/makeuser', [UsersController::class, 'store']);
Route::PATCH('/updateuser/{user}', [UsersController::class, 'update']);
Route::delete('/userdelete/{user}', [UsersController::class, 'destroy']);
Route::get('/users/{users}', [
    App\Http\Controllers\PagesController::class,
    'edit',
])->name('edit_user');
// Route::PATCH('/user/{user}', [
//     App\Http\Controllers\PagesController::class,
//     'update',
// ])->name('update_user');

// stock routes
// Route::get('/createstock', [PagesController::class, 'createstock']);
// Route::get('/managestock', [PagesController::class, 'managestock']);
Route::get('/createstock', [
    App\Http\Controllers\StocksController::class,
    'index',
])->name('stocks');
Route::post('/create_stock', [
    App\Http\Controllers\StocksController::class,
    'store',
])->name('create_stock');
Route::get('/managestock', [
    App\Http\Controllers\StocksController::class,
    'manage_stocks',
])->name('manage_stocks');
Route::patch('/deletestock/{stock}', [
    App\Http\Controllers\StocksController::class,
    'destroy',
]);
Route::delete('/deletestockproduct/{stockproduct}', [
    App\Http\Controllers\StocksController::class,
    'deletestockproduct',
]);

//View stock by id
Route::get('/view_stock/{stock}', [
    App\Http\Controllers\StocksController::class,
    'show',
])->name('view_stock');
Route::post('/add_products', [
    App\Http\Controllers\ProductsController::class,
    'store',
])->name('add_products');

// product routes
// Route::get('/products', [PagesController::class, 'products']);
Route::get('/products', [
    App\Http\Controllers\ProductsController::class,
    'index',
])->name('products');

Route::post('/create_products', [
    App\Http\Controllers\ProductsController::class,
    'store',
])->name('create_products');
Route::get('/edit_product/{product}', [
    App\Http\Controllers\ProductsController::class,
    'edit',
])->name('edit_product');
Route::PATCH('/update_product/{product}', [
    App\Http\Controllers\ProductsController::class,
    'update',
])->name('update_product');

Route::PATCH('/deleteproduct/{product}', [
    App\Http\Controllers\ProductsController::class,
    'destroy',
]);

//Sells Route stats here
Route::get('/report', [
    App\Http\Controllers\SallesController::class,
    'index',
])->name('report');
Route::get('/sell_product/{product}', [
    App\Http\Controllers\SallesController::class,
    'show',
])->name('sells');
Route::post('/sell_product', [
    App\Http\Controllers\SallesController::class,
    'store',
])->name('sell_product');

Route::delete('/deletesells/{sells}', [
    App\Http\Controllers\SallesController::class,
    'deletesells',
]);

// Filtering salles data
Route::get('/filter_data', [
    App\Http\Controllers\SallesController::class,
    'filters',
])->name('filter_data');
// Printing report
Route::get('/print_pdf/{stock}/{product}/{from}/{to}', [
    App\Http\Controllers\SallesController::class,
    'download',
])->name('print_pdf');
// Route::get('/test', function () {
//     return view('testing');
// });

// Route::get('/home', [
//     App\Http\Controllers\HomeController::class,
//     'index',
// ])->name('home');
// Route::get('/', [
//     App\Http\Controllers\HomeController::class,
//     'dashboard',
// ])->name('dashboard');
