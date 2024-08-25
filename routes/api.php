<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['jwt.verify'])->group(function () {
    // Protected routes go here
});