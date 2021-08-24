<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;


use App\Http\Controllers\storekeeper\StoreArrivalController;
use App\Http\Controllers\storekeeper\UserController;
use App\Http\Controllers\storekeeper\RoleController;
use App\Http\Controllers\storekeeper\SupplierController;
use App\Http\Controllers\storekeeper\CategoryController;
use App\Http\Controllers\storekeeper\ItemController;
use App\Http\Controllers\storekeeper\SectionController;
use App\Http\Controllers\storekeeper\GoodsPageController;
use App\Http\Controllers\storekeeper\CategoryBookController;
use App\Http\Controllers\storekeeper\ConfirmedItemsController;
use App\Http\Controllers\storekeeper\RejectedItemsController;
use App\Http\Controllers\storekeeper\DisposedItemController;

use App\Http\Controllers\sections\SectionPageController;
use App\Http\Controllers\sections\SectionResponseController;
use App\Http\Controllers\sections\SectionStockPageController;
use App\Http\Controllers\sections\SectionStockController;
use App\Http\Controllers\sections\DeprecatedStockController;


use App\Http\Controllers\storemanager\ManagerPageController;
use App\Http\Controllers\storemanager\ManagerResponseController;
use App\Http\Controllers\office\OfficePageController;

use App\Http\Controllers\GEM_consignee\GemConsigneeController;
use App\Http\Controllers\GEM_consignee\ConsigneeResponseController;


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

// Route::get('register',[RegisterController::class,'register'])->name('register');

Route::post('register', [RegisterController::class, 'storeUser']);



Route::post('login', [LoginController::class, 'authenticate']);

Route::post('/change-password', [LoginController::class, 'change_password']);

Route::get('/', function () {
    return redirect('login');
});



// Route::get('/', function () {
//     return view('Auth.Login');
// });


