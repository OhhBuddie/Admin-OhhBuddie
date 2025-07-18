<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Sellers\SellerController;
use App\Http\Controllers\Sellers\ContactController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReturnandrefundController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\SalesTagController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\EmployeeController;



Route::get('/colors', [HomeController::class, 'showColors']);
Route::get('/get-sizes/{categoryId}', [HomeController::class, 'getSizes']);

Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin']);

Route::get('/', [HomeController::class, 'dashboard'])->middleware('auth');


Route::get('/product', [App\Http\Controllers\ProductController::class, 'index']);

Route::get('/listing', [App\Http\Controllers\ProductController::class,'listing1']);

// Route::get('/listing1', [App\Http\Controllers\ProductController::class,'listing1']);
Route::get('/product-listing', [App\Http\Controllers\ProductController::class,'form']);

Route::get('/product-listing1', [App\Http\Controllers\ProductController::class,'form']);

Route::get('/product-listing_new', [App\Http\Controllers\ProductController::class,'form_new']);

Route::post('/store_new', [App\Http\Controllers\ProductController::class,'store_new'])->name('products.store_new');



Route::get('/get-subcategories/{id}', [ProductController::class, 'getSubcategories']);
Route::get('/get-sub-subcategories/{id}', [ProductController::class, 'getSubSubcategories']);


Route::controller(App\Http\Controllers\UserController::class)->group(function(){

    Route::get('profileedit/{id}', 'edit')->name('user.edit');
    Route::post('name/update', 'nameupdate')->name('name.update');
    Route::post('profileupdate/{id}', 'update')->name('user.update');

});

Auth::routes();

Route::controller(LoginController::class)->group(function () {
    Route::get('/logout', 'logout')->name('logout');
});

Route::get('/accounts', [HomeController::class, 'account']);

Route::get('/account', [HomeController::class, 'account'])->middleware('auth');

Auth::routes();

// Route::get('/seller', [App\Http\Controllers\SellerController::class, 'index']);

Route::get('/seller', [SellerController::class, 'index']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [SellerController::class, 'dashboard'])->name('seller.dashboard');


Route::get('2fa', [App\Http\Controllers\TwoFAController::class, 'index'])->name('2fa.index');

Route::post('2fa', [App\Http\Controllers\TwoFAController::class, 'store'])->name('2fa.post');

Route::get('2fa/reset', [App\Http\Controllers\TwoFAController::class, 'resend'])->name('2fa.resend');

// Seller Portal

Route::get('/seller/login', [SellerController::class, 'login'])->name('seller.login');
Route::post('/seller/submit-phone', [SellerController::class, 'submitPhone'])->name('seller.submit.phone');

Route::get('/seller/enter-otp', [SellerController::class, 'enterOtp'])->name('seller.enter-otp');
Route::post('/seller/submit-otp', [SellerController::class, 'submitOtp'])->name('seller.submit.otp');

Route::get('/seller/enter-email', [SellerController::class, 'enterEmail'])->name('seller.enter-email');
Route::post('/seller/submit-email', [SellerController::class, 'submitEmail'])->name('seller.submit.email');

Route::get('/seller/enter-email-otp', [SellerController::class, 'enterEmailOtp'])->name('seller.enter-email-otp');
Route::post('/seller/submit-email-otp', [SellerController::class, 'submitEmailOtp'])->name('seller.submit.email.otp');


Route::get('/seller/registration', [SellerController::class, 'registration'])->name('seller.registration');

Route::post('/submitform', [SellerController::class, 'submitform'])->name('seller.submitform');

Route::get('/dashboard', [SellerController::class, 'dashboard'])->name('seller.dashboard');

Route::get('/seller/profileedit/{id}', [SellerController::class, 'profileedit'])->name('seller.profileedit');

Route::post('/editform/{id}', [SellerController::class, 'editform'])->name('seller.submitform');

Route::get('/profile', [SellerController::class, 'profile']);


Route::controller(App\Http\Controllers\Sellers\AuthOtpController::class)->group(function(){

    Route::get('sellerotp/login', 'login')->name('sellerotp.login');

    Route::post('sellerotp/generate', 'generate')->name('sellerotp.generate');

    Route::get('sellerotp/verification/{user_id}', 'verification')->name('sellerotp.verification');

    Route::post('sellerotp/login', 'loginWithOtp')->name('sellerotp.getlogin');
    
});

Route::resource('products', ProductController::class);



Route::resource('contacts', ContactController::class);

Route::resource('warehouses', WarehouseController::class);


Route::controller(App\Http\Controllers\ProductController::class)->group(function(){

    Route::get('product/sellerproduct', 'sellerproduct')->name('product.sellerproduct');
    Route::get('product/allseller', 'sellerdetails');


});


// Route::post('/save-images', [ProductController::class, 'saveImages'])->name('saveImages');
Route::post('/save-product-data', [App\Http\Controllers\ProductController::class, 'saveProductData'])->name('save.product.data');
Route::get('/get-product-images', [ProductController::class, 'getProductImages']);
Route::get('/get-seller-data', [ProductController::class, 'getSellerData']);
Route::get('/get-cities', [SellerController::class, 'getCities'])->name('getCities');

Route::put('/update1/{id}', [ProductController::class, 'update2'])->name('product.update2');

Route::get('/catproduct', [ProductController::class, 'catproduct']);

// Orders

Route::get('/allorders', [OrderController::class, 'allorders']);
Route::get('/allorderdetails/{id}', [OrderController::class, 'allorderdetails']);
Route::get('/neworders', [OrderController::class, 'neworders']);

Route::post('/update-delivery-status', [OrderController::class, 'updateDeliveryStatus'])->name('update.delivery.status');

Route::post('/update-refund-status', [ReturnandrefundController::class, 'updateRefundStatus'])->name('update.refund.status');

Route::post('/update-product-stored', [ReturnandrefundController::class, 'updateProductstored'])->name('update.product.stored');

Route::post('/update-pickup-status', [ReturnandrefundController::class, 'updatePickupStatus'])->name('update.pickup.status');

Route::post('/admin/update-note', [ReturnandrefundController::class, 'updateNote'])->name('admin.updateNote');


// Return And Refund

Route::get('/allrefunds', [ReturnandrefundController::class, 'index']);
Route::get('/returndetails/{id}', [ReturnandrefundController::class, 'returndetails']);

Route::post('/update-seller-paid', [OrderController::class, 'updateSellerPaid']);


Route::get('/alluser', [HomeController::class, 'alluser']);


Route::get('/upload', [ImageUploadController::class, 'showForm']);
Route::post('/upload', [ImageUploadController::class, 'upload'])->name('image.upload');




Route::get('salestags', [SalesTagController::class, 'index'])->name('salestags.index');
Route::post('salestags', [SalesTagController::class, 'store'])->name('salestags.store');
Route::post('salestags/{id}/update', [SalesTagController::class, 'update'])->name('salestags.update');
Route::delete('salestags/{id}', [SalesTagController::class, 'destroy'])->name('salestags.destroy');
Route::post('/products/update-status/{id}', [ProductController::class, 'updateStatus']);


Route::resource('footers', FooterController::class);

Route::post('/footer/store', [FooterController::class, 'store'])->name('footer.store');

Route::get('/check-gst-number', [SellerController::class, 'checkGstNumber']);

Route::get('/check-registered-number', [SellerController::class, 'checkRegisteredNumber']);

Route::get('/check-email-address', [SellerController::class, 'checkRegisteredEmail']);
Route::resource('employees', EmployeeController::class);



