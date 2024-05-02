<?php
;
use App\Http\Controllers\ProductsController;
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

Route::get('/', function () {
    return view('welcome');
});




// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('adminlte.master');
})->middleware(['auth'])->name('dashboard');

Route::get('/products/view', [ProductsController::class, 'index'])->name('products.view')->middleware(['auth']);
Route::get('/products/{id}', [ProductsController::class, 'edit'])->name('products.edit')->middleware(['auth']);
Route::get('/delete/{id}', [ProductsController::class, 'delete'])->name('products.delete')->middleware(['auth']);
Route::get('/show/{id}', [ProductsController::class, 'show'])->name('products.show')->middleware(['auth']);

Route::get('/add/product', [ProductsController::class, 'showCreate'])->middleware(['auth']);
Route::post('/create/product', [ProductsController::class, 'create'])->name('product.create')->middleware(['auth']);
Route::post('/edit', [ProductsController::class, 'update'])->name('products.edits')->middleware(['auth']);





require __DIR__.'/auth.php';
