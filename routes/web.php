<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('Welcome');
});

Route::get('/Welcome.blade.php', function () {
    return view('Welcome');
});

Route::get('/dashboard.blade.php', function () {
    return view('dashboard');
});




//WELCOME SIGN IN ROUTE
Route::post('/SignInForm', function (Request $request) {

$request->validate([
    'EEmail' => 'required|min:3|max:30|email',
    'PPassword' => 'required|min:8|max:16'
]);

    $Email = $request->input("EEmail");
    $Password = $request->input("PPassword");

    return "HEY LOGGED IN AS $Email";
})->name("SignInForm");



Route::get('/Test.blade.php', function () {
    return view('Test');
});


Route::get('/Admin.blade.php', function () {
    return view('Admin');
});



Route::get('/projects.blade.php', function () {
    return view('projects');
});
    //project pages routes
    Route::get('/create-project.blade.php', function () {
        return view('create-project');
    });

    Route::get('/project-details.blade.php', function () {
        return view('project-details');
    });

    Route::get('/pro-timeline.blade.php', function () {
        return view('pro-timeline');
    });