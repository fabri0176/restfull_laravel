<?php

use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Buyer\BuyerTransactionController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Transaction\TransactionCategoryController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\Transaction\TransactionSellerController;
use App\Http\Controllers\User\UserController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

/**
 * Buyers
 */
Route::resource('buyers', BuyerController::class, ['only' => ['index', 'show']]);
Route::resource('buyers.transactions', BuyerTransactionController::class, ['only' => ['index']]);


/**
 * Buyers
 */
Route::resource('categories', CategoryController::class, ['except' => ['create', 'edit']]);


/**
 * Products
 */
Route::resource('products', ProductController::class, ['only' => ['index', 'show']]);

/**
 * Transactions
 */
Route::resource('transactions', TransactionController::class, ['only' => ['index', 'show']]);
Route::resource('transactions.categories', TransactionCategoryController::class, ['only' => ['index']]);
Route::resource('transactions.sellers', TransactionSellerController::class, ['only' => ['index']]);

/**
 * Sellers
 */
Route::resource('sellers', SellerController::class, ['only' => ['index', 'show']]);

/**
 * Users
 */
Route::resource('users', UserController::class, ['except' => ['create', 'edit']]);
