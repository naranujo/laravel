<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestMailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

// HOME

// Landing page
Route::get('/', [HomeController::class, 'index'])->name('home'); // check
// Subscription
Route::post('/subscribe', [HomeController::class, 'storeSubscription'])->name('submit.subscribe');
// Newsletter
Route::get('/news', [HomeController::class, 'news'])->name('news');
Route::get('/news/post/{id}', [HomeController::class, 'showPost'])->name('news.post');
// Error page
Route::get('/error', [HomeController::class, 'error'])->name('error');

// INTRANET

// Intranet home page
Route::get('/intranet', [PostController::class, 'intranet'])->name('view.intranet'); // check

// AUTHENTICATION

// Register
Route::get('/intranet/register', [AuthController::class, 'showRegister'])->name('view.register');
Route::post('/intranet/register', [AuthController::class, 'processRegister'])->name('submit.register');
// Login
Route::get('/intranet/login', [AuthController::class, 'showLogin'])->name('view.login'); // check
Route::post('/intranet/login', [AuthController::class, 'processLogin'])->name('submit.login'); // check
// Logout
Route::post('/intranet/logout', [AuthController::class, 'logout'])->name('submit.logout'); // check
// reset password
Route::get('/intranet/password/reset', [AuthController::class, 'showResetPassword'])->name('view.reset_password');
Route::post('/intranet/password/reset', [AuthController::class, 'precessResetPassword'])->name('submit.reset_password');
Route::get('/intranet/password/reset/{token}', [AuthController::class, 'showResetPasswordToken'])->name('view.reset_password_token');
Route::post('/intranet/password/reset/{token}', [AuthController::class, 'processResetPasswordToken'])->name('submit.reset_password_token');

// USER MANAGEMENT (ADMIN)

// Add users
Route::get('/intranet/admin/add_users', [UserController::class, 'index'])->name('view.admin.add_users');
Route::post('/intranet/admin/add_users', [UserController::class, 'store'])->name('submit.admin.add_users');

// Show all users
Route::get('/intranet/admin/users', [UserController::class, 'show'])->name('view.admin.users');

// Edit users
Route::post('/intranet/admin/edit_user/{id}', [UserController::class, 'update'])->name('submit.admin.edit_user');
Route::post('/intranet/admin/restore_password/{id}', [UserController::class, 'restorePassword'])->name('submit.admin.restore_password');

// PROFILE

// Show profile
Route::get('/intranet/profile', [ProfileController::class, 'showProfile'])->name('view.profile');
// Edit profile
Route::post('/intranet/profile/edit', [ProfileController::class, 'updateProfile'])->name('submit.profile');

// POSTS
Route::get('/intranet/posts', [PostController::class, 'showPosts'])->name('view.posts');
Route::get('/intranet/post/{id}', [PostController::class, 'showPost'])->name('view.post'); // check
Route::post('/intranet/post/{id}', [PostController::class, 'changeStatus'])->name('submit.change_status'); // check
Route::get('/intranet/add_post', [PostController::class, 'showCreatePost'])->name('view.add_post'); // check
Route::post('/intranet/add_post', [PostController::class, 'storePost'])->name('submit.store_post'); // check
Route::get('/intranet/edit_post/{id}', [PostController::class, 'showEditPost'])->name('view.edit_post');
Route::post('/intranet/edit_post/{id}', [PostController::class, 'updatePost'])->name('submit.edit_post');
Route::delete('/intranet/delete_post/{id}', [PostController::class, 'destroyPost'])->name('submit.delete_post');
Route::get('/intranet/download_post/{id}', [PostController::class, 'downloadPost'])->name('download.post');

// TEST ENDPOINTS

// Test 1 - Send email
Route::get('/correo', [TestMailController::class, 'mostrarFormulario'])->name('formulario.correo');
Route::post('/enviar-correo', [TestMailController::class, 'enviarCorreo'])->name('enviar.correo');
Route::get('/run-migrations', function () {
    Artisan::call('migrate --force');
    return 'Migraciones ejecutadas correctamente.';
})->name('run.migrations');

