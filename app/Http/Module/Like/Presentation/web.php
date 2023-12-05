<?php

use Illuminate\Support\Facades\Route;

Route::post('/store_like', [\App\Http\Module\Like\Presentation\Controller\LikeController::class, 'createLike']);