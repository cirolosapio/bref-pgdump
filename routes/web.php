<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', fn () => shell_exec('pg_dump --version'));

Route::get('info', fn () => phpinfo());

Route::get('download', function () {
    $size = (int) request()->validate(['size' => 'integer|max:6289442'])['size'] ?? 1000;

    $content = str_repeat('A', $size);

    return response()->streamDownload(static function () use ($content): void { echo $content; }, 'test.log');
});
