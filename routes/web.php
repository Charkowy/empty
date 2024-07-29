<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\PermissionRegistrar;
use App\Http\Middleware\EnsureUserHasPermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Clear application cache:
Route::get('/clear-all-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    app()[PermissionRegistrar::class]->forgetCachedPermissions();
    Auth::logout();
    return 'All cache has been cleared<br><a href="/">Home</a>';
});

//Route::webhooks('woohook/product/update', 'webhook-woorueditas');

Route::redirect('/', '/dashboard');
Route::redirect('/home', '/dashboard');

Route::get('/autocomplete/{method}', function (Request $request, $method) {
    // Obtener una instancia del controlador
    $controller = app()->make(App\Http\Controllers\AutoCompleteController::class);
    return app()->call([$controller, $method], ['request' => $request->all()]);
})->middleware('auth');

Route::middleware([
    'auth',
    EnsureUserHasPermission::class,
])->group(function () {
    Route::namespace('App\Http\Controllers')->group(function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('categories', 'CategoryController@index')->name('categories.index');
        Route::resource('orders', 'OrderController')->only(['index', 'show']);
    });

    Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', 'UserController');
        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
        Route::resource('menu-items', 'MenuItemController');
    });

    Route::namespace('App\Http\Controllers\User')->prefix('users')->name('users.')->group(function () {
        Route::resource('suppliers', 'SupplierController');
        Route::resource('customers', 'CustomerController');
        Route::get('profile', 'ProfileController@show')->name('profile.show');
        Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
        Route::put('profile', 'ProfileController@update')->name('profile.update');
    });

    Route::namespace('App\Http\Controllers\Product')->prefix('products')->name('products.')->group(function () {
        Route::resource('crud', 'CrudController')->except(['update', 'destroy', 'edit'])->parameters(['crud' => 'product']);
    });

    Route::namespace('App\Http\Controllers\Liquidation')->prefix('liquidations')->name('liquidations.')->group(function () {
        Route::get('suppliers', 'SupplierController@index')->name('suppliers.index');
        Route::post('suppliers/paid', 'SupplierController@paid')->name('suppliers.paid');
        Route::post('suppliers/notify', 'SupplierController@notify')->name('suppliers.notify');

        /* Route::get('partners', 'PartnerController@index')->name('partners.index');
        Route::post('partners/paid', 'PartnerController@paid')->name('partners.paid');
        Route::get('buyers', 'BuyerController@index')->name('buyers.index'); */
    });
});
