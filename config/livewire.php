<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Path
    |--------------------------------------------------------------------------
    |
    | This is the path where your Livewire views are stored.
    |
    */
    'view_path' => resource_path('views/livewire'),

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | This is the default layout used by Livewire when rendering components
    | as pages (e.g., via `Route::get('post/create', CreatePost::class);`).
    |
    */
    'layout' => 'layouts.app', // Állítsd be az alapértelmezett layoutot

    /*
    |--------------------------------------------------------------------------
    | Lazy Loading Placeholder
    |--------------------------------------------------------------------------
    |
    | Livewire lehetővé teszi, hogy a lassan betöltődő komponensek helyett
    | egy alapértelmezett placeholder-t mutasson.
    |
    */
    'lazy_placeholder' => null,

];
