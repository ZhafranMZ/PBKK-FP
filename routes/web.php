<?php

use App\Events\ChatMade;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavedController;
use App\Jobs\SendMailNotification;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;
use App\Mail\SendMail;


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

Route::middleware('auth')->group(function () {
    
    Route::get('/', [FeedController::class, 'index'])->name('home.index');

    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::post('/users', [UserController::class, 'update'])->name('users.update');

    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::patch('/posts/{id}', [PostController::class, 'update'])->name('posts.update');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::patch('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
    Route::patch('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');

    Route::post('/likes', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('/likes/{id}', [LikeController::class, 'destroy'])->name('likes.destroy');
    
    Route::post('/saveds', [SavedController::class, 'store'])->name('saveds.store');
    Route::delete('/saveds/{id}', [SavedController::class, 'destroy'])->name('saveds.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/profile/{id}', [ProfileController::class, 'updatePhoto'])->name('profile.update_photo');

    Route::get('/follow/{id}', [FollowerController::class, 'index'])->name('follow.index');
    Route::post('/follow/{id}', [FollowerController::class, 'store'])->name('follow.store');
    Route::delete('/follow/{id}', [FollowerController::class, 'destroy'])->name('follow.destroy');


    Route::get('/try', function(){
        // $user=User::find(4);
        // // $data=$user->email;
        // // dd($data);
        // $type='Logged in';
        // Mail::to($user->email)->send(new SendMail($type));

        // dispatch(new SendMailNotification($user, $type));
    }

);
});


require __DIR__.'/auth.php';