Route::group(['middleware' => 'Prevent-Back-History'], function () {


    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');


    // #############################################################################
    // Store-Keeper group

    Route::group(['middleware' => 'Store-Keeper'], function () {



        Route::get('/storedashboard', [StoreArrivalController::class, 'index']);
        Route::get('/storeArrivalbook', [StoreArrivalController::class, 'storeArrivalbook']);
        Route::get('/arrivalDetails', [StoreArrivalController::class, 'arrivalDetails']);
        Route::get('/arrivalExport', [StoreArrivalController::class, 'arrivalExport']);


        Route::get('/confirmedItemPage', [ConfirmedItemsController::class, 'index']);
        Route::get('/confirmedDetails', [ConfirmedItemsController::class, 'confirmedItems']);

        Route::get('/RejectedItemPage', [RejectedItemsController::class, 'index']);
        Route::get('/rejectedDetails', [RejectedItemsController::class, 'rejectedItems']);
        Route::get('/rejectedExport', [RejectedItemsController::class, 'rejectedExport']);
        Route::post('/disposed/{id}', [RejectedItemsController::class, 'dispose']);

 Route::get('/girlist', [GoodsPageController::class, 'index']);
        Route::post('/addtogir', [ConfirmedItemsController::class, 'store']);
        Route::get('/goodslist', [GoodsPageController::class, 'goodslist']);
        Route::get('/exportgirlist', [GoodsPageController::class, 'exportGirList']);
        Route::get('/getsection', [GoodsPageController::class, 'sectionName']);
        Route::post('/allot_item', [GoodsPageController::class, 'allot']);

        Route::get('/adduser', [UserController::class, 'index']);

        Route::get('/addroles', [RoleController::class, 'index']);
        Route::post('/add_role', [RoleController::class, 'store']);

        Route::get('/addsuppliers', [SupplierController::class, 'index']);

        Route::get('/addcategories', [CategoryController::class, 'index']);

        Route::get('/additems', [ItemController::class, 'index']);

        Route::get('/addsections', [SectionController::class, 'index']);


        Route::get('/kardex', [CategoryBookController::class, 'kardexindex']);
        Route::get('/dsr', [CategoryBookController::class, 'dsrindex']);
        Route::get('/dsrdetails', [CategoryBookController::class, 'dsrdetails']);
        Route::get('/kardexdetails', [CategoryBookController::class, 'kardexdetails']);
    });

    // #############################################################################
    // Section-Officer group

    Route::group(['middleware' => 'Section-Officer'], function () {

        Route::get('/sectiondashboard', [SectionPageController::class, 'index']);
        Route::get('/section-details', [SectionPageController::class, 'sectionItem']);
        Route::get('/sectionlogout', [SectionPageController::class, 'logout']);

        Route::get('/sectionreturn', [SectionPageController::class, 'sectionReturn']);


        Route::post('/section-confirm/{id}', [SectionResponseController::class, 'confirm']);
        Route::post('/section-reject/{id}', [SectionResponseController::class, 'reject']);


        Route::get('/sectionstock', [SectionStockPageController::class, 'index']);
        Route::get('/sectionstockdetails', [SectionStockController::class, 'sectionStock']);
        Route::get('/exportsectionstock', [SectionStockController::class, 'exportSectionStock']);

        Route::post('/section-deprecated/{id}', [DeprecatedStockController::class, 'store']);
        Route::get('/depreciateddetails', [DeprecatedStockController::class, 'depreciatedStock']);
    });

    // #############################################################################
    // Store-Officer group

    Route::group(['middleware' => 'Store-Officer'], function () {

        Route::get('/managerdashboard', [ManagerPageController::class, 'index']);
        Route::get('/manager-details', [ManagerPageController::class, 'managerlist']);
        Route::get('/arrivalbook', [ManagerPageController::class, 'arrivalbook']);
        Route::get('/store-details', [ManagerPageController::class, 'storelist']);


        Route::post('/manager-confirm/{id}', [ManagerResponseController::class, 'confirm']);
        Route::post('/manager-reject/{id}', [ManagerResponseController::class, 'reject']);
    });

    // #############################################################################
    // GeM-Consignee group


    Route::group(['middleware' => 'GeM-Consignee'], function () {

        Route::get('/gem-dashboard', [GemConsigneeController::class, 'index']);
        Route::get('/consignee-details', [GemConsigneeController::class, 'consigneeDetails']);

        Route::get('/gem-arrival-book', [GemConsigneeController::class, 'GemArrivalBook']);
        Route::get('/GemArrival-details', [GemConsigneeController::class, 'GemArrivalDetails']);


        Route::post('/gem-confirm/{id}', [ConsigneeResponseController::class, 'gem_confirm']);
        Route::post('/gem-reject/{id}', [ConsigneeResponseController::class, 'gem_reject']);
    });
    // SAS group
    Route::group(['middleware' => 'SAS'], function () {

        Route::get('/officedashboard', [OfficePageController::class, 'index']);

        Route::get('/office-arrival', [OfficePageController::class, 'officeArrival']);
        Route::get('/office-arrivaldata', [OfficePageController::class, 'officeArrivaldata']);
        Route::get('/office-dashboard-arrivaldata', [OfficePageController::class, 'officeDashboardArrivalData']);

        Route::get('/office-gir', [OfficePageController::class, 'officeGir']);
        Route::get('/office-girdata', [OfficePageController::class, 'officeGirdata']);

        Route::get('/office-kardex', [OfficePageController::class, 'officeKardex']);
        Route::get('/office-kardexdata', [OfficePageController::class, 'officeKardexdata']);

        Route::get('/office-dsr', [OfficePageController::class, 'officeDsr']);
        Route::get('/office-dsrdata', [OfficePageController::class, 'officeDsrdata']);

        Route::get('/office-RejectedPage', [OfficePageController::class, 'officeRejectedPage']);
        Route::get('/office-RejectedPagedata', [OfficePageController::class, 'officeRejectedPagedata']);

        Route::get('/office-GemConsignee', [OfficePageController::class, 'officeGemConsignee']);
        Route::get('/office-GemConsigneedata', [OfficePageController::class, 'officeGemConsigneedata']);
    });
}); // backHistory






// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
