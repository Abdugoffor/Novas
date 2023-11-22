<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\FinesController;
use App\Http\Controllers\FirmsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialStokController;
use App\Http\Controllers\MaterialStokValueController;
use App\Http\Controllers\NakladnoyController;
use App\Http\Controllers\PrixodController;
use App\Http\Controllers\ProductModelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SalaryTypeController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\StafController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {

    // User routes
    Route::get('/user-list', [UserController::class, 'index'])->name('user.list')->middleware('can:user.list');
    Route::post('/user-createt', [UserController::class, 'store'])->name('user.create')->middleware('can:user.create');
    Route::put('/user-update/{user}', [UserController::class, 'update'])->name('user.update')->middleware('can:user.create');
    Route::delete('/user-delete/{user}', [UserController::class, 'delete'])->name('user.delete')->middleware('can:user.create');
    Route::get('/user-status/{user}', [UserController::class, 'status'])->name('user.status');

    // Customer routes
    Route::get('/customer-list', [CustomerController::class, 'index'])->name('customer.list')->middleware('can:user.list');
    Route::get('/customer-show/{customer}', [CustomerController::class, 'show'])->name('customer.show')->middleware('can:user.create');
    Route::post('/customer-createt', [CustomerController::class, 'store'])->name('customer.create')->middleware('can:user.create');
    Route::put('/customer-update/{customer}', [CustomerController::class, 'update'])->name('customer.update')->middleware('can:user.create');
    Route::delete('/customer-delete/{customer}', [CustomerController::class, 'delete'])->name('customer.delete')->middleware('can:user.create');
    Route::get('/customer-status/{customer}', [CustomerController::class, 'status'])->name('customer.status');

    // Firm routes
    Route::get('/firm-list', [FirmsController::class, 'index'])->name('firm.list')->middleware('can:user.list');
    Route::post('/firm-createt/{id}', [FirmsController::class, 'store'])->name('firm.create')->middleware('can:user.create');
    Route::put('/firm-update/{firm}', [FirmsController::class, 'update'])->name('firm.update')->middleware('can:user.create');
    Route::delete('/firm-delete/{firm}', [FirmsController::class, 'delete'])->name('firm.delete')->middleware('can:user.create');
    Route::get('/firm-status/{firm}', [FirmsController::class, 'status'])->name('firm.status');
});

// Salary Type, Department, Staf, Equipment

Route::group(['middleware' => ['auth', 'role:hr']], function () {

    // Department routes
    Route::get('/department-list', [DepartmentController::class, 'index'])->name('department.list')->middleware('can:user.list');
    Route::post('/department-createt', [DepartmentController::class, 'store'])->name('department.create')->middleware('can:user.create');
    Route::put('/department-update/{department}', [DepartmentController::class, 'update'])->name('department.update')->middleware('can:user.create');
    Route::delete('/department-delete/{department}', [DepartmentController::class, 'delete'])->name('department.delete')->middleware('can:user.create');

    // Salary Type routes
    Route::get('/salarytype-list', [SalaryTypeController::class, 'index'])->name('salarytype.list')->middleware('can:user.list');
    Route::post('/salarytype-createt', [SalaryTypeController::class, 'store'])->name('salarytype.create')->middleware('can:user.create');
    Route::put('/salarytype-update/{salarytype}', [SalaryTypeController::class, 'update'])->name('salarytype.update')->middleware('can:user.create');
    Route::delete('/salarytype-delete/{salarytype}', [SalaryTypeController::class, 'delete'])->name('salarytype.delete')->middleware('can:user.create');


    // Staff routes
    Route::get('/staf-list', [StafController::class, 'index'])->name('staf.list')->middleware('can:user.list');
    Route::post('/staf-createt', [StafController::class, 'store'])->name('staf.create')->middleware('can:user.create');
    Route::get('/staf-show/{staf}', [StafController::class, 'show'])->name('staf.show')->middleware('can:user.create');
    Route::post('/staf-add-equipment/{staf}', [StafController::class, 'add_equipment'])->name('staf.add_equipment')->middleware('can:user.create');
    Route::put('/staf-update/{staf}', [StafController::class, 'update'])->name('staf.update')->middleware('can:user.create');
    Route::delete('/staf-delete/{staf}', [StafController::class, 'delete'])->name('staf.delete')->middleware('can:user.create');
    Route::delete('/staf-equipment-delete/{staf}/{id}', [StafController::class, 'equipment_delete'])->name('staf.equipment_delete')->middleware('can:user.create');

    // Kuryer CRUD
    Route::get('/courier-list', [CourierController::class, 'index'])->name('courier.list')->middleware('can:user.list');
    Route::post('/courier-createt', [CourierController::class, 'store'])->name('courier.create')->middleware('can:user.create');
    Route::get('/courier-show/{courier}', [CourierController::class, 'show'])->name('courier.show')->middleware('can:user.create');
    Route::put('/courier-update/{courier}', [CourierController::class, 'update'])->name('courier.update')->middleware('can:user.create');
    Route::delete('/courier-delete/{courier}', [CourierController::class, 'delete'])->name('courier.delete')->middleware('can:user.create');
    Route::get('/courier-status/{courier}', [CourierController::class, 'status'])->name('courier.status')->middleware('can:user.create');

    // Equipment routes
    Route::get('/equipment-list', [EquipmentController::class, 'index'])->name('equipment.list')->middleware('can:user.list');
    Route::post('/equipment-createt', [EquipmentController::class, 'store'])->name('equipment.create')->middleware('can:user.create');
    Route::put('/equipment-update/{equipment}', [EquipmentController::class, 'update'])->name('equipment.update')->middleware('can:user.create');
    Route::delete('/equipment-delete/{equipment}', [EquipmentController::class, 'delete'])->name('equipment.delete')->middleware('can:user.create');
});


