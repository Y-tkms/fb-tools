<?php

use App\Http\Controllers\ArrItemController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\TimeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuSectionController;
use App\Http\Controllers\MenuPreferenceController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\KeepItemController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\RsvSectionController;

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

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    // index
    Route::get('/', [HomeController::class, 'index'])->name('index');
    // reservation
    // rsv setting
    Route::get('/reservation/setting', [RsvSectionController::class, 'index'])->name('rsv.set.index');
    // rsv setting section
    Route::get('/reservation/setting/section', [RsvSectionController::class, 'sectionIndex'])->name('rsv.set.sec.index');
    Route::get('/reservation/setting/section/edit/{id}', [RsvSectionController::class, 'edit'])->name('rsv.set.sec.edit');
    Route::post('/reservation/setting/section/store', [RsvSectionController::class, 'store'])->name('rsv.set.sec.store');
    Route::patch('/reservation/setting/section/update/{id}', [RsvSectionController::class, 'update'])->name('rsv.set.sec.update');
    // rsv setting christmas date
    Route::get('/reservation/setting/date', [DateController::class, 'index'])->name('rsv.set.date.index');
    Route::get('/reservation/setting/date/edit/{id}', [DateController::class, 'edit'])->name('rsv.set.date.edit');
    Route::post('/reservation/setting/date/store', [DateController::class, 'store'])->name('rsv.set.date.store');
    Route::patch('/reservation/setting/date/update/{id}', [DateController::class, 'update'])->name('rsv.set.date.update');
    // rsv setting time of 12/31 & 1/1
    Route::get('/reservation/setting/time', [TimeController::class, 'index'])->name('rsv.set.time.index');
    Route::post('/reservation/setting/time/store', [TimeController::class, 'store'])->name('rsv.set.time.store');
    // rsv setting special item
    Route::get('/reservation/setting/menu', [OrderItemController::class, 'index'])->name('rsv.set.menu.index');
    Route::post('/reservation/setting/menu/store', [OrderItemController::class, 'store'])->name('rsv.set.menu.store');
    // rsv setting arrengement
    Route::get('/reservation/setting/arrengement', [ArrItemController::class, 'index'])->name('rsv.set.arr.index');
    Route::get('/reservation/setting/arrengement/edit/{id}', [ArrItemController::class, 'edit'])->name('rsv.set.arr.edit');
    Route::get('/reservation/setting/arrengement/delete/{id}', [ArrItemController::class, 'delete'])->name('rsv.set.arr.delete');
    Route::post('/reservation/setting/arrengement/store', [ArrItemController::class, 'store'])->name('rsv.set.arr.store');
    Route::patch('/reservation/setting/arrengement/update/{id}', [ArrItemController::class, 'update'])->name('rsv.set.arr.update');
    Route::patch('/reservation/setting/arrengement/deactivate/{id}', [ArrItemController::class, 'deactivate'])->name('rsv.set.arr.deactivate');
    // menu
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
    Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
    Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store');
    Route::get('/menu/show/{id}', [MenuController::class, 'show'])->name('menu.show');
    Route::get('/menu/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
    Route::patch('/menu/update/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::patch('/menu/hide/{id}', [MenuController::class, 'hideMenu'])->name('menu.hide');
    Route::patch('/menu/activate/{id}', [MenuController::class, 'activate'])->name('menu.activate');
    Route::get('/menu/hidden', [MenuController::class, 'showHidden'])->name('menu.hidden');
    // menu section & preference
    Route::get('/menu/section', [MenuSectionController::class, 'index'])->name('menu.section');
    Route::post('/menu/section/create', [MenuSectionController::class, 'create'])->name('menu.section.create');
    Route::post('menu/preference/create', [MenuPreferenceController::class, 'create'])->name('manu.preference.create');
    Route::get('menu/{id}/{type}/edit', [MenuSectionController::class, 'edit'])->name('menu.section.edit');
    Route::patch('menu/{id}/{type}/update', [MenuSectionController::class, 'update'])->name('menu.section.update');
    Route::delete('menu/{id}/{type}/destroy', [MenuSectionController::class, 'destroy'])->name('menu.section.destroy');
    // other calculator
    Route::get('/other/calculator', [KeepItemController::class, 'indexCal'])->name('other.calculator');
    Route::post('/other/calculator/calculate', [KeepItemController::class, 'calculate'])->name('other.calculate');
    Route::post('/other/calculator/store', [KeepItemController::class, 'store'])->name('other.store');
    Route::delete('/other/calculator/destroy/{id}', [KeepItemController::class, 'destroy'])->name('other.destroy');
    // other offline
    Route::get('/other/offline', [KeepItemController::class, 'goOffline'])->name('other.offline');
    Route::post('/other/offline/field', [KeepItemController::class, 'field'])->name('other.field');
    Route::post('/other/offline/calculate', [KeepItemController::class, 'calculateOrder'])->name('other.order');
});
