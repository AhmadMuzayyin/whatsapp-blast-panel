<?php

use App\Http\Controllers\BlastController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\PhonebookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WhatsappController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });
    Route::controller(WhatsappController::class)->as('whatsapp.')->group(function () {
        Route::post('/whatsapp/store', 'store')->name('store');
        Route::delete('/whatsapp/{whatsapp}/destroy', 'destroy')->name('destroy');
        Route::get('/whatsapp/{whatsapp:number}/scan', 'scan')->name('scan');
    });
    Route::controller(ContactController::class)->as('contact.')->group(function () {
        Route::post('/contact/store', 'store')->name('store');
        Route::post('/contact/{phonebook}/import', 'import')->name('import');
        Route::get('/contact/{phonebook}/export', 'export')->name('export');
        Route::post('/contact/{phonebook}/show', 'show')->name('show');
        Route::delete('/contact/{contact}/delete', 'delete')->name('delete');
        Route::delete('/phonebook/{phonebook}/destroy', 'destroy')->name('deleteAll');
    });
    Route::controller(PhonebookController::class)->as('phonebook.')->group(function () {
        Route::get('/phonebook', 'index')->name('index');
        Route::post('/phonebook', 'store')->name('store');
        Route::delete('/phonebook/{phonebook}/destroy', 'destroy')->name('destroy');
    });
    Route::controller(DeviceController::class)->as('device.')->group(function () {
        Route::post('/device', 'change')->name('change');
    });
    Route::middleware(['device_selected'])->group(function () {
        Route::controller(BlastController::class)->as('blast.')->group(function () {
            Route::get('/blast', 'index')->name('index');
            Route::post('/blast/store', 'store')->name('store');
            Route::delete('/blast/{blast}/destroy', 'destroy')->name('destroy');
        });
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
