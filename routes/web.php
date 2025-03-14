<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', fn () => shell_exec('pg_dump --version'));

Route::get('download', function () {
    request()->validate(['size' => 'int|max:6289443']);

    $size = request()->input('size', 1000);
    $content = str_repeat('A', $size);

    return response()->streamDownload(static function () use ($content): void { echo $content; }, 'test.log');
});
