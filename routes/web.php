<?php

use App\Http\Controllers\ArrangementController;
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
use App\Http\Controllers\KidController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RsvSectionController;
use App\Http\Controllers\UserController;
use App\Models\Arrangement;

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
    // user
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    Route::patch('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    // reservattion regular
    Route::get('/reservation/regular', [ReservationController::class, 'indexRegular'])->name('rsv.regular.index');
    Route::get('/reservation/regular/create', [ReservationController::class, 'createRegular'])->name('rsv.regular.create');
    Route::get('/reservation/regular/edit/{id}/{type}', [ReservationController::class, 'editRegular'])->name('rsv.regular.edit');
    Route::get('/reservation/regular/delete/{id}/{type}', [ReservationController::class, 'deleteRegular'])->name('rsv.regular.delete');
    Route::get('/reservation/regular/history', [ReservationController::class, 'historyRegular'])->name('rsv.regular.history');
    Route::get('/reservation/regular/other', [ReservationController::class, 'otherRegular'])->name('rsv.regular.other');
    Route::post('/reservation/regular/store', [ReservationController::class, 'storeRegular'])->name('rsv.regular.store');
    Route::patch('/reservation/regular/complete/{id}', [ReservationController::class, 'completeRegular'])->name('rsv.regular.complete');
    Route::patch('/reservation/regular/return/{id}', [ReservationController::class, 'returnRegular'])->name('rsv.regular.return');
    Route::patch('/reservation/regular/update/{id}/{type}', [ReservationController::class, 'updateRegular'])->name('rsv.regular.update');
    Route::patch('/reservation/regular/deactivate/{id}/{type}', [ReservationController::class, 'deactivateRegular'])->name('rsv.regular.deactivate');
    // reservattion arrengement
    Route::get('/reservation/arrengement', [ReservationController::class, 'indexArr'])->name('rsv.arrangement.index');
    Route::get('/reservation/arrengement/create', [ReservationController::class, 'createArr'])->name('rsv.arrangement.create');
    Route::get('/reservation/arrengement/history', [ReservationController::class, 'historyArr'])->name('rsv.arrangement.history');
    Route::get('/reservation/arrengement/edit/{id}', [ReservationController::class, 'editArr'])->name('rsv.arrangement.edit');
    Route::get('/reservation/arrengement/delete/{id}', [ReservationController::class, 'deleteArr'])->name('rsv.arrangement.delete');
    Route::get('/reservation/arrengement/show/{id}', [ReservationController::class, 'showArr'])->name('rsv.arrangement.show');
    Route::post('/reservation/arrengement/store', [ReservationController::class, 'storeArr'])->name('rsv.arrangement.store');
    Route::get('/reservation/arrengement/item/edit/{id}', [ArrangementController::class, 'edit'])->name('rsv.arrangement.item.edit');
    Route::post('/reservation/arrengement/add/{id}', [ArrangementController::class, 'add'])->name('rsv.arrangement.add');
    Route::patch('/reservation/arrengement/update/{id}', [ReservationController::class, 'updateArr'])->name('rsv.arrangement.update');
    Route::patch('/reservation/arrengement/item/update/{id}', [ArrangementController::class, 'update'])->name('rsv.arrangement.item.update');
    Route::patch('/reservation/arrengement/deactivate/{id}', [ReservationController::class, 'deactivateArr'])->name('rsv.arrangement.deactivate');
    Route::delete('/reservation/arrengement/destroy/{id}', [ArrangementController::class, 'destroy'])->name('rsv.arrangement.destroy');
    // reservattion course
    Route::get('/reservation/course', [ReservationController::class, 'indexCourse'])->name('rsv.course.index');
    Route::get('/reservation/course/create', [ReservationController::class, 'createCourse'])->name('rsv.course.create');
    Route::get('/reservation/course/history', [ReservationController::class, 'historyCourse'])->name('rsv.course.history');
    Route::get('/reservation/course/edit/{id}', [ReservationController::class, 'editCourse'])->name('rsv.course.edit');
    Route::get('/reservation/course/delete/{id}', [ReservationController::class, 'deleteCourse'])->name('rsv.course.delete');
    Route::post('/reservation/course/store', [ReservationController::class, 'storeCourse'])->name('rsv.course.store');
    Route::patch('reservation/course/update/{id}', [ReservationController::class, 'updateCourse'])->name('rsv.course.update');
    Route::patch('reservation/course/deactivate/{id}', [ReservationController::class, 'deactivateCourse'])->name('rsv.course.deactivate');
    // reservattion christmas
    Route::get('/reservation/christmas', [ReservationController::class, 'indexXmas'])->name('rsv.xmas.index');
    Route::get('/reservation/christmas/history', [ReservationController::class, 'historyXmas'])->name('rsv.xmas.history');
    Route::get('/reservation/christmas/create', [ReservationController::class, 'createXmas'])->name('rsv.xmas.create');
    Route::get('/reservation/christmas/edit/{id}', [ReservationController::class, 'editXmas'])->name('rsv.xmas.edit');
    Route::get('/reservation/christmas/delete/{id}', [ReservationController::class, 'deleteXmas'])->name('rsv.xmas.delete');
    Route::get('/reservation/christmas/child/show/{id}', [ReservationController::class, 'showKidsXmas'])->name('rsv.xmas.show');
    Route::get('/reservation/christmas/child/edit/{id}', [KidController::class, 'editXmas'])->name('rsv.xmas.kid.edit');
    Route::post('/reservation/christmas/store', [ReservationController::class, 'storeXmas'])->name('rsv.xmas.store');
    Route::post('/reservation/christmas/child/add/{id}', [KidController::class, 'addXmas'])->name('rsv.xmas.add');
    Route::patch('/reservation/christmas/deactivate/{id}', [ReservationController::class, 'deactivateXmas'])->name('rsv.xmas.deactivate');
    Route::patch('/reservation/christmas/update/{id}', [ReservationController::class, 'updateXmas'])->name('rsv.xmas.update');
    Route::patch('/reservation/christmas/child/update/{id}', [KidController::class, 'updateXmas'])->name('rsv.xmas.kid.update');
    Route::delete('/reservation/christmas/child/destroy/{id}', [KidController::class, 'destroyXmas'])->name('rsv.xmas.kid.destroy');
    // reservattion new year
    Route::get('/reservation/new-year', [ReservationController::class, 'indexNewYear'])->name('rsv.newyear.index');
    Route::get('/reservation/new-year/history/{type}', [ReservationController::class, 'historyNewYear'])->name('rsv.newyear.history');
    Route::get('/reservation/new-year/show/{type}', [ReservationController::class, 'showNewYear'])->name('rsv.newyear.show');
    Route::get('/reservation/new-year/all-delete/{type}', [ReservationController::class, 'allDeleteNewYear'])->name('rsv.newyear.alldelete');
    Route::get('/reservation/new-year/create/{type}', [ReservationController::class, 'createNewYear'])->name('rsv.newyear.create');
    Route::get('/reservation/new-year/edit/{id}/{type}', [ReservationController::class, 'editNewYear'])->name('rsv.newyear.edit');
    Route::get('/reservation/new-year/child/{id}/{type}', [ReservationController::class, 'showKidsNewYear'])->name('rsv.newyear.kid.show');
    Route::get('/reservation/new-year/child/edit/{id}/{type}', [KidController::class, 'editNewYear'])->name('rsv.newyear.kid.edit');
    Route::post('/reservation/new-year/store/{type}', [ReservationController::class, 'storeNewYear'])->name('rsv.newyear.store');
    Route::post('/reservation/new-year/child/add/{id}', [KidController::class, 'addNewYear'])->name('rsv.newyear.kid.add');
    Route::patch('/reservation/new-year/update/{id}/{type}', [ReservationController::class, 'updateNewYear'])->name('rsv.newyear.update');
    Route::patch('/reservation/new-year/reset/{type}', [ReservationController::class, 'resetNewYear'])->name('rsv.newyear.reset');
    Route::get('/reservation/new-year/delete/{id}/{type}', [ReservationController::class, 'deleteNewYear'])->name('rsv.newyear.delete');
    Route::patch('/reservation/new-year/deactivate/{id}/{type}', [ReservationController::class, 'deactivateNewYear'])->name('rsv.newyear.deactivate');
    Route::patch('/reservation/new-year/child/update/{id}/{type}', [KidController::class, 'updateNewYear'])->name('rsv.newyear.kid.update');
    Route::delete('/reservation/new-year/child/destroy/{id}/{type}', [KidController::class, 'destroyNewYear'])->name('rsv.newyear.kid.destroy');
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
