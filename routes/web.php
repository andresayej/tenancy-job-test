<?php

use App\Models\Tenant;
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

Route::get('/create', function () {
//    $tenant = Tenant::create([
//        'plan' => 'Monthly Pay As You Go'
//    ]);

    $tenant = Tenant::find('b198202a-f78f-4864-b6c8-705146fb5e41');

    tenancy()->initialize($tenant);
    \App\Jobs\InsertUserJob::dispatch();
});