// Bugalter oylik berish va jarimaga tortish
Route::group(['middleware' => ['auth', 'role:bugalter']], function () {

    // Salary routes hodimga oylik berish qismi
    Route::get('/salary-list', [SalaryController::class, 'index'])->name('salary.list')->middleware('can:user.list');
    Route::post('/salary-createt', [SalaryController::class, 'store'])->name('salary.create')->middleware('can:user.create');
    Route::put('/salary-update/{salary}', [SalaryController::class, 'update'])->name('salary.update')->middleware('can:user.create');
    Route::delete('/salary-delete/{salary}', [SalaryController::class, 'delete'])->name('salary.delete')->middleware('can:user.create');

    // Jarimalar
    Route::post('/fines-createt', [FinesController::class, 'store'])->name('fines.create')->middleware('can:user.create');

    // Nakladnoy routes  shartnomalari
    Route::get('/nakladnoy-list', [NakladnoyController::class, 'index'])->name('nakladnoy.list')->middleware('can:user.list');
    Route::get('/nakladnoy-view/{nakladnoy}', [NakladnoyController::class, 'view'])->name('nakladnoy.view')->middleware('can:user.create');
    Route::put('/nakladnoy-update/{nakladnoy}', [NakladnoyController::class, 'update'])->name('nakladnoy.update')->middleware('can:user.create');
    Route::delete('/nakladnoy-delete/{nakladnoy}', [NakladnoyController::class, 'delete'])->name('nakladnoy.delete')->middleware('can:user.create');

    // Prihod routes  material
    Route::get('/prixod-list', [PrixodController::class, 'index'])->name('prixod.list')->middleware('can:user.list');
    Route::post('/prixod-createt', [PrixodController::class, 'store'])->name('prixod.create')->middleware('can:user.create');
    Route::put('/prixod-update/{prixod}', [PrixodController::class, 'update'])->name('prixod.update')->middleware('can:user.create');
    Route::delete('/prixod-delete/{prixod}', [PrixodController::class, 'delete'])->name('prixod.delete')->middleware('can:user.create');

    // Material ulashish
    Route::post('/material-share', [ShareController::class, 'index'])->name('material.share')->middleware('can:user.create');
    // Route::post('/material-share/{material}/{materialStokValue}', [MaterialController::class, 'share'])->name('material.share')->middleware('can:user.create');
    // Route::post('/material-share1/{material}', [MaterialController::class, 'share1'])->name('material.share1')->middleware('can:user.create');


    // Prihod routes maxsulotlarni qabul qilish
    Route::get('/material-list', [MaterialController::class, 'index'])->name('material.list')->middleware('can:user.list');
    Route::post('/material-createt', [MaterialController::class, 'store'])->name('material.create')->middleware('can:user.create');
    Route::put('/material-update/{material}', [MaterialController::class, 'update'])->name('material.update')->middleware('can:user.create');
    Route::delete('/material-delete/{material}', [MaterialController::class, 'delete'])->name('material.delete')->middleware('can:user.create');
    Route::get('/material-acceptance', [MaterialStokValueController::class, 'acceptance'])->name('material.acceptance')->middleware('can:user.create');
    Route::get('/material-send', [MaterialStokValueController::class, 'send'])->name('material.send')->middleware('can:user.create');
});

Route::group(['middleware' => ['auth', 'role:sklad_manager']], function () {

    // Search Material Stok
    Route::get('/material_stok', [MaterialStokController::class, 'search'])->name('material_stok.search')->middleware('can:user.list');

    // Material_stoks routes ombor crud

    Route::get('/material_stoks-list', [MaterialStokController::class, 'index'])->name('material_stoks.list')->middleware('can:user.list');
    Route::post('/material_stoks-createt', [MaterialStokController::class, 'store'])->name('material_stoks.create')->middleware('can:user.create');
    Route::get('/material_stoks-show/{material}', [MaterialStokController::class, 'show'])->name('material_stoks.show')->middleware('can:user.create');
    Route::put('/material_stoks-update/{material}', [MaterialStokController::class, 'update'])->name('material_stoks.update')->middleware('can:user.create');
    Route::delete('/material_stoks-delete/{material}', [MaterialStokController::class, 'delete'])->name('material_stoks.delete')->middleware('can:user.create');
    Route::get('/material_stoks-status/{material}', [MaterialStokController::class, 'status'])->name('material_stoks.status')->middleware('can:user.create');
});
Route::group(['middleware' => ['auth', 'role:ishlab_chiqaruvchi']], function () {

    // Product model routes crud
    Route::get('/product_model-list', [ProductModelController::class, 'index'])->name('product_model.list')->middleware('can:user.list');
    Route::post('/product_model-createt', [ProductModelController::class, 'store'])->name('product_model.create')->middleware('can:user.create');
    Route::put('/product_model-update/{product_model}', [ProductModelController::class, 'update'])->name('product_model.update')->middleware('can:user.create');
    Route::delete('/product_model-delete/{product_model}', [ProductModelController::class, 'delete'])->name('product_model.delete')->middleware('can:user.create');
});

Route::get('/file-import', [UserController::class, 'importView'])->name('import-view');
Route::post('/import', [UserController::class, 'import'])->name('import');

Route::get('/admin', [AdminController::class, 'index']);
require __DIR__ . '/auth.php';
